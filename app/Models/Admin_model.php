<?php
namespace App\Models;
use CodeIgniter\Model;
class Admin_model extends Model
{
    public $adminTbl;
    public $rolePrivilegeTbl;
    public $coursesTbl;
    public $coursecategoryTbl;
    public $contactusTbl;
    public $admissionsTbl;
    public $batchTbl;
    public $qualificationTbl;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->adminTbl = 'tbl_admin';
        $this->rolePrivilegeTbl = 'tbl_role_privilege';
        $this->coursesTbl = 'tbl_courses';
        $this->coursecategoryTbl = 'tbl_course_category';
        $this->contactusTbl = 'tbl_contact_us';
        $this->admissionsTbl = 'tbl_admissions';
        $this->batchTbl = 'tbl_batch';
        $this->qualificationTbl = 'tbl_qualification';
    }
    public function getAllUsers($id=null){
        $builder = $this->db->table($this->adminTbl.' u');
        $builder->select('u.*,rp.post_name');
        $builder->join($this->rolePrivilegeTbl.' rp','u.privilege_id=rp.privilege_id','left');
        if($id != null){
            $builder->where('u.user_id', $id);
        }
        $query = $builder->get();
        if($id != null){
            $result = $query->getRow();
        }else{
            $result = $query->getResult();
        }
        return $result;
    }
    public function get_all_courses($id=null){
        $builder = $this->db->table($this->coursesTbl.' c');
        $builder->select('c.*,cc.course_category_name');
        $builder->join($this->coursecategoryTbl.' cc','c.ccat_id=cc.ccat_id','left');
        if($id != null){
            $builder->where('c.course_id', $id);
        }
        $query = $builder->get();
        if($id != null){
            $result = $query->getRow();
        }else{
            $result = $query->getResult();
        }
        return $result;
    }
    public function enquiry_and_enrollment_list($type=null){
        $status = (isset($_GET['st']) && $_GET['st'] > 1)?$_GET['st']:'';
        $builder = $this->db->table($this->contactusTbl.' c');
        $builder->select('c.*,cc.course_full_name');
        $builder->join($this->coursesTbl.' cc','c.course_id=cc.course_id','left');
        if($type == 'contact'){
            $builder->where('c.course_id <', 1);
        }else{
            $builder->where('c.course_id >=', 1);
        }
        if($status != ''){
            $builder->where('c.status', $status);
        }else{
            $builder->where('c.status', 1);
        }
        $builder->orderBy('c.id','DESC');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function count_enquiry_and_enrollment_list($type=null, $status=null){
        $builder = $this->db->table($this->contactusTbl);
        $builder->select('*');
        if($type == 'contact'){
            $builder->where('course_id <', 1);
        }else{
            $builder->where('course_id >=', 1);
        }
        if($status != null){
            $builder->where('status', $status);
        }
        $query = $builder->get();
        $result = $query->getNumRows();
        return $result;
    }
    public function get_admissions_list($whereArr=null, $status=null){
        $builder = $this->db->table($this->admissionsTbl.' a');
        $builder->select('a.*,c.course_name,b.batch_name,b.time_from,q.qualification qly_title');
        $builder->join($this->coursesTbl.' c','a.course_id=c.course_id','left');
        $builder->join($this->batchTbl.' b','a.batch_id=b.batch_id','left');
        $builder->join($this->qualificationTbl.' q','a.qualification=q.qly_id','left');

        $builder->groupStart();
        if($whereArr != null){
            $builder->where($whereArr);
        }
        if($status != null){
            $builder->where('a.status', $status);
        }else{
            $builder->where('a.status !=', '2');
        }
        $builder->groupEnd();
        if(isset($_GET['s']) && $_GET['s'] != ''){
            $builder->groupStart();
                $builder->like('a.stu_name', $_GET['s']);
                $builder->orLike('a.phone1', $_GET['s']);
                $builder->orLike('a.phone2', $_GET['s']);
                $builder->orLike('a.email', $_GET['s']);
            $builder->groupEnd();
        }
        if(isset($_GET['course']) && !empty($_GET['course'])){
            $builder->groupStart();
                foreach($_GET['course'] as $key=>$list){
                    if($key == 0){
                        $builder->where('a.course_id', $list);
                    }else{
                        $this->db->orWhere('a.course_id', $list);
                    } 
                }
            $builder->groupEnd();
        }
        if(isset($_GET['batch']) && !empty($_GET['batch'])){
            $builder->groupStart();
                foreach($_GET['batch'] as $key=>$list){
                    if($key == 0){
                        $builder->where('a.batch_id', $list);
                    }else{
                        $builder->orWhere('a.batch_id', $list);
                    } 
                }
            $builder->groupEnd();
        }
        if(isset($_GET['status']) && !empty($_GET['status'])){
            $builder->groupStart();
                $stat = ($_GET['status'] == 'o')?'0':'1';
                $builder->where('a.status', $stat);
            $builder->groupEnd();
        }

        $builder->limit(50);
        $query = $builder->get();
        if($whereArr != null){
            $result = $query->getRow();
        }else{
            $result = $query->getResult();
        }
        return $result;
    }
}