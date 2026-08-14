<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
// use App\Traits\RazorpayTrait;
class InternCourse extends BaseController
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
    
    public function index($ic_id=null)
    {
        if ($this->request->getMethod() === 'post') {
            // print_r($_POST); exit;
            $id = $this->request->getPost('id');
            $rules = [
                'ic_name'      => ['rules'=>'required','errors'=>['required'=>'Subject name is required']],
                // 'short_desc'    => 'required',
                // 'fee'           => 'required|numeric|greater_than[0]',
                // 'duration'      => 'required|numeric|greater_than[0]',
                'exam_ques'     => 'required|numeric|greater_than[0]',
                'exam_duration' => 'required|numeric|greater_than[0]',
            ];
            $file = $this->request->getFile('c_pdf');
            if (!$id || ($file && $file->isValid() && !$file->hasMoved())) {
                $rules['c_pdf'] = 'uploaded[c_pdf]|ext_in[c_pdf,pdf]|max_size[c_pdf,2048]';
            }
            $file2 = $this->request->getFile('project_part2');
            if (!$id || ($file2 && $file2->isValid() && !$file2->hasMoved())) {
                $rules['project_part2'] = 'uploaded[project_part2]|ext_in[project_part2,pdf]|max_size[project_part2,2048]';
            }
            $validation = $this->validate($rules);
            if (!$validation) {
                $this->data['validation'] = $this->validator;
            }else{
                $post = [];
                // Study PDF
                $file = $this->request->getFile('c_pdf');
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    do {
                        $pdfFilename = 'cpdf-' . bin2hex(random_bytes(4)) . '.pdf';
                        $exists = $this->commonmodel->isExists('tbl_intern_course', ['c_pdf' => $pdfFilename]);
                    } while ($exists);
                    $file->move('./'.PDF_PATH, $pdfFilename);
                    if (!empty($this->request->getPost('old_c_pdf'))) {
                        $old ='./'.PDF_PATH. $this->request->getPost('old_c_pdf');
                        if (file_exists($old)) {
                            unlink($old);
                        }
                    }
                    $post['c_pdf'] = $pdfFilename;
                }
                // Project PDF
                $file2 = $this->request->getFile('project_part2');
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
                }
                $post['ic_name']      = $this->request->getPost('ic_name');
                // $post['short_desc']    = $this->request->getPost('short_desc');
                // $post['fee']           = $this->request->getPost('fee');
                $post['duration']      = 120;
                $post['exam_ques']     = $this->request->getPost('exam_ques');
                $minutes = $this->request->getPost('exam_duration');
                $post['exam_duration'] = gmdate("H:i:s", $minutes * 60);
                $post['status'] = $this->request->getPost('status');
                if (empty($id)) {
                    $post['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_intern_course', $post);
                    if ($inserted) {
                        session()->setFlashdata(['message'=>'Record Added Successfully','type'=>'success']);
                    }
                } else {
                    $post['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_intern_course', $post, ['ic_id' => $id] );
                    if ($updated) {
                        session()->setFlashdata(['message'=>'Record updated successfully!','type'=>'success']);
                    }
                }
                if (empty($inserted) && empty($updated)) {
                    session()->setFlashdata(['message'=>'Please try again later.','type'=>'danger']);
                }
                return redirect()->to(site_url('admin/intern_course'));
            }
        }
        if($ic_id){
            $this->data['record'] = $this->commonmodel->getOneRecord('tbl_intern_course',['ic_id'=>$ic_id]);
        }
        $this->data['records'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_intern_course','',['ic_id','DESC']);
        return view("admin/internship/internCourse",$this->data);
        
    }
    public function delete_intern_course($id = null){
        if ($id) {
            $record = $this->commonmodel->getOneRecord('tbl_intern_course', ['ic_id' => $id]);
            if (!empty($record)) {
                // Study PDF Delete
                if (!empty($record->c_pdf)) {
                    $pdf = './' . PDF_PATH . $record->c_pdf;
                    if (file_exists($pdf)) {
                        unlink($pdf);
                    }
                }
                /*// Project PDF Delete
                if (!empty($record->project_part2)) {
                    $pdf = FCPATH . PDF_PATH . $record->project_part2;
                    if (file_exists($pdf)) {
                        unlink($pdf);
                    }
                }*/
                if ($this->commonmodel->deleteRecord('tbl_intern_course', ['ic_id' => $id])) {
                    session()->setFlashdata('message', 'Record Deleted Successfully.');
                    session()->setFlashdata('type', 'success');
                } else {
                    session()->setFlashdata('message', 'Please try again later.');
                    session()->setFlashdata('type', 'danger');
                }
            }
        }
        return redirect()->to(site_url('admin/intern_course'));
    }
}