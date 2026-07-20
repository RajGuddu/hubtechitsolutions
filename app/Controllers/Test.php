<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
class Test extends BaseController
{
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
    public function update(){
        // echo '<pre>';
        // $this->commonmodel->updateRecord('tbl_intern_course', ['exam_duration'=>'00:30:00'], ['status'=>1]);
        $this->commonmodel->updateRecord('tbl_intern_course', ['duration'=>120], ['status'=>1]);

        // $data = $this->commonmodel->getAllRecord('tbl_internship_enrollment');
        /*foreach($data as $li){
            // for password update
            // $password = password_hash('123456', PASSWORD_DEFAULT);
            // $this->commonmodel->updateRecord('tbl_internship_enrollment', ['password'=>$password],['ie_id'=>$li->ie_id]); 

            //make record tbl_internship_applications
            $internapp = $this->commonmodel->getOneRecord('tbl_internship_applications', ['ie_id'=>$li->ie_id]);
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
                    'added_at' => $li->added_at,
                );
                $this->commonmodel->insertRecord('tbl_internship_applications', $appdata); 
            }
        }*/
        // $data = $this->commonmodel->getAllRecord('tbl_internship_applications');
        // print_r($data);
        // $data = [];
        // echo view('include/header', $data);
        // echo view('intern_pay_success', $data);
        // echo view('include/footer', $data);
    }

}