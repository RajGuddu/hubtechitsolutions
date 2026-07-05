<?php
namespace App\Models;
use CodeIgniter\Model;
class Admin_model extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->adminTbl = 'tbl_admin';
        $this->rolePrivilegeTbl = 'tbl_role_privilege';
        $this->coursesTbl = 'tbl_courses';
        $this->coursecategoryTbl = 'tbl_course_category';
        $this->contactusTbl = 'tbl_contact_us';
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
    
}