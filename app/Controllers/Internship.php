<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
class Internship extends BaseController
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
    
    public function index($ie_id=null)
    {
        if($this->request->getMethod() == 'post'){
           session()->set(
                'intern_student_search',
                trim($this->request->getPost('search'))
            ); 
        }
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
        $this->data['caption'] = $cp_data['caption'];
        return view("admin/internship/internstulist",$this->data);
        
    }
    public function reset_search(){
        session()->remove('intern_student_search');

        return redirect()->to(base_url('admin/intern-students'));
    }
}