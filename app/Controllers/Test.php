<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use App\Traits\RazorpayTrait;
use App\Traits\MailTrait;

class Test extends BaseController
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
    public function add(){
        $amount = 300;

        $hashPassword = password_hash('123456', PASSWORD_DEFAULT);
        $razor_payment_id = 'pay_TGt9693IfsfLsi';
        $razor_order_id = 'order_TGt8N1hcOZKGfb';
        $added_at = date('Y-m-d H:i:s',strtotime('2026-07-23 14:35:00'));

        $enrStudtls = array(
            'stu_name' => 'Sima kumari',
            'email' => 'ku7196980@gmail.com',
            'password' => $hashPassword,
            'phone' => '8873028109',
            'genger' => 'F',
            'status' => 0,
            'can_login' => 1,
            'profile_completed' => 0,
            // 'email_verified' => 0,
            // 'email_verified_at' => '',
            'added_at' => $added_at,
        );

        $ie_id = $this->commonmodel->insertRecord('tbl_internship_enrollment', $enrStudtls);
        // $ie_id = 186;
        if($ie_id){
            echo 'Record Added<br>';
            //insert into 'tbl_internship_applications'
            do{
                $randomNo = rand(1000,9999);
                $enrollId = 'ENR' . date('Ymd',strtotime($added_at)) . $randomNo;
                $is_exist = $this->commonmodel->getAllRecordCount('tbl_internship_applications',['enroll_id'=>$enrollId]);
            }while($is_exist);
            $internCourse = $this->commonmodel->getOneRecord('tbl_intern_course',['ic_id'=>10]);
            
            $internAppData = array(
                'ie_id' => $ie_id,
                'enroll_id' => $enrollId,
                'uni_roll_no' => '242034051868',
                'uni_reg_no' => '24203405008339',
                'class' => 'BA',
                'mjc_id' => 13,
                'session' => '2024-2028',
                'semester' => 5,
                'clg_id' => 2,
                'ic_id' => 5,
                // 'duration' => $tempStudtls->duration,
                'terms' => 1,
                'attendence' => mt_rand(80, 95),
                'status' => 1, // Payment Completed
                'payment_status' => 'Success',
                'razor_payment_id' => $razor_payment_id,
                'razor_order_id' => $razor_order_id,
                'amount' => $amount,
                'exam_duration' => $internCourse->exam_duration,
                'added_at' => $added_at
            );
            $ia_id = $this->commonmodel->insertRecord('tbl_internship_applications',$internAppData);
            if($ia_id){
                echo 'App Record Added<br>';
                $paymentTransactionData = array(
                    'ia_id' => $ia_id,
                    'enroll_id' => $enrollId,
                    'paid_amount' => $amount,
                    'payment_mode' => 'Online Razorpay',
                    'payment_status' => 'Success',
                    'razor_payment_id' => $razor_payment_id,
                    'added_at' => $added_at
                );
                $this->commonmodel->insertRecord('tbl_payment_transaction',$paymentTransactionData);
            }

            //email to user
            $mailData = array(
                'name' => $enrStudtls['stu_name'],
                'heading' => 'Your Internship Portal Login Details 🎉',
                'content' => '
                    <p style="color:#555;font-size:15px;">
                        Your Internship Student Portal is now live..
                    </p>

                    <p style="color:#555;font-size:15px;">
                        Your internship is now active on your dashboard. Please log in to access all details and resources.
                    </p>
                    <div style="text-align:center; margin:30px 0;">
                        <a href="' . base_url('internship/login') . '" 
                        style="
                                background:#0d6efd;
                                color:#ffffff;
                                padding:12px 30px;
                                text-decoration:none;
                                border-radius:5px;
                                font-size:16px;
                                font-weight:bold;
                                display:inline-block;">
                            Login to Dashboard
                        </a>
                    </div>

                    <p style="color:#555;font-size:15px;">
                        <strong>Details:</strong>
                    </p>
                ',
                'details' => [
                    'Name' => $enrStudtls['stu_name'],
                    'Email/Username' => $enrStudtls['email'],
                    'Password' => 123456,
                    
                ]
            );

            $mailConfig['subject'] = 'Your Internship Portal Login Details';
            $mailConfig['mailto'] = $enrStudtls['email'];
            
            $send = $this->mail_to_user($mailConfig, $mailData);
            if($send){
               $this->commonmodel->updateRecord('tbl_internship_enrollment', ['email_verified'=>1,'email_verified_at'=>$added_at],['ie_id'=>$ie_id]); 
               echo 'email send<br>';
            }
            
        } 
    }
    public function update(){
        echo '<pre>';
        // $this->commonmodel->updateRecord('tbl_intern_course', ['exam_duration'=>'00:30:00'], ['status'=>1]);
        // $this->commonmodel->updateRecord('tbl_intern_course', ['duration'=>120], ['status'=>1]);

        $data = $this->commonmodel->getAllRecord('tbl_internship_enrollment',['ie_id >'=>218, 'ie_id <='=>225]);
        foreach($data as $li){
            // for email
            //mail to user
            $mailData = array(
                'name' => $li->stu_name,
                'heading' => 'Your Internship Portal Login Details 🎉',
                'content' => '
                    <p style="color:#555;font-size:15px;">
                        Your Internship Student Portal is now live..
                    </p>

                    <p style="color:#555;font-size:15px;">
                        Your internship is now active on your dashboard. Please log in to access all details and resources.
                    </p>
                    <div style="text-align:center; margin:30px 0;">
                        <a href="' . base_url('internship/login') . '" 
                        style="
                                background:#0d6efd;
                                color:#ffffff;
                                padding:12px 30px;
                                text-decoration:none;
                                border-radius:5px;
                                font-size:16px;
                                font-weight:bold;
                                display:inline-block;">
                            Login to Dashboard
                        </a>
                    </div>

                    <p style="color:#555;font-size:15px;">
                        <strong>Details:</strong>
                    </p>
                ',
                'details' => [
                    'Name' => $li->stu_name,
                    'Email/Username' => $li->email,
                    'Password' => 123456,
                    
                ]
            );

            $mailConfig['subject'] = 'Your Internship Portal Login Details';
            $mailConfig['mailto'] = $li->email;
            
            $send = $this->mail_to_user($mailConfig, $mailData);
            if($send){
               $this->commonmodel->updateRecord('tbl_internship_enrollment', ['email_verified'=>1,'email_verified_at'=>$li->added_at],['ie_id'=>$li->ie_id]); 
               echo 'send<br>';
            }
            // sleep(3);

            // for password update
            // $password = password_hash('123456', PASSWORD_DEFAULT);
            // $this->commonmodel->updateRecord('tbl_internship_enrollment', ['password'=>$password,'status'=>0,'can_login'=>1],['ie_id'=>$li->ie_id]); 

            //make record tbl_internship_applications
            /*$internapp = $this->commonmodel->getOneRecord('tbl_internship_applications', ['ie_id'=>$li->ie_id]);
            if(!isset($internapp->ie_id)) {
                $appdata = array(
                    'ie_id' => $li->ie_id,
                    'enroll_id' => $li->enroll_id,
                    'uni_roll_no' => $li->uni_roll_no,
                    'uni_reg_no' => $li->uni_reg_no,
                    'class' => $li->class,
                    'mjc_id' => $li->mjc_id,
                    'session' => $li->session,
                    'semester' => $li->semester,
                    'clg_id' => $li->clg_id,
                    'ic_id' => $li->ic_id,
                    'terms' => $li->terms,
                    'attendence' => mt_rand(80, 95),
                    'status' => 1,
                    'payment_status' => 'Success',
                    'razor_payment_id' => $li->payment_id,
                    'razor_order_id' => $li->order_id,
                    'amount' => $li->amount,
                    'exam_duration' => '00:30:00',
                    'added_at' => $li->added_at,
                );
                $ia_id = $this->commonmodel->insertRecord('tbl_internship_applications', $appdata); 
                if($ia_id){
                    $paymentTransactionData = array(
                        'ia_id' => $ia_id,
                        'enroll_id' => $li->enroll_id,
                        'paid_amount' => $li->amount,
                        'payment_mode' => 'Online Razorpay',
                        'payment_status' => 'Success',
                        'razor_payment_id' => $li->payment_id,
                        'added_at' => $li->added_at
                    );
                    $this->commonmodel->insertRecord('tbl_payment_transaction',$paymentTransactionData);
                }
            }*/
        }
        // $data = $this->commonmodel->getAllRecord('tbl_internship_applications');
        // print_r($data);
        // $data = [];
        // echo view('include/header', $data);
        // echo view('intern_pay_success', $data);
        // echo view('include/footer', $data);
    }
    public function refund(){
        // $payment_id = 'pay_TBkFMJFrSrNiqU';
        $payment_id = 'pay_TGs5Bs0O6WW43l';
        $razorConfig['payment_id'] = $payment_id;
        $razorConfig['amount'] = (int) 5 * 100;
        $refund = $this->refundPayment($razorConfig);
        echo '<pre>';print_r($refund);
    }
    public function update_refund(){
        $refund_id = 'rfnd_TIRUZSJbuTpuff';
        $refund = $this->refund_status($refund_id);
        echo '<pre>';print_r($refund);echo $refund['data']['id'];
    }
    

}