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

class Home extends BaseController
{
    use RazorpayTrait, MailTrait;
    public $service_model;
    public $common_model;
    public function __construct()
    {
        $this->service_model = model('App\Models\Service_model', false);
        $this->common_model = model('App\Models\Common_model', false);
    }
    public function index()
    {
        $data['title'] = 'Hubtech | Home';
        $data['popular_courses'] = $this->service_model->get_popular_courses();
        $data['banner'] = $this->common_model->get_one_banner($pageId='1');
        echo view('include/header', $data);
        echo view('home', $data);
        echo view('include/footer', $data);
    }
    public function courses(){
        $data['title'] = 'Hubtech | A Large Range of Course Learning Paths';
        $data['courses'] = $this->service_model->get_all_courses();
        $data['course_category'] = $this->common_model->getAllRecord('tbl_course_category',['status'=>'1']);
        echo view('include/header', $data);
        echo view('courses', $data);
        echo view('include/footer', $data);
    }
    public function course_details($url=null){
        $data['title'] = 'Hubtech | '.ucwords(str_replace('-',' ',$url));
        $data['course'] = $this->service_model->get_one_course($url);
        $data['course_category'] = $this->common_model->getAllRecord('tbl_course_category',['status'=>'1']);
        echo view('include/header', $data);
        echo view('course-detail', $data);
        echo view('include/footer', $data);
    }
    public function about_us(){
        $data['title'] = 'Hubtech | About us';
        echo view('include/header');
        echo view('about');
        echo view('include/footer');
    }
    public function contact_us(){
        $data['title'] = 'Hubtech | Contact us';
        $data['settings'] = $this->common_model->get_setting(1);
        echo view('include/header', $data);
        echo view('contact', $data);
        echo view('include/footer', $data);
    }
    public function save_contact_us(){ // also course enrolled form submit from course details page
		if($this->request->getMethod() == 'post'){
			$result = array();
			$validation = $this->validate([
				'name'=>[
					'rules'=>'required',
					'errors'=>['required'=>'Your Name is required']
				],
				'email'=>[
					'rules'=>'required|valid_email',
					'errors'=>['required'=>'Email is required','valid_email'=>'Enter Valid Email']
				],
				'phone'=>[
					'rules'=>'required|is_natural|min_length[10]|max_length[10]',
					'errors'=>['required'=>'Phone Number is required','is_natural'=>'Enter Valid Phone Number','min_length'=>'Phone Number must be 10 digit in length','max_length'=>'Phone Number must not have more than 10 digit in length']
				],
			]);
			if(!$validation){
				$validator = $this->validator;
				$errors = array(
					'name' => $validator->getError('name'),
					'email' => $validator->getError('email'),
					'phone' => $validator->getError('phone'),
				);
				$result['error'] = $errors;
			}else{
				$data = array();
                if(isset($_POST['course_id'])){
                    $data['course_id'] 		= $this->request->getPost('course_id');
                }
				$data['name'] 		= $this->request->getPost('name');
				$data['email'] 		= $this->request->getPost('email');
				$data['phone'] 		= $this->request->getPost('phone');
				$data['message'] 	= $this->request->getPost('message');
				$data['ipaddress'] 	= $this->request->getIPAddress();
                $data['status']     = 1;
				$data['added_at'] 	= date('y-m-d H:i:s');
				$insertId = $this->common_model->insertRecord('tbl_contact_us', $data);
				if($insertId){
                    $setting = $this->common_model->get_setting(1);
                    //$package = $this->homemodel->get_one_record('tbl_package', ['id'=>$data['pkg_id']]);
                    $msg = '<h2>Contact us</h2>
                        <p><strong>Full Name: </strong>'.$this->request->getPost('name').'</p>
                        <p><strong>Email: </strong>'.$this->request->getPost('email').'</p>
                        <p><strong>Phone: </strong>'.$this->request->getPost('phone').'</p>
                        <p><strong>Message: </strong>'.$this->request->getPost('message').'</p>';
                    $email = \Config\Services::email();

                    // $email->setFrom($this->request->getPost('email'), $this->request->getPost('name'));
                    $email->setTo($setting->email);
                    //$email->setTo('test136@yopmail.com');
                    
                    $email->setSubject('Contact us');
                    $email->setMessage($msg);
                    
                    $email->send();
                    $swal_session = array(
                        'title'=>'Thank You!',
                        'text'=>'Thank you for filling out the form, one of our team contact you soon.',
                    );
                    session()->set('swal_session', $swal_session);
					$result['msg'] 	= 'success';
				}else{
					$result['err'] = 'fail';
				}
			}
			
			echo json_encode($result); exit;
		}
	}
    public function certificate_verification(){
        $data['title'] = 'Hubtech | Certificate Verification';
        if(isset($_GET['cert_no']) && $_GET['cert_no'] != ''){
            $certDtls = $this->service_model->get_searched_certificate(trim($_GET['cert_no']));
            if(!empty($certDtls)){
                $data['certDtls'] = $certDtls;
            }else{
                session()->setFlashdata('err', 'Certificate Details Not Found! Please check the certificate No/Enrollment No.');
            }
        }
        echo view('include/header', $data);
        echo view('certificate', $data);
        echo view('include/footer', $data);
    }
    public function enroll_internship(){
        $data['title'] = 'Hubtech | Internship Enrollment';
        if ($this->request->getMethod() === 'post'){
            $validation = $this->validate([
              'stu_name'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Your Full name is required'
                  ]
                  ],
              'email' =>[
                  'rules'=>'required|valid_email|is_unique[tbl_internship_enrollment.email]',
                  'errors'=>[
                      'required'=>'Email is required',
                      'valid_email'=>'You must enter a valid email',
                      'is_unique'=>'Email already taken'
                  ]
                  ],
              
              'phone'=>[
                  'rules'=>'required|numeric|min_length[10]|max_length[10]',
                  'errors'=>[
                      'required'=>'Phone is required',
                      'numeric'=>'You must enter numeric value',
                      'min_length'=>'Phone Number must be 10 digit in length',
                      'max_length'=>'Phone Number must not have more than 10 digit in length'
                  ]
                  ],
              'uni_roll_no'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'University Roll No is required'
                  ]
                  ],
              'uni_reg_no'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'University Reg No is required'
                  ]
                  ],
              'gender'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Gender is required'
                  ]
                  ],
              'class'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Class is required'
                  ]
                  ],
              'mjc_id'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'MJC Subject is required'
                  ]
                  ],
              'session'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Session is required'
                  ]
                  ],
              'semester'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Semester is required'
                  ]
                  ],
              'clg_id'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'College is required'
                  ]
                  ],
              'ic_id'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Internship Course is required'
                  ]
                  ],
            //   'image' =>[
            //       //'rules'=>'uploaded[image]|max_size[image,50]|ext_in[image,png,jpg,jpeg,bmp,gif]',
            //       'rules'=>'max_size[image,100]|ext_in[image,png,jpg,jpeg,bmp,gif]',
            //       'errors'=>[
            //           //'uploaded'=>lang('User.validation.image.uploaded'),
            //           'max_size'=>'Image should not greater than 100 KB of size.',
            //           'ext_in'=>'Image must be extension with png,jpg,jpeg,bmp,gif.',
            //       ]
            //   ],
              'duration'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Duration is required'
                  ]
                ], 
              'terms'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Please accept Terms & Conditions.'
                  ]
                ], 
            //   'status'=>[
            //       'rules'=>'required',
            //       'errors'=>[
            //           'required'=>'Status must be select'
            //       ]
            //   ]
            ]);
            if(!$validation){
                $data['validation'] = $this->validator;
                //return view('admin/users/add_user',$this->data);
            }else{
                $tempStudtls = json_encode($_POST);
                $te_id = $this->common_model->insertRecord('tbl_temp_enrollment', ['form_details'=>$tempStudtls, 'added_at'=>date('Y-m-d H:i:s')]);
                $amount = round(300);
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
                    'customer_name' => $_POST['stu_name'],
                    'customer_email' => $_POST['email'],
                    'customer_phone' => $_POST['phone'],
                    'verify_url' => base_url('/enrollment-payment-verify'),
                ];
                $this->makePayment($razorConfig);
            }
        }
        $data['mjc'] = $this->common_model->getAllRecord('tbl_mjcsubject',['status'=>1]);
        $data['colleges'] = $this->common_model->getAllRecord('tbl_colleges',['status'=>1]);
        $data['icourses'] = $this->common_model->getAllRecord('tbl_intern_course',['status'=>1]);
        echo view('include/header', $data);
        echo view('enrollform', $data);
        echo view('include/footer', $data);
    }
    public function enrollment_payment_verify(){
        if ($this->request->getMethod() === 'post' && isset($_POST['razorpay_payment_id'])){
            $payment = $this->verifyPayment($_POST);
            // print_r($payment);
            if(isset($payment['success']) && $payment['success'] == true){
                echo view('include/header');
                echo view('payment_verify_loader', $payment);
                echo view('include/footer');
                return;
            }else{
                session()->setFlashdata('err',"Payment verification failed ❌ If your amount was deducted, Please contact support with your Application ID: ".$payment['application_id']);
            }
        }
        if($this->request->getMethod() == 'post' && isset($_POST['paymentId'])){
            $te_id = $_POST['te_id'];
            $amount = $_POST['amount'];
            $tempStudtls = json_decode($this->common_model->getOneRecord('tbl_temp_enrollment',['te_id'=>$te_id])->form_details);

            $hashPassword = password_hash('123456', PASSWORD_DEFAULT);

            $enrStudtls = array(
                'stu_name' => $tempStudtls->stu_name,
                'email' => $tempStudtls->email,
                'password' => $hashPassword,
                'phone' => $tempStudtls->phone,
                'genger' => $tempStudtls->gender,
                'status' => 0,
                'can_login' => 1,
                'profile_completed' => 0,
                'email_verified' => 1,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'added_at' => date('Y-m-d H:i:s'),
            );

            $ie_id = $this->common_model->insertRecord('tbl_internship_enrollment', $enrStudtls);
            if($ie_id){
                $this->common_model->deleteRecord('tbl_temp_enrollment',['te_id'=>$te_id]);

                //insert into 'tbl_internship_applications'
                do{
                    $randomNo = rand(1000,9999);
                    $enrollId = 'ENR' . date('Ymd') . $randomNo;
                    $is_exist = $this->common_model->getAllRecordCount('tbl_internship_applications',['enroll_id'=>$enrollId]);
                }while($is_exist);
                $internCourse = $this->common_model->getOneRecord('tbl_intern_course',['ic_id'=>$tempStudtls->ic_id]);
                
                $internAppData = array(
                    'ie_id' => $ie_id,
                    'enroll_id' => $enrollId,
                    'uni_roll_no' => $tempStudtls->uni_roll_no,
                    'uni_reg_no' => $tempStudtls->uni_reg_no,
                    'class' => $tempStudtls->class,
                    'mjc_id' => $tempStudtls->mjc_id,
                    'session' => $tempStudtls->session,
                    'semester' => $tempStudtls->semester,
                    'clg_id' => $tempStudtls->clg_id,
                    'ic_id' => $tempStudtls->ic_id,
                    // 'duration' => $tempStudtls->duration,
                    'terms' => $tempStudtls->terms ?? 1,
                    'attendence' => mt_rand(80, 95),
                    'status' => 1, // Payment Completed
                    'payment_status' => 'Success',
                    'razor_payment_id' => $_POST['paymentId'],
                    'razor_order_id' => $_POST['orderId'],
                    'amount' => $amount,
                    'exam_duration' => $internCourse->exam_duration,
                    'added_at' => date('Y-m-d H:i:s')
                );
                $ia_id = $this->common_model->insertRecord('tbl_internship_applications',$internAppData);
                if($ia_id){
                    $paymentTransactionData = array(
                        'ia_id' => $ia_id,
                        'enroll_id' => $enrollId,
                        'paid_amount' => $amount,
                        'payment_mode' => 'Online Razorpay',
                        'payment_status' => 'Success',
                        'razor_payment_id' => $_POST['paymentId'],
                        'added_at' => date('Y-m-d H:i:s')
                    );
                    $this->common_model->insertRecord('tbl_payment_transaction',$paymentTransactionData);
                }
                // session()->setFlashdata(
                //     'success',
                //     'Congratulations! Your internship registration and payment have been completed successfully. Your Enrollment Number: '.$enrollId.'. Please keep this number safe for tracking and future reference. The Enrollment Number has also been sent to your registered email address.'
                // );
                $mpdfController = new MpdfController();
                $pdfContent = $mpdfController->get_offer_letter_pdf($ia_id);

                //email to user
                $mailData = array(
                    'name' => $formData->name ?? 'Student',
                    'heading' => 'Internship Payment Successful 🎉',
                    'content' => '
                        <p style="color:#555;font-size:15px;">
                            We are pleased to inform you that your internship payment has been <strong>successfully processed</strong>.
                        </p>

                        <p style="color:#555;font-size:15px;">
                            Your internship is now active on your dashboard. Please log in to access all details and resources.
                        </p>

                        <p style="color:#555;font-size:15px;">
                            <strong>Payment & Enrollment Details:</strong>
                        </p>
                    ',
                    'details' => [
                        'Name' => $tempStudtls->stu_name ?? 'Student',
                        'Email/Username' => $tempStudtls->email ?? '',
                        'Password' => '123456',
                        'Course / Internship' => ucwords($internCourse->ic_name ?? 'Internship Program'),
                        'Payment Status' => 'Success',
                        'Transaction ID' => $_POST['paymentId'] ?? 'N/A',
                        'Amount Paid' => $amount ?? 'N/A',
                        'Payment Date' => date('d M-Y')
                    ]
                );

                $mailConfig['subject'] = 'Internship Payment Successful';
                $mailConfig['mailto'] = $tempStudtls->email ?? 'test@yopmail.com';
                $mailConfig['attachment'] = [
                    'content' => $pdfContent,
                    'filename' => 'Internship_Offer_Letter.pdf',
                    'mime' => 'application/pdf'
                ];
                $this->mail_to_user($mailConfig, $mailData);

                //email to admin
                $mailData = array(
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
                $this->mail_to_admin($mailConfig, $mailData);
                
                return redirect()->to(
                    base_url('intern-pay-success') . '?' . http_build_query([
                        'application_id' => $enrollId,
                        'username' => $tempStudtls->email,
                        'password' => '123456',
                    ])
                );

                exit;
            }
            // return redirect()->to(base_url('intern-certificate-verification?cert_no='.$enrollId));
        }else{
            session()->setFlashdata(
                'err',
                'Unable to complete your internship registration. Payment was unsuccessful or an error occurred. Please try again.'
            );
        }
        
        return redirect()->to(base_url('/enroll-internship'));
    }
    public function internPaySuccess(){
        $data = [
            'application_id' => $this->request->getGet('application_id'),
            'username'       => $this->request->getGet('username'),
            'password'       => $this->request->getGet('password'),
        ];

        echo view('include/header', $data);
        echo view('intern_pay_success', $data);
        echo view('include/footer', $data);
    }
    public function intern_certificate_verification(){
        $data['title'] = 'Hubtech | Internship Certificate Verification';
        if(isset($_GET['cert_no']) && $_GET['cert_no'] != ''){
            $certDtls = $this->service_model->get_searched_internship_certificate(trim($_GET['cert_no']));
            if(!empty($certDtls)){
                $data['certDtls'] = $certDtls;
            }else{
                session()->setFlashdata('err', 'Certificate Details Not Found! Please check the certificate No/Enrollment No.');
            }
        }
        echo view('include/header', $data);
        echo view('intern_verification', $data);
        echo view('include/footer', $data);
    }
    public function download_intern_letter($ia_id){
        $student = $this->service_model->get_one_internship_course_detail($ia_id);
        if (!$student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $html = view('pdfhtml/intern_offer_letter',['student'=>$student]);
        $mpdf = new Mpdf([
            'format' => 'A4',
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_left' => 0,
            'margin_right' => 0,
            'orientation' => 'P'
        ]);
        $mpdf->WriteHTML($html);
        $filename = 'Internship_Letter.pdf';

        return $this->response
            ->setContentType('application/pdf')
            ->setHeader(
                'Content-Disposition',
                'attachment; filename="'.$filename.'"'
            )
            ->setBody($mpdf->Output('', 'S'));
    }
    

/*************Testing************** */
    public function testpdf(){
        $mpdfController = new MpdfController();
        $mpdfController->_get_offer_letter_pdf(6);
    }
    public function testmail(){
        $mpdfController = new MpdfController();
        $pdfContent = $mpdfController->get_offer_letter_pdf(6);
        //mail to user
        $mailData = array(
            'name' => 'Student Kumar',
            'heading' => 'Internship Payment Successful 🎉',
            'content' => '
                <p style="color:#555;font-size:15px;">
                    We are pleased to inform you that your internship payment has been <strong>successfully processed</strong>.
                </p>

                <p style="color:#555;font-size:15px;">
                    Your internship is now active on your dashboard. Please log in to access all details and resources.
                </p>

                <p style="color:#555;font-size:15px;">
                    <strong>Payment & Enrollment Details:</strong>
                </p>
            ',
            'details' => [
                'Name' => 'Student Kumar',
                'Email/Username' => 'test152@yopmail.com',
                'Password' => 123456,
                'Course / Internship' => 'Internship Program',
                'Payment Status' => 'Success',
                'Transaction ID' => 'N/A',
                'Amount Paid' => '300',
                'Payment Date' => date('d M-Y')
            ]
        );

        $mailConfig['subject'] = 'Internship Payment Successful';
        $mailConfig['mailto'] = 'test152@yopmail.com';
        $mailConfig['attachment'] = [
            'content' => $pdfContent,
            'filename' => 'Internship_Offer_Letter.pdf',
            'mime' => 'application/pdf'
        ];
        $send = $this->mail_to_user($mailConfig, $mailData);
        //mail to admin
        $mailData = array(
            'heading' => 'Internship Payment Received',
            'content' => 'A user has successfully completed the internship payment. 
                            <p style="color: #555555; font-size: 15px;">
                                <strong>Payment Details:</strong>
                            </p>',
            'details' => [
                'Name' => 'Student Kumar',
                'Email' => 'test152@yopmail.com',
                'Course / Internship' => 'Internship Program',
                'Amount Paid' => '300',
                'Transaction ID' => 'N/A',
                'Payment Date' => date('d M-Y')
            ]
        );

        $mailConfig['subject'] = 'New Internship Payment Received';
        //$send = $this->mail_to_admin($mailConfig, $mailData);

        

        /*$msg = '
            <h2>Internship Registration Successful</h2>
            <hr>
            <p>Dear Md Raj Guddu,</p>
            <p>Your internship registration and payment have been completed successfully.</p>
            <p><strong>Enrollment Number:</strong> 1234567890</p>
            <p>Please keep this Enrollment Number safe for future reference and communication.</p>
            <p>Thank you for registering with us.</p>
            <br>
            <p>Regards,<br>
            Hubtech IT Solutions</p>
        ';
        $email = \Config\Services::email();

        // $email->setFrom('info@hubtechitsolutions.in', 'Hubtech It Solutions');
        $email->setTo('test152@yopmail.com');
        //$email->setTo('test136@yopmail.com');
        
        $email->setSubject('Internship Registration Successfull');
        $email->setMessage($msg);
        $email->attach(
            $pdfContent,
            'attachment',
            'Internship_Offer_Letter.pdf',
            'application/pdf'
        );*/
        
        if($send){
            echo 'mail send';
        }else{
            echo 'mail not send';
        }
    }
    public function testmail_(){
        $mpdfController = new MpdfController();
        $pdfContent = $mpdfController->get_offer_letter_pdf(6);
        $msg = '
            <h2>Internship Registration Successful</h2>
            <hr>
            <p>Dear Md Raj Guddu,</p>
            <p>Your internship registration and payment have been completed successfully.</p>
            <p><strong>Enrollment Number:</strong> 1234567890</p>
            <p>Please keep this Enrollment Number safe for future reference and communication.</p>
            <p>Thank you for registering with us.</p>
            <br>
            <p>Regards,<br>
            Hubtech IT Solutions</p>
        ';
        $email = \Config\Services::email();

        // $email->setFrom('info@hubtechitsolutions.in', 'Hubtech It Solutions');
        $email->setTo('test152@yopmail.com');
        //$email->setTo('test136@yopmail.com');
        
        $email->setSubject('Internship Registration Successfull');
        $email->setMessage($msg);
        $email->attach(
            $pdfContent,
            'attachment',
            'Internship_Offer_Letter.pdf',
            'application/pdf'
        );
        
        if($email->send()){
            echo 'mail send';
        }else{
            echo 'mail not send';
        }
    }
    
}
