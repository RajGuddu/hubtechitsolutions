<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;

class Home extends BaseController
{
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

                    $email->setFrom($this->request->getPost('email'), $this->request->getPost('name'));
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
}
