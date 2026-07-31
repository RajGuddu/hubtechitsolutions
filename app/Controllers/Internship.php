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

class Internship extends BaseController
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
    public function login(){
        $data = [];
        // echo password_hash('654321', PASSWORD_DEFAULT); exit;
        // echo session('stu_name'); exit;
        if($this->request->getMethod() === 'post'){
            $validation = $this->validate([
                'email'=>[
                    'rules'=>'required|is_not_unique[tbl_internship_enrollment.email]',
                    'errors'=>['required'=>'Email is required',
                                'is_not_unique'=>'This Email is not registered in our system']
                ],
                'password'=>[
                    'rules'=>'required|min_length[6]|max_length[16]',
                    'errors'=>['required'=>'Password is required',
                                'min_length'=>'Password must have atleast 6 character in length',
                                'max_length'=>'Password must not have characters more than 16 in length']
                ],
            ]);
            if(!$validation){
                $data['validation'] = $this->validator; 
            }else{
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                $user_info = $this->commonmodel->getOneRecord('tbl_internship_enrollment',['email'=>$email, 'can_login'=>1]);
                if(empty($user_info)){
                    session()->setFlashdata('alert_error','Invalid User State.');
                    return redirect()->to(base_url('internship/login'))->withInput();
                }
                $check_password = password_verify($password, $user_info->password);
                if(!$check_password){
                    session()->setFlashdata('alert_error','Incorrect Password');
                    return redirect()->to(base_url('internship/login'))->withInput();
                }else{
                    session()->set(array(
                        'ie_id' => $user_info->ie_id,
                        'stu_name' => $user_info->stu_name,
                        'email' => $user_info->email,
                        'phone' => $user_info->phone,
                        'image' => $user_info->image,
                        'status' => $user_info->status,
                        'profile_completed' => $user_info->profile_completed,
                        'internIsLoggedIn' => true,
                    ));
                    if($user_info->profile_completed)
                        return redirect()->to(base_url('/internship/dashboard'));
                    else    
                        return redirect()->to(base_url('/internship/profile'));
                }
            }
        }
        echo view('include/header', $data);
        echo view('internship/login', $data);
        echo view('include/footer', $data);
    }
    public function dashboard(){
        $ie_id = session('ie_id');
        $data['profile'] = $this->commonmodel->getOneRecord('tbl_internship_enrollment',['ie_id'=>$ie_id]);
        $data['totApplied'] = $this->commonmodel->getAllRecordCount('tbl_internship_applications',['ie_id'=>$ie_id]);
        $data['totIncmp'] = $this->commonmodel->getAllRecordCount('tbl_internship_applications',['ie_id'=>$ie_id,'status != '=>3]);
        $data['totCmp'] = $this->commonmodel->getAllRecordCount('tbl_internship_applications',['ie_id'=>$ie_id,'status'=>3]);
        
        echo view('include/header', $data);
        echo view('internship/dashboard', $data);
        echo view('include/footer', $data);
    }
    public function profile(){
        $ie_id = session('ie_id');
        $profile = $this->commonmodel->getOneRecord('tbl_internship_enrollment',['ie_id'=>$ie_id]);
        if($this->request->getMethod() === 'post'){
            // print_r($_POST); exit;
            $rules = [
                
                'stu_name'=>[
                    'rules'=>'required|alpha_numeric_space',
                    'errors'=>['required'=>'Your Full name is required',
                                'alpha_numeric_space'=>'Please enter valid name.']
                ],
                /*'address'=>[
                    'rules'=>'required|alpha_numeric_space',
                    'errors'=>['required'=>'Your Address is required',
                                'alpha_numeric_space'=>'Please enter valid Address.']
                ],*/
                'email'=>[
                    'rules'=>'required|valid_email|is_unique[tbl_internship_enrollment.email,ie_id,'.$ie_id.']',
                    'errors'=>['required'=>'Email is required',
                                'valid_email'=>'You must enter a valid email',
                                'is_unique'=>'This email is already registered in our system',
                            ]
                ],
                'phone'=>[
                    'rules'=>'required|is_natural|min_length[10]|max_length[10]',
                    'errors'=>['required'=>'Mobile No is required',
                                'is_natural'=>'The Mobile No must only contain digits.',
                                'min_length'=>'Mobile No must be 10 digit in length',
                                'max_length'=>'Mobile No must not have more than 10 digit in length']
                ],
                'dob' => [
                    'rules' =>  'required',
                    'errors' => [
                        'required'   => 'Date of Birth is required.',
                        'valid_date' => 'Please enter a valid date.',
                    ]
                ],
                'gender' => ['rules' => 'required'],
                'aadhar' => ['rules' => 'required|min_length[12]|max_length[12]']
                /*
                'password'=>[
                    'rules'=>'required|min_length[6]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/]',
                    'errors'=>['required'=>'Password is required',
                                'min_length'=>'Password must have atleast 6 character in length',
                                // 'max_length'=>'Password must not have characters more than 16 in length',
                                'regex_match' => 'The password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.',
                                ]
                ],
                'cpassword'=>[
                    'rules'=>'required|matches[password]',
                    'errors'=>['required'=>'Confirm Password is required',
                                'matches'=>'Confirm Password not matches to password']
                ], */
                //'g-recaptcha-response'=>['rules'=>'required','errors'=>['required'=>'recaptcha is required']]
            ];
            if($profile->image == null){
                $rules['image'] = [
                    'rules'=>'uploaded[image]|max_size[image,100]|ext_in[image,png,jpg,jpeg,bmp,gif]',
                    // 'rules'=>'max_size[lsn_file,10240]|ext_in[lsn_file,pdf]',
                    'errors'=>[
                    'uploaded'=>'Image is required.',
                    'max_size'=>'The image must not be larger than 100 KB.',
                    'ext_in'=>'Only Image file(png,jpg,jpeg,bmp,gif) upload!',
                    ]
                ];
            }else{
                $rules['image'] = [
                    'rules'=>'max_size[image,100]|ext_in[image,png,jpg,jpeg,bmp,gif]',
                    // 'rules'=>'max_size[lsn_file,10240]|ext_in[lsn_file,pdf]',
                    'errors'=>[
                    'max_size'=>'The image must not be larger than 100 KB.',
                    'ext_in'=>'Only Image file(png,jpg,jpeg,bmp,gif) upload!',
                    ]
                ];
            }
            
            $validation = $this->validate($rules);
            if(!$validation){
                $data['validation'] = $this->validator; 
            }else{
                $post = array();
                if($_FILES['image']['name'] != ''){
                    if($img = $this->request->getFile('image')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'int_stu_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                            
                            $post['image'] = $newName;
                        }
                    }
                }
                $post['stu_name']       = trim($this->request->getPost('stu_name'));
                $post['email']          = $this->request->getPost('email');
                // $post['address']        = trim($this->request->getPost('address'));
                $post['phone']          = $this->request->getPost('phone');
                $post['dob']            = date('Y-m-d', strtotime($this->request->getPost('dob')));
                $post['genger']         = $this->request->getPost('gender');
                $post['aadhar']       = $this->request->getPost('aadhar');
                $post['f_name']       = $this->request->getPost('f_name');
                $post['m_name']       = $this->request->getPost('m_name');
                $post['full_address'] = json_encode(
                    [
                        'add' => $this->request->getPost('address'),
                        'dist' => $this->request->getPost('district'),
                        'state' => $this->request->getPost('state'),
                        'pincode' => $this->request->getPost('pincode'),
                    ]
                );
                $post['academic'] = json_encode(
                    [
                        'board1' => $this->request->getPost('board1'),
                        'passyear1' => $this->request->getPost('passyear1'),
                        'percentage1' => $this->request->getPost('percentage1'),
                        'board2' => $this->request->getPost('board2'),
                        'passyear2' => $this->request->getPost('passyear2'),
                        'percentage2' => $this->request->getPost('percentage2'),
                    ]
                );
                $post['status']        = 1;
                $post['profile_completed'] = 1;
                // do{
                //     $No1 = mt_rand(10000, 10500);
                //     $is_exist = $this->commonmodel->getAllRecordCount('tbl_members',['member_code'=>$No1]);
                // } while($is_exist);
                // $post['member_code'] = $No1;
                $updated = $this->commonmodel->updateRecord('tbl_internship_enrollment', $post, ['ie_id'=>$ie_id]); 
                if($updated){
                    $user_info = $this->commonmodel->getOneRecord('tbl_internship_enrollment',['ie_id'=>$ie_id]);
                    session()->set(array(
                        'stu_name' => $user_info->stu_name,
                        'email' => $user_info->email,
                        'phone' => $user_info->phone,
                        'image' => $user_info->image,
                        'status' => $user_info->status,
                        'profile_completed' => $user_info->profile_completed,
                        'internIsLoggedIn' => true,
                    ));
                    session()->setFlashdata(['message'=>'Profile completed successfully. you can access internship course','type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong. Please Try After Sometimes...','type'=>'danger']);
                }
                
                return redirect()->to(base_url('/internship/profile'));
            }
        }
        $data['profile'] = $profile;
        echo view('include/header', $data);
        echo view('internship/profile', $data);
        echo view('include/footer', $data);
    }
    public function edit_profile($ie_id){
        if($this->commonmodel->updateRecord('tbl_internship_enrollment',['profile_completed'=>0, 'status'=>0, 'update_at'=>date('Y-m-d H:i:s')],['ie_id'=>$ie_id])){
            session()->set('profile_completed', 0);
            session()->set('status', 0);
            session()->setFlashdata(['message'=>'You can edit your profile.','type'=>'success']);
        }else{
            session()->setFlashdata(['message'=>'Something went wrong. Please Try After Sometimes...','type'=>'danger']);
        }
        return redirect()->to(base_url('/internship/profile'));
    }
    public function courses(){
        $ie_id = session('ie_id');
        $data['records'] = $this->servicemodel->get_applied_internship_courses($ie_id);
        echo view('include/header', $data);
        echo view('internship/courses', $data);
        echo view('include/footer', $data);
    }
    public function update_refund_status($ia_id){
        $internApp = $this->commonmodel->getOneRecord('tbl_internship_applications', ['ia_id'=>$ia_id]);
        if(!empty($internApp) && $internApp->refund_id != null){
            $refund_id = $internApp->refund_id;
            $refund = $this->refund_status($refund_id);
            if(isset($refund['status']) && $refund['status'] == true){
                $data = $refund['data'];
                $iaUpdateData = array(
                    'refund_status' => $data['status'],
                    'refund_updated' => date('Y-m-d H:i:s'),
                );
                $updated = $this->commonmodel->updateRecord('tbl_internship_applications', $iaUpdateData, ['ia_id'=>$ia_id]);
                
                session()->setFlashdata(['message'=>'The refund status has been updated successfully.','type'=>'success']);
            }else{
                $message = $refund['message'];
                session()->setFlashdata(['message'=>$message,'type'=>'danger']);
            }
        }
        return redirect()->to(base_url('internship/courses'));
    }
    public function add_edit_course($ia_id = null){
        $ia_id = ($ia_id != null)?base64_decode($ia_id):'';
        $ie_id = session('ie_id');
        // echo $ia_id;
        
        if ($this->request->getMethod() === 'post'){
            $validation = $this->validate([
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
            
            ]);
            if(!$validation){
                $data['validation'] = $this->validator;
                //return view('admin/users/add_user',$this->data);
            }else{
                if($ia_id && $ia_id == $_POST['ia_id']){
                    $updateData = array(
                        'uni_roll_no' => $this->request->getPost('uni_roll_no'),
                        'uni_reg_no' => $this->request->getPost('uni_reg_no'),
                        'class' => $this->request->getPost('class'),
                        'mjc_id' => $this->request->getPost('mjc_id'),
                        'session' => $this->request->getPost('session'),
                        'semester' => $this->request->getPost('semester'),
                        'clg_id' => $this->request->getPost('clg_id'),
                        'ic_id' => $this->request->getPost('ic_id'),
                        // 'duration' => $tempStudtls->duration,
                        'terms' => $_POST['terms'] ?? 1,
                        'update_at' => date('Y-m-d H:i:s')
                    );
                    $updated = $this->commonmodel->updateRecord('tbl_internship_applications', $updateData, ['ia_id'=>$ia_id, 'ie_id'=>$ie_id]);
                    if ($updated) {
                        session()->setFlashdata([
                            'message' => 'Record updated successfully!',
                            'type'    => 'success'
                        ]);
                    } else {
                        session()->setFlashdata([
                            'message' => 'Something went wrong. Please try again.',
                            'type'    => 'danger'
                        ]);
                    }
                    return redirect()->to(base_url('internship/update-course/'.base64_encode($ia_id)));
                }else{
                    $member = $this->commonmodel->getOneRecord('tbl_internship_enrollment',['ie_id'=>$ie_id]);
                    $tempStudtls = json_encode($_POST);
                    $te_id = $this->commonmodel->insertRecord('tbl_temp_enrollment', ['form_details'=>$tempStudtls, 'added_at'=>date('Y-m-d H:i:s')]);
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
                        'customer_name' => $member->stu_name,
                        'customer_email' => $member->email,
                        'customer_phone' => $member->phone,
                        'verify_url' => base_url('internship/verify_razor_payment'),
                    ];
                    $this->makePayment($razorConfig);
                }
            }
        }
        if($ia_id){
            $data['record'] = $this->commonmodel->getOneRecord('tbl_internship_applications',['ia_id'=>$ia_id,'ie_id'=>$ie_id,'status'=>1]);
        }
        $data['mjc'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_mjcsubject',['status'=>1],['sub_name','ASC']);
        $data['colleges'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_colleges',['status'=>1],['college_name','ASC']);
        $data['internCourse'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_intern_course', ['status'=>1],['ic_name','ASC']);
        echo view('include/header', $data);
        echo view('internship/add_edit_course', $data);
        echo view('include/footer', $data);
    }
    public function verify_razor_payment(){
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
            
            $this->commonmodel->deleteRecord('tbl_temp_enrollment',['te_id'=>$te_id]);

            //insert into 'tbl_internship_applications'
            do{
                $randomNo = rand(1000,9999);
                $enrollId = 'ENR' . date('Ymd') . $randomNo;
                $is_exist = $this->commonmodel->getAllRecordCount('tbl_internship_applications',['enroll_id'=>$enrollId]);
            }while($is_exist);
            $internCourse = $this->commonmodel->getOneRecord('tbl_intern_course',['ic_id'=>$tempStudtls->ic_id]);
            
            $internAppData = array(
                'ie_id' => session('ie_id'),
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
            $ia_id = $this->commonmodel->insertRecord('tbl_internship_applications',$internAppData);
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
                $this->commonmodel->insertRecord('tbl_payment_transaction',$paymentTransactionData);
            }
            
            $mpdfController = new MpdfController();
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
            
            return redirect()->to(
                base_url('internship/payment-success') . '?' . http_build_query([
                    'application_id' => $enrollId,
                    'stu_name' => $member->stu_name,
                    'intern_course' => ucwords($internCourse->ic_name ?? 'Internship Program'),
                ])
            );

            exit;
        }else{
            session()->setFlashdata(['message'=>'Unable to complete your internship registration. Payment was unsuccessful or an error occurred. Please try again.','type'=>'danger']);
        }
        
        return redirect()->to(base_url('internship/courses'));
    }
    public function payment_success(){
        $data = [
            'application_id' => $this->request->getGet('application_id'),
            'stu_name'       => $this->request->getGet('stu_name'),
            'intern_course'  => $this->request->getGet('intern_course'),
        ];

        echo view('include/header', $data);
        echo view('internship/payment_success', $data);
        echo view('include/footer', $data);
    }
    public function change_password(){
        $data = [];
        $ie_id = session('ie_id');
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'password' => [
                    'rules' => 'required|min_length[6]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/]',
                    'errors' => [
                        'required'     => 'Password is required.',
                        'min_length'   => 'Password must be at least 6 characters long.',
                        'regex_match'  => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
                    ]
                ],
                'cpassword' => [
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => 'Confirm Password is required.',
                        'matches'  => 'Confirm Password does not match the Password.'
                    ]
                ]
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $post = ['password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                        'update_at'=>date('Y-m-d H:i:s')];
                $updated = $this->commonmodel->updateRecord('tbl_internship_enrollment',$post,['ie_id' => $ie_id]);
                if ($updated) {
                    session()->setFlashdata([
                        'message' => 'Password has been changed successfully!',
                        'type'    => 'success'
                    ]);
                } else {
                    session()->setFlashdata([
                        'message' => 'Something went wrong. Please try again.',
                        'type'    => 'danger'
                    ]);
                }
                return redirect()->to(base_url('internship/change-password'));
            }
        }
        echo view('include/header', $data);
        echo view('internship/change_password', $data);
        echo view('include/footer', $data);
    }
    public function logout(){
        session()->destroy();
        return redirect()->to(base_url('internship/login'))->with('alert_error','You have successfully logged out!');
    }
    // public function testverify(){
    //     echo view('include/header');
    //     echo view('internship/payment_verify_loader');
    //     echo view('include/footer');
    // }
}