<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
// use App\Traits\RazorpayTrait;
class Festival extends BaseController
{
    // use RazorpayTrait;
    public $data;
    public $commonmodel;
    public $adminmodel;
    private $servicemodel;
    private $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->data['title'] = 'Admin-Internship-Course';
        $this->commonmodel = model('App\Models\Common_model', false);
        $this->servicemodel = model('App\Models\Service_model', false);
    }
    
    public function index($id=null)
    {
        if ($this->request->getMethod() === 'post') {
            // print_r($_POST); exit;
            $id = $this->request->getPost('id');
            $rules = [
                'cert_title'      => ['rules'=>'required','errors'=>['required'=>'Certificate Title is required']],
                'festival_title'      => ['rules'=>'required','errors'=>['required'=>'Festival Title is required']],
                'festival_subtitle'      => ['rules'=>'required','errors'=>['required'=>'Festival Sub Title is required']],
                'image' => 'is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]|max_size[image,2048]',
                'date_from'    => 'required',
                'date_to'           => 'required',
                
            ];
            $file = $this->request->getFile('image');
            if (!$id || ($file && $file->isValid() && !$file->hasMoved())) {
                $rules['image'] = 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]|max_size[image,2048]';
            }
            /*$file2 = $this->request->getFile('project_part2');
            if (!$id || ($file2 && $file2->isValid() && !$file2->hasMoved())) {
                $rules['project_part2'] = 'uploaded[project_part2]|ext_in[project_part2,pdf]|max_size[project_part2,2048]';
            }*/
            $validation = $this->validate($rules);
            if (!$validation) {
                $this->data['validation'] = $this->validator;
            }else{
                $dateFrom = date('Y-m-d',strtotime($this->request->getPost('date_from')));
                $dateTo = date('Y-m-d',strtotime($this->request->getPost('date_to')));
                if($dateTo < $dateFrom){
                    session()->setFlashdata(['message'=>'Date To must be greater than or equal to Date From.','type'=>'danger']);
                    return redirect()->to(site_url('admin/festivals'));
                }
                $post = [];
                // Image
                $file = $this->request->getFile('image');
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    do {
                        $filename = 'fest-' . bin2hex(random_bytes(4)) . '.' . $file->getExtension();
                        $exists = $this->commonmodel->isExists('tbl_festival', ['image' => $filename]);
                    } while ($exists);
                    $file->move('./'.IMAGE_PATH, $filename);
                    if (!empty($this->request->getPost('old_image'))) {
                        $old ='./'.IMAGE_PATH. $this->request->getPost('old_image');
                        if (file_exists($old)) {
                            unlink($old);
                        }
                    }
                    $post['image'] = $filename;
                }
                // Project PDF
                /*$file2 = $this->request->getFile('project_part2');
                if ($file2 && $file2->isValid() && !$file2->hasMoved()) {
                    do {
                        $pdfFilename = 'prjpart2-' . bin2hex(random_bytes(4)) . '.pdf';
                        $exists = $this->commonmodel->isExists('tbl_intern_course', [
                            'project_part2' => $pdfFilename
                        ]);
                    } while ($exists);
                    $file2->move('./' . PDF_PATH, $pdfFilename);
                    if (!empty($this->request->getPost('old_project_part2'))) {
                        $old = './' . PDF_PATH . $this->request->getPost('old_project_part2');
                        if (file_exists($old)) {
                            unlink($old);
                        }
                    }
                    $post['project_part2'] = $pdfFilename;
                }*/
                $post['cert_title']      = $this->request->getPost('cert_title');
                $post['festival_title']      = $this->request->getPost('festival_title');
                $post['festival_subtitle']    = $this->request->getPost('festival_subtitle');
                $post['date_from']    = $dateFrom;
                $post['date_to']      = $dateTo;

                $post['status'] = $this->request->getPost('status');
                if (empty($id)) {
                    $post['added_at'] = date('Y-m-d H:i:s');
                    $id = $inserted = $this->commonmodel->insertRecord('tbl_festival', $post);
                    if ($id) {
                        session()->setFlashdata(['message'=>'Record Added Successfully','type'=>'success']);
                    }
                } else {
                    $updated = $this->commonmodel->updateRecord('tbl_festival', $post, ['id' => $id] );
                    if ($updated) {
                        session()->setFlashdata(['message'=>'Record updated successfully!','type'=>'success']);
                    }
                }
                if (empty($inserted) && empty($updated)) {
                    session()->setFlashdata(['message'=>'Please try again later.','type'=>'danger']);
                }
                
                return redirect()->to(site_url('admin/festivals'));
            }
        }
        if($id){
            $this->data['record'] = $this->commonmodel->getOneRecord('tbl_festival',['id'=>$id]);
        }
        $this->data['records'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_festival','',['date_to','ASC']);
        // $this->data['newOrder'] = $this->commonmodel->getAllRecordCount('tbl_vocational_course') + 1;

        return view("admin/festival/festivalIndex",$this->data);
        
    }
    public function delete_festival($id = null){
        
        $record = $this->commonmodel->getOneRecord('tbl_festival',['id'=>$id]);
        if (!empty($record->image)) {
            $image ='./'.IMAGE_PATH. $record->image;
            if (file_exists($image)) {
                unlink($image);
            }
        }
        if ($this->commonmodel->deleteRecord('tbl_festival', ['id' => $id])) {
            session()->setFlashdata('message', 'Record Deleted Successfully.');
            session()->setFlashdata('type', 'success');
        } else {
            session()->setFlashdata('message', 'Please try again later.');
            session()->setFlashdata('type', 'danger');
        }

        return redirect()->to(site_url('admin/festivals'));
    }
}