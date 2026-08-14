<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use App\Traits\RazorpayTrait;

class Internship extends BaseController
{
    use RazorpayTrait;

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
    
    public function index($ie_id=null)
    {
        if($this->request->getMethod() == 'post'){
            session()->set(
                'intern_student_search',
                trim($this->request->getPost('search'))
            ); 
            session()->set(
                'intern_student_status', $this->request->getPost('status')
            ); 
            session()->set(
                'intern_course_status', $this->request->getPost('cstatus')
            ); 
        }
        // $this->servicemodel->get_internship_students();exit;
        $totRecord = $this->servicemodel->get_internship_students('', $count=1);
        $rec_limit = 10;
        $page_config = array(
            'tot_record' => $totRecord,
            'rec_limit' => $rec_limit,
            'btn_limit' => 5,
            'current_page' => (isset($_GET['page']) && $_GET['page'] != '')?$_GET['page']:0,
            'url' => current_url(),
            'url_param' => 'page',
            'colspan' => 13,
        );
        $cp_data = custom_pagination($page_config);
        // print_r($cp_data); exit;
        $limit = $cp_data['limit'];
        $offset = $cp_data['offset'];
        $this->data['pagination'] = $cp_data['pagination_html'];
        $this->data['records'] = $this->servicemodel->get_internship_students('','',$limit, $offset);
        if($ie_id == null && isset($this->data['records'][0]->ie_id)){
            $ie_id = $this->data['records'][0]->ie_id;
        }
        $this->data['record'] = $this->servicemodel->get_internship_students($ie_id);
        $this->data['courses'] = $this->servicemodel->get_applied_internship_courses($ie_id);
        $this->data['caption'] = $cp_data['caption'];
        return view("admin/internship/internstulist",$this->data);
        
    }
    public function reset_search(){
        session()->remove('intern_student_search');
        session()->remove('intern_student_status');
        session()->remove('intern_course_status');

        return redirect()->to(base_url('admin/intern-students'));
    }
    public function refund_amount(){
        // print_r($_POST);
        if($this->request->getMethod() == 'post'){
            $ia_id = $this->request->getPost('ia_id');
            $amount    = $this->request->getPost('amount');
            $reason    = $this->request->getPost('reason');

            $internApp = $this->commonmodel->getOneRecord('tbl_internship_applications', ['ia_id'=>$ia_id]);
            if(!empty($internApp)){
                $payment_id = $internApp->razor_payment_id;
                $razorConfig['payment_id'] = $payment_id;
                $razorConfig['amount'] = (int) $amount * 100;
                $refund = $this->refundPayment($razorConfig);

                if(isset($refund['status']) && $refund['status'] == true){
                    $data = $refund['data'];
                    $iaUpdateData = array(
                        'status' => 5,
                        'refund_id' => $data['id'],
                        'refund_amount' => $amount,
                        'refund_status' => $data['status'],
                        'refund_reason' => $reason,
                        'refund_date' => date('Y-m-d H:i:s', $data['created_at']),

                    );
                    $updated = $this->commonmodel->updateRecord('tbl_internship_applications', $iaUpdateData, ['ia_id'=>$ia_id]);
                    if($updated){
                        $this->commonmodel->updateRecord('tbl_payment_transaction', ['payment_status'=>'Refund'], ['ia_id'=>$ia_id,'razor_payment_id'=>$payment_id]);
                    }
                    session()->setFlashdata(['message'=>'Refund has been initiated successfully. Please click "Refresh Status" to sync the latest refund status from the payment gateway.','type'=>'success']);

                }else{
                    $message = $refund['message'];
                    session()->setFlashdata(['message'=>$message,'type'=>'danger']);
                }
            }
        }
        return redirect()->to(base_url('admin/intern-students'));
    }
    public function update_refund_status($ia_id){
        $internApp = $this->commonmodel->getOneRecord('tbl_internship_applications', ['ia_id'=>$ia_id]);
        $ie_id = $internApp->ie_id ?? '';
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
        return redirect()->to(base_url('admin/intern-students/'.$ie_id));
    }
}