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
        $data = [];
        $this->commonmodel->updateRecord('tbl_internship_enrollment', ['is_click_voc'=>1], ['ie_id'=>$ie_id]);
        
        echo view('include/header', $data);
        echo view('vocationalProgram/programIndex', $data);
        echo view('include/footer', $data);
    }
}