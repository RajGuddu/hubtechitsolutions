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
        if ($this->request->getMethod() === 'post' && isset($_POST['form_id']) && $_POST['form_id'] == 'course_fee'){
            $ie_id = session('ie_id');
            $va_id = base64_decode($_POST['va_id']);
            $member = $this->commonmodel->getOneRecord('tbl_internship_enrollment',['ie_id'=>$ie_id]);
            $vApp = $this->commonmodel->getOneRecord('tbl_vocational_applications',['va_id'=>$va_id]);
            $vAppCourseDtls = $vApp->course_details ? json_decode($vApp->course_details) : '';
            // $tempData = json_encode(array(
            //     'ie_id' => $ie_id,
            //     'course_details' => json_encode($vCourse),
            // ));
            // $te_id = $this->commonmodel->insertRecord('tbl_temp_enrollment', ['form_details'=>$tempData, 'added_at'=>date('Y-m-d H:i:s')]);
            $amount = round($vAppCourseDtls->course_fee);
            $orderId = 'TXN'.time().mt_rand(1000, 9999);
            $orderData = [
                'receipt'         => $orderId,
                'amount'          => (int)$amount * 100,
                'currency'        => 'INR',
                'payment_capture' => 1, // auto-capture
                'notes' => [
                    'va_id' => $va_id,
                    'amount' => $amount,
                    'payFrom' => 'HUBTECH',
                    ],
            ];
            $razorConfig = [
                'orderData' => $orderData,
                'customer_name' => $member->stu_name,
                'customer_email' => $member->email,
                'customer_phone' => $member->phone,
                'verify_url' => base_url('vocational/courseFee-payment-verify'),
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
    public function courseFee_payment_verify(){
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
            $va_id = $_POST['va_id'];
            $amount = $_POST['amount'];
            $vApp = $this->commonmodel->getOneRecord('tbl_vocational_applications',['va_id'=>$va_id]);
            // $ie_id = $vApp->ie_id;
            // $member = $this->commonmodel->getOneRecord('tbl_internship_enrollment',['ie_id'=>$ie_id]);
            // $vAppCourseDtls = $vApp->course_details ? json_decode($vApp->course_details) : '';
            
            do{
                $randomNo = rand(100000,999999);
                $cert_no = 'HVP' . $randomNo;
                $is_exist = $this->commonmodel->getAllRecordCount('tbl_vocational_applications',['cert_no'=>$cert_no]);
            }while($is_exist);
            
            $vcAppData = array(
                'status' => 5, // Course Fee Payment Completed
                'coursefee_payment_status' => 'Success',
                'coursefee_payment_id' => $_POST['paymentId'],
                'coursefee_order_id' => $_POST['orderId'],
                'coursefee_amount' => $amount,
                'coursefee_payment_date' => date('Y-m-d H:i:s'),
                'cert_no' => $cert_no,
                'update_at' => date('Y-m-d H:i:s')
            );
            $updated = $this->commonmodel->updateRecord('tbl_vocational_applications',$vcAppData,['va_id'=>$va_id]);
            if($updated){
                $paymentTransactionData = array(
                    'va_id' => $va_id,
                    'enroll_id' => $vApp->reg_no,
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
                'message' => 'Congratulations! Your course fee has been paid successfully. Your certificate is now available for download from your Dashboard.',
                'type' => 'success'
            ]);

        }else{
            session()->setFlashdata(['message'=>'Your course fee payment was unsuccessful. Please try again to complete your payment.','type'=>'danger']);
        }
        
        return redirect()->to(base_url('vocational/programs'));
    }
    //exam module
    public function exam($id){
        $va_id = base64_decode($id);
        $examineeDtls = $this->servicemodel->get_one_vocational_applicant($va_id);
        $data = [];
        if($this->request->getMethod() == 'post'){
            // echo '<pre>'; print_r($_POST); exit;
            if(!isset($_POST['answer']) && empty($_POST['answer'])){
                session()->setFlashdata(['message'  => 'Please answer at least one question before submitting the exam.','type' => 'danger']);
                return redirect()->to(base_url('vocational/vexam/'.$id));
            }
            $updateData = array();
            $examinee_id = $_POST['examinee_id']; //va_id
            $tot_ques = $_POST['tot_ques'];
            $ex_submit = array();
            $n = $true = $false = $result = 0;
            $grade = 'F';
            if(isset($_POST['q_title']) && !empty($_POST['q_title'])){
                
                foreach($_POST['q_title'] as $k=>$q_title){
                    $ex_submit[$n]['qno'] = $_POST['qno'][$k];
                    $ex_submit[$n]['q_title'] = $_POST['q_title'][$k];
                    // $ex_submit[$n]['q_title_hn'] = $_POST['q_title_hn'][$k];
                    $ex_submit[$n]['opt1'] = $_POST['opt1'][$k];
                    $ex_submit[$n]['opt2'] = $_POST['opt2'][$k];
                    $ex_submit[$n]['opt3'] = $_POST['opt3'][$k];
                    $ex_submit[$n]['opt4'] = $_POST['opt4'][$k];
                    $ex_submit[$n]['c_ans'] = $_POST['c_ans'][$k];

                    if(isset($_POST['answer'][$k])){
                        $ex_submit[$n]['answer'] = $_POST['answer'][$k];

                        if($_POST['c_ans'][$k] == $_POST['answer'][$k]){
                            $true++;
                            $ex_submit[$n]['remark'] = 'TRUE';
                        }else{
                            $false++;
                            $ex_submit[$n]['remark'] = 'FALSE';
                        }
                    }else{
                        $ex_submit[$n]['answer'] = 'N/A';
                        $ex_submit[$n]['remark'] = 'N/A';
                    }
                    $n++;
                }
                if($true){
                    $result = round(($true * 100) / $tot_ques, 2);
                    $grade = $this->servicemodel->get_grade($result)->grade ?? '';
                }
                if($grade == 'F'){
                    $updateData['status'] = 3;
                    $updateData['ex_submit'] = '';
                    $updateData['true_ans'] = 0;
                    $updateData['false_ans'] = 0;
                    $updateData['result'] = 0;
                    $updateData['grade'] = '';
                    $updateData['exam_duration'] = $examineeDtls->sub_exam_duration;
                }else{
                    // do{
                    //     $randomNo = rand(100000,999999);
                    //     $cert_no = 'HVP' . $randomNo;
                    //     $is_exist = $this->commonmodel->getAllRecordCount('tbl_vocational_applications',['cert_no'=>$cert_no]);
                    // }while($is_exist);
                    $updateData['status'] = 4;
                    $updateData['ex_submit'] = json_encode($ex_submit);
                    $updateData['true_ans'] = $true;
                    $updateData['false_ans'] = $false;
                    $updateData['result'] = $result;
                    $updateData['grade'] = $grade;
                    $updateData['completion_date'] = date('Y-m-d');
                    // $updateData['cert_no'] = $cert_no;
                    $updateData['update_at'] = date('Y-m-d H:i:s');
                }
                $update = $this->commonmodel->updateRecord('tbl_vocational_applications',$updateData, ['va_id'=>$va_id]);

                // inserting into tbl_vocational_exam_review
                $examReviewData = array(
                    'va_id' => $va_id,
                    'ie_id' => $examineeDtls->ie_id,
                    'ex_submit' => json_encode($ex_submit),
                    'tot_ques' => $tot_ques,
                    'true_ans' => $true,
                    'false_ans' => $false,
                    'result' => $result,
                    'grade' => $grade,
                    'completion_date' => date('Y-m-d')
                );
                $this->commonmodel->insertRecord('tbl_vocational_exam_review',$examReviewData);

                if($update){
                    session()->setFlashdata(['message'  => 'You have done your examination.','type' => 'success']);
                }else{
                    session()->setFlashdata(['message'  => 'Something went wrong!','type' => 'danger']);
                }
                return redirect()->to(base_url('vocational/programs'));
            }
            
        }

        if($examineeDtls->total_questions && $examineeDtls->exam_duration != '00:00:00'){
            $vc_id = $examineeDtls->vc_id;

            $existQues = '';
            if($examineeDtls->ex_submit != ''){
                $subQuestions = json_decode($examineeDtls->ex_submit);
                $existQues = implode(',',(array_column($subQuestions, 'qno')));
            }
            // $quesLimit = $examineeDtls->exam_ques;
            $quesLimit = $examineeDtls->total_questions - ($examineeDtls->true_ans + $examineeDtls->false_ans);
            // echo $quesLimit; exit;
            $questions = $this->servicemodel->get_vocational_questions($vc_id, $quesLimit, $existQues);
            // echo '<pre>'; print_r($questions); exit;
            $data['examineeDtls'] = $examineeDtls;
            $data['questions'] = $questions;
        }
        // $data['examineeDtls'] = $examineeDtls;
        echo view('include/header', $data);
        echo view('vocationalProgram/vExam', $data);
        echo view('include/footer', $data);
    }
    public function vocational_update_examinee_duration(){
        if($this->request->getMethod() == 'post'){
            $id = $_POST['id'];
            $h = $_POST['h'];
            $m = $_POST['m'];
            $s = $_POST['s'];
            $duration = date('H:i:s',strtotime($h.':'.$m.':'.$s));
            $this->commonmodel->updateRecord('tbl_vocational_applications', ['exam_duration'=>$duration], ['va_id'=>$id]);
            exit;
        }
    }
    public function vocational_exam_save_result(){
        if($this->request->getMethod() == 'post'){
            if(isset($_POST['answer']) && !empty($_POST['answer'])){
                $examinee_id = $_POST['examinee_id'];
                $tot_ques = $_POST['tot_ques'];
                $ex_submit = $updateData = array();
                $n = $true = $false = $result = 0;
                foreach($_POST['answer'] as $k=>$ans){
                    $ex_submit[$n]['qno'] = $_POST['qno'][$k];
                    $ex_submit[$n]['q_title'] = $_POST['q_title'][$k];
                    // $ex_submit[$n]['q_title_hn'] = $_POST['q_title_hn'][$k];
                    $ex_submit[$n]['opt1'] = $_POST['opt1'][$k];
                    $ex_submit[$n]['opt2'] = $_POST['opt2'][$k];
                    $ex_submit[$n]['opt3'] = $_POST['opt3'][$k];
                    $ex_submit[$n]['opt4'] = $_POST['opt4'][$k];
                    $ex_submit[$n]['c_ans'] = $_POST['c_ans'][$k];
                    $ex_submit[$n]['answer'] = $_POST['answer'][$k];

                    if($_POST['c_ans'][$k] == $_POST['answer'][$k]){
                        $true++;
                        $ex_submit[$n]['remark'] = 'TRUE';
                    }else{
                        $false++;
                        $ex_submit[$n]['remark'] = 'FALSE';
                    }
                    $n++;
                }
                if($true){
                    $result = round(($true * 100) / $tot_ques, 2);
                }
                $updateData['status'] = 2;
                $updateData['ex_submit'] = json_encode($ex_submit);
                $updateData['true_ans'] = $true;
                $updateData['false_ans'] = $false;
                $updateData['result'] = $result;
                // $updateData['update_at'] = date('Y-m-d H:i:s');
                $update = $this->commonmodel->updateRecord('tbl_vocational_applications',$updateData, ['va_id'=>$examinee_id]);
                if($update){
                    $res['update'] = 'true';
                }else{
                    $res['update'] = 'false';
                }
                return $this->response->setJSON($res);
            }
        }
    }
}