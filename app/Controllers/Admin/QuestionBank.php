<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
// use App\Traits\RazorpayTrait;
class QuestionBank extends BaseController
{
    // use RazorpayTrait;
    public $data;
    public $commonmodel;
    public $adminmodel;
    private $servicemodel;
    public function __construct()
    {
        $this->data['title'] = 'Admin-Internship-Course';
        $this->commonmodel = model('App\Models\Common_model', false);
        $this->servicemodel = model('App\Models\Service_model', false);
    }
    
    public function index($q_id=null)
    {
        if($this->request->getMethod() == 'post' && $this->request->getPost('form') == 'search_form'){
           session()->set(
                's_ic_id',
                trim($this->request->getPost('s_ic_id'))
            ); 
        }
        if ($this->request->getMethod() === 'post' && $this->request->getPost('form') == 'question_form') {
            // print_r($_POST); exit;
            $id = $this->request->getPost('id');
            $rules = [
                'ic_id'      => ['rules'=>'required','errors'=>['required'=>'Please select subject']],
                'question_title'      => ['rules'=>'required','errors'=>['required'=>'Question Title is required']],
                'opt_a'      => ['rules'=>'required','errors'=>['required'=>'Please provide option A']],
                'opt_b'      => ['rules'=>'required','errors'=>['required'=>'Please provide option B']],
                'opt_c'      => ['rules'=>'required','errors'=>['required'=>'Please provide option C']],
                'opt_d'      => ['rules'=>'required','errors'=>['required'=>'Please provide option D']],
                'correct_opt'      => ['rules'=>'required','errors'=>['required'=>'Please select correct option']],
            ];
            
            $validation = $this->validate($rules);
            if (!$validation) {
                $this->data['validation'] = $this->validator;
            }else{
                $post = [];
                session()->set('ic_id', $this->request->getPost('ic_id'));
                
                $post['ic_id']      = $this->request->getPost('ic_id');
                $post['question_title']    = $this->request->getPost('question_title');
                $post['opt_a']           = $this->request->getPost('opt_a');
                $post['opt_b']      = $this->request->getPost('opt_b');
                $post['opt_c']     = $this->request->getPost('opt_c');
                $post['opt_d']     = $this->request->getPost('opt_d');
                $post['correct_opt'] = $this->request->getPost('correct_opt');
                $post['status'] = $this->request->getPost('status');
                if (empty($id)) {
                    $post['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_question_bank', $post);
                    if ($inserted) {
                        session()->setFlashdata(['message'=>'Record Added Successfully','type'=>'success']);
                    }
                } else {
                    $post['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_question_bank', $post, ['q_id' => $id] );
                    if ($updated) {
                        session()->setFlashdata(['message'=>'Record updated successfully!','type'=>'success']);
                    }
                }
                if (empty($inserted) && empty($updated)) {
                    session()->setFlashdata(['message'=>'Please try again later.','type'=>'danger']);
                }
                if(empty($id)){
                    return redirect()->to(site_url('admin/question_bank?add=1'));
                }else{
                    return redirect()->to(site_url('admin/question_bank'));
                }
            }
        }
        //pagination
        $totRecord = $this->servicemodel->get_question_bank('', $count=1);
        $rec_limit = 10;
        $page_config = array(
            'tot_record' => $totRecord,
            'rec_limit' => $rec_limit,
            'btn_limit' => 5,
            'current_page' => (isset($_GET['page']) && $_GET['page'] != '')?$_GET['page']:0,
            'url' => current_url(),
            'url_param' => 'page',
            'colspan' => 9,
        );
        $cp_data = custom_pagination($page_config);
        // print_r($cp_data); exit;
        $limit = $cp_data['limit'];
        $offset = $cp_data['offset'];
        $this->data['pagination'] = $cp_data['pagination_html'];
        $this->data['caption'] = $cp_data['caption'];
        //end pagination
        if($q_id){
            $this->data['record'] = $this->commonmodel->getOneRecord('tbl_question_bank',['q_id'=>$q_id]);
        }
        $this->data['records'] = $this->servicemodel->get_question_bank('','',$limit, $offset);
        $this->data['subjects'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_intern_course',['status'=>1],['ic_name','ASC']);
        return view("admin/internship/question_bank",$this->data);
        
    }
    public function delete_question($id = null){
        if ($id) {
            $record = $this->commonmodel->getOneRecord('tbl_question_bank', ['q_id' => $id]);
            if (!empty($record)) {
                
                if ($this->commonmodel->deleteRecord('tbl_question_bank', ['q_id' => $id])) {
                    session()->setFlashdata('message', 'Record Deleted Successfully.');
                    session()->setFlashdata('type', 'success');
                } else {
                    session()->setFlashdata('message', 'Please try again later.');
                    session()->setFlashdata('type', 'danger');
                }
            }
        }
        return redirect()->to(site_url('admin/question_bank'));
    }
    public function reset_search(){
        session()->remove('s_ic_id');

        return redirect()->to(base_url('admin/question_bank'));
    }
}