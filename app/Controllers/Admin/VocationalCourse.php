<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
// use App\Traits\RazorpayTrait;
class VocationalCourse extends BaseController
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
    
    public function index($vc_id=null)
    {
        if ($this->request->getMethod() === 'post') {
            // print_r($_POST); exit;
            $id = $this->request->getPost('id');
            $rules = [
                'course_name'      => ['rules'=>'required','errors'=>['required'=>'Course name is required']],
                'course_short_name'      => ['rules'=>'required','errors'=>['required'=>'Course short name is required']],
                'duration'    => 'required',
                'exam_fee'           => 'required|numeric|greater_than[0]',
                'course_fee'      => 'required|numeric|greater_than[0]',
                'sort_order'           => 'required|numeric|greater_than[0]',
                'total_questions'     => 'required|numeric|greater_than[0]',
                'exam_duration'     => 'required|numeric|greater_than[0]',
                'icon' => 'required',
                'icon_color' => 'required',
            ];
            /*$file = $this->request->getFile('c_pdf');
            if (!$id || ($file && $file->isValid() && !$file->hasMoved())) {
                $rules['c_pdf'] = 'uploaded[c_pdf]|ext_in[c_pdf,pdf]|max_size[c_pdf,2048]';
            }
            $file2 = $this->request->getFile('project_part2');
            if (!$id || ($file2 && $file2->isValid() && !$file2->hasMoved())) {
                $rules['project_part2'] = 'uploaded[project_part2]|ext_in[project_part2,pdf]|max_size[project_part2,2048]';
            }*/
            $validation = $this->validate($rules);
            if (!$validation) {
                $this->data['validation'] = $this->validator;
            }else{
                $post = [];
                // Study PDF
                /*$file = $this->request->getFile('c_pdf');
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
                }*/
                $post['course_name']      = $this->request->getPost('course_name');
                $post['course_short_name']    = $this->request->getPost('course_short_name');
                $post['duration']           = $this->request->getPost('duration');
                $post['exam_fee']      = $this->request->getPost('exam_fee');
                $post['course_fee']      = $this->request->getPost('course_fee');
                $post['total_questions']     = $this->request->getPost('total_questions');
                $minutes = $this->request->getPost('exam_duration');
                $post['exam_duration'] = gmdate("H:i:s", $minutes * 60);
                $post['icon']     = $this->request->getPost('icon');
                $post['icon_color']     = $this->request->getPost('icon_color');

                $post['status'] = $this->request->getPost('status');
                if (empty($id)) {
                    $post['created_at'] = date('Y-m-d H:i:s');
                    $id = $inserted = $this->commonmodel->insertRecord('tbl_vocational_course', $post);
                    if ($id) {
                        session()->setFlashdata(['message'=>'Record Added Successfully','type'=>'success']);
                    }
                } else {
                    $post['updated_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_vocational_course', $post, ['vc_id' => $id] );
                    if ($updated) {
                        session()->setFlashdata(['message'=>'Record updated successfully!','type'=>'success']);
                    }
                }
                if (empty($inserted) && empty($updated)) {
                    session()->setFlashdata(['message'=>'Please try again later.','type'=>'danger']);
                }
                //set order
                $newOrder  = (int) $this->request->getPost('sort_order');
                $oldOrder = (int) $this->request->getPost('old_order');

                $totRecord = $this->commonmodel->getAllRecordCount('tbl_vocational_course');
                if($vc_id && $newOrder > $totRecord){
                    $newOrder = $totRecord;
                }elseif(!$vc_id && $newOrder > $_POST['new_order']){
                    $newOrder = $_POST['new_order'];
                }

                $table = $this->db->table('tbl_vocational_course');
                if ($oldOrder != $newOrder) {
                    if ($newOrder < $oldOrder) {

                        $table->where('vc_id !=', $id)
                            ->where('sort_order >=', $newOrder)
                            ->where('sort_order <', $oldOrder)
                            ->set('sort_order', 'sort_order + 1', false)
                            ->update();

                    } else {

                        $table->where('vc_id !=', $id)
                            ->where('sort_order >', $oldOrder)
                            ->where('sort_order <=', $newOrder)
                            ->set('sort_order', 'sort_order - 1', false)
                            ->update();
                    }
                }
                
                $updated = $this->commonmodel->updateRecord('tbl_vocational_course', ['sort_order'=>$newOrder], ['vc_id' => $id] );
                return redirect()->to(site_url('admin/vocational-course'));
            }
        }
        if($vc_id){
            $this->data['record'] = $this->commonmodel->getOneRecord('tbl_vocational_course',['vc_id'=>$vc_id]);
        }
        $this->data['records'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_vocational_course','',['sort_order','ASC']);
        $this->data['newOrder'] = $this->commonmodel->getAllRecordCount('tbl_vocational_course') + 1;

        return view("admin/vocational/vocationalCourse",$this->data);
        
    }
    public function delete_v_course($id = null){
        
        if ($this->commonmodel->deleteRecord('tbl_vocational_course', ['vc_id' => $id])) {
            $records = $this->commonmodel->getAllRecordOrderByDesc('tbl_vocational_course','',['sort_order','ASC']);

            $order = 1;
            foreach ($records as $record) {
                $this->commonmodel->updateRecord('tbl_vocational_course', ['sort_order' => $order], ['vc_id'=>$record->vc_id]);
                $order++;
            }
            
            session()->setFlashdata('message', 'Record Deleted Successfully.');
            session()->setFlashdata('type', 'success');
        } else {
            session()->setFlashdata('message', 'Please try again later.');
            session()->setFlashdata('type', 'danger');
        }

        return redirect()->to(site_url('admin/vocational-course'));
    }
}