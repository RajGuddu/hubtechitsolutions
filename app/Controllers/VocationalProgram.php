<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use App\Traits\RazorpayTrait;
use App\Traits\MailTrait;
use App\Controllers\MpdfController;
use Mpdf\Mpdf;

class VocationalProgram extends BaseController
{
    use RazorpayTrait, MailTrait;
    public $data;
    public $commonmodel;
    public $adminmodel;
    private $servicemodel;
    public function __construct()
    {
        $this->data['title'] = 'Admin-Internship';
        $this->commonmodel = model('App\Models\Common_model', false);
        $this->servicemodel = model('App\Models\Service_model', false);
    }
    public function index(){
        $ie_id = session('ie_id');
        $this->commonmodel->updateRecord('tbl_internship_enrollment', ['is_click_voc'=>1], ['ie_id'=>$ie_id]);

        if ($this->request->getMethod() === 'post' && isset($_POST['form_id']) && $_POST['form_id'] == 'reg_fee'){
            $ie_id = session('ie_id');
            $vc_id = base64_decode($_POST['course_id']);
            $member = $this->commonmodel->getOneRecord('tbl_internship_enrollment',['ie_id'=>$ie_id]);
            $vCourse = $this->commonmodel->getOneRecord('tbl_vocational_course',['vc_id'=>$vc_id]);
            $tempData = json_encode(array(
                'ie_id' => $ie_id,
                'course_details' => json_encode($vCourse),
            ));
            $te_id = $this->commonmodel->insertRecord('tbl_temp_enrollment', ['form_details'=>$tempData, 'added_at'=>date('Y-m-d H:i:s')]);
            $amount = round($vCourse->exam_fee);
            $orderId = 'TXN'.time().mt_rand(1000, 9999);
            $orderData = [
                'receipt'         => $orderId,
                'amount'          => (int)$amount * 100,
                'currency'        => 'INR',
                'payment_capture' => 1, // auto-capture
                'notes' => [
                    'te_id' => $te_id,
                    'amount' => $amount,
                    'payFrom' => 'HUBTECH',
                    ],
            ];
            $razorConfig = [
                'orderData' => $orderData,
                'customer_name' => $member->stu_name,
                'customer_email' => $member->email,
                'customer_phone' => $member->phone,
                'verify_url' => base_url('vocational/exam-payment-verify'),
                'cancel_url' => base_url('vocational/programs'),
            ];
            $this->makePayment($razorConfig);
        }
        
        $data['vCourses'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_vocational_course', ['status'=>1], ['sort_order','ASC']);
        $data['appliedCourses'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_vocational_applications', ['ie_id'=>$ie_id], ['va_id','DESC']);
        
        echo view('include/header', $data);
        echo view('vocationalProgram/programIndex', $data);
        echo view('include/footer', $data);
    }
    
    public function exam_payment_verify(){
        if ($this->request->getMethod() === 'post' && isset($_POST['razorpay_payment_id'])){
            $payment = $this->verifyPayment($_POST);
            // print_r($payment);
            if(isset($payment['success']) && $payment['success'] == true){
                echo view('include/header');
                echo view('internship/payment_verify_loader', $payment);
                echo view('include/footer');
                return;
            }else{
                session()->setFlashdata(['message'=>"Payment verification failed ❌ If your amount was deducted, Please contact support with your Application ID: ".$payment['application_id'],'type'=>'danger']);
            }
        }
        if($this->request->getMethod() == 'post' && isset($_POST['paymentId'])){
            // print_r($_POST); exit;
            $te_id = $_POST['te_id'];
            $amount = $_POST['amount'];
            $tempStudtls = json_decode($this->commonmodel->getOneRecord('tbl_temp_enrollment',['te_id'=>$te_id])->form_details);
            $vCourseDtls = json_decode($tempStudtls->course_details);
            
            $this->commonmodel->deleteRecord('tbl_temp_enrollment',['te_id'=>$te_id]);
            // echo '<pre>';print_r($vCourseDtls); exit;

            //insert into 'tbl_vocational_applications'
            do{
                $randomNo = rand(1000,9999);
                $reg_no = 'VC' . date('Ymd') . $randomNo;
                $is_exist = $this->commonmodel->getAllRecordCount('tbl_vocational_applications',['reg_no'=>$reg_no]);
            }while($is_exist);
            // $internCourse = $this->commonmodel->getOneRecord('tbl_intern_course',['ic_id'=>$tempStudtls->ic_id]);
            
            $vcAppData = array(
                'ie_id' => session('ie_id'),
                'vc_id' => $vCourseDtls->vc_id,
                'reg_no' => $reg_no,
                'course_details' => $tempStudtls->course_details,
                'status' => 1, // Payment Completed
                'exam_payment_status' => 'Success',
                'exam_payment_id' => $_POST['paymentId'],
                'exam_order_id' => $_POST['orderId'],
                'amount' => $amount,
                'exam_duration' => $vCourseDtls->exam_duration,
                'added_at' => date('Y-m-d H:i:s')
            );
            $va_id = $this->commonmodel->insertRecord('tbl_vocational_applications',$vcAppData);
            if($va_id){
                $paymentTransactionData = array(
                    'va_id' => $va_id,
                    'enroll_id' => $reg_no,
                    'paid_amount' => $amount,
                    'payment_mode' => 'Online Razorpay',
                    'payment_status' => 'Success',
                    'razor_payment_id' => $_POST['paymentId'],
                    'added_at' => date('Y-m-d H:i:s')
                );
                $this->commonmodel->insertRecord('tbl_payment_transaction',$paymentTransactionData);
            }
            
            /*$mpdfController = new MpdfController();
            $pdfContent = $mpdfController->get_offer_letter_pdf($ia_id);

            //email to user
            $member = $this->commonmodel->getOneRecord('tbl_internship_enrollment',['ie_id'=>session('ie_id')]);
            $mailData = array(
                'name' => $member->stu_name ?? 'Student',
                'heading' => 'Internship Payment Successful 🎉',
                'content' => '
                    <p style="color:#555;font-size:15px;">
                        We are pleased to inform you that your internship payment has been <strong>successfully processed</strong>.
                    </p>

                    <p style="color:#555;font-size:15px;">
                        Your internship course has been successfully added to your account. You can now start your internship and access all course materials, assignments, and other resources from your dashboard.
                    </p>

                    <p style="color:#555;font-size:15px;">
                        <strong>Payment & Enrollment Details:</strong>
                    </p>
                ',
                'details' => [
                    'Name' => $member->stu_name ?? 'Student',
                    'Email/Username' => $member->email ?? '',
                    // 'Password' => '123456',
                    'Course / Internship' => ucwords($internCourse->ic_name ?? 'Internship Program'),
                    'Payment Status' => 'Success',
                    'Transaction ID' => $_POST['paymentId'] ?? 'N/A',
                    'Amount Paid' => $amount ?? 'N/A',
                    'Payment Date' => date('d M-Y')
                ]
            );

            $mailConfig['subject'] = 'Internship Payment Successful';
            $mailConfig['mailto'] = $member->email ?? 'test@yopmail.com';
            $mailConfig['attachment'] = [
                'content' => $pdfContent,
                'filename' => 'Internship_Offer_Letter.pdf',
                'mime' => 'application/pdf'
            ];
            $this->mail_to_user($mailConfig, $mailData);

            //email to admin
            /*$mailData = array(
                'heading' => 'Internship Payment Received',
                'content' => 'A user has successfully completed the internship payment. 
                                <p style="color: #555555; font-size: 15px;">
                                    <strong>Payment Details:</strong>
                                </p>',
                'details' => [
                    'Name' => $tempStudtls->stu_name ?? 'Student',
                    'Email' => $tempStudtls->email ?? '',
                    'Course / Internship' => ucwords($internCourse->ic_name ?? 'Internship Program'),
                    'Amount Paid' => $amount ?? 'N/A',
                    'Transaction ID' => $_POST['paymentId'] ?? 'N/A',
                    'Payment Date' => date('d M-Y')
                ]
            );

            $mailConfig['subject'] = 'New Internship Payment Received';
            $this->mail_to_admin($mailConfig, $mailData);*/
            
            /*return redirect()->to(
                base_url('internship/payment-success') . '?' . http_build_query([
                    'application_id' => $enrollId,
                    'stu_name' => $member->stu_name,
                    'intern_course' => ucwords($internCourse->ic_name ?? 'Internship Program'),
                ])
            );*/
            session()->setFlashdata([
                'message' => 'Your vocational course registration has been completed successfully. Registration No: ' . $reg_no . '. Your registration fee has been received successfully.',
                'type' => 'success'
            ]);

        }else{
            session()->setFlashdata(['message'=>'Unable to complete your vocational registration. Payment was unsuccessful or an error occurred. Please try again.','type'=>'danger']);
        }
        
        return redirect()->to(base_url('vocational/programs'));
    }
}