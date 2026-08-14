<?php
namespace App\Models;
use CodeIgniter\Model;
class Service_model extends Model
{
    public $coursesTbl;
    public $instructorTbl;
    public $bannerTbl;
    public $pageTbl;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->coursesTbl = 'tbl_courses';
        $this->instructorTbl = 'tbl_instructor';
        $this->bannerTbl = 'tbl_banner';
        $this->pageTbl = 'tbl_page';
    }
    public function get_popular_courses(){
        $builder = $this->db->table($this->coursesTbl);
        $builder->where('is_popular', '1');
        $builder->where('status', 1);
        $builder->limit(3);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function get_all_courses(){
        $ccat_id = (isset($_GET['category']) && $_GET['category'] != '')?$_GET['category']:'';
        $builder = $this->db->table($this->coursesTbl);
        $builder->where('status', 1);
        if($ccat_id != ''){
            $builder->where('ccat_id', $ccat_id);
        }
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function get_one_course($url){
        $builder = $this->db->table($this->coursesTbl.' c');
        $builder->select('c.*, ins.ins_name,ins.ins_image,ins.post,ins.details,ins.facebook_link,ins.twitor_link,ins.linkedin_link,ins.youtube_link');
        $builder->join($this->instructorTbl.' ins', 'c.ins_id = ins.ins_id', 'left');
        $builder->where('c.url', $url);
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function get_count_courses($whereArr){
        $builder = $this->db->table($this->coursesTbl);
        $builder->where('status', 1);
        $builder->where($whereArr);
        $query = $builder->get();
        $result = $query->getNumRows();
        return $result;
    }
    public function get_searched_certificate($cert_no){
        $builder = $this->db->table('tbl_certificate_list');
        $builder->where('cert_no', $cert_no);
        $builder->orWhere('enrollment_no', $cert_no);
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function get_searched_internship_certificate($cert_no){
        $builder = $this->db->table('tbl_internship_applications ia');
        $builder->select('ia.*,ie.stu_name,ie.email,ie.phone,ie.image,c.ic_name');
        $builder->join('tbl_internship_enrollment ie', 'ia.ie_id = ie.ie_id', 'left');
        $builder->join('tbl_intern_course c', 'ia.ic_id = c.ic_id', 'left');

        $builder->groupStart();
        $builder->where('ia.enroll_id', $cert_no);
        $builder->orWhere('ia.cert_no', $cert_no);
        $builder->groupEnd();
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function get_internship_students($ie_id = null, $count=null,$limit=null, $offset=null){
        $result = [];
        $builder = $this->db->table('tbl_internship_enrollment');
        $builder->select('*');
        // $builder->join('tbl_mjcsubject mj', 'e.mjc_id = mj.mjc_id', 'left');
        // $builder->join('tbl_colleges cl', 'e.clg_id = cl.clg_id', 'left');
        // $builder->join('tbl_intern_course c', 'e.ic_id = c.ic_id', 'left');
        if($ie_id != null){
            $builder->where('ie_id', $ie_id);
        }
        $search = session('intern_student_search');
        if(!empty($search)){
            $builder->groupStart()
                ->like('stu_name', $search, 'after')
                ->orLike('email', $search, 'after')
                ->orLike('phone', $search, 'after')
                // ->orLike('enroll_id', $search, 'after')
                ->groupEnd();
        }

        $builder->orderBy('ie_id','DESC');
        $builder->limit($limit, $offset);
        $query = $builder->get();
        if($ie_id != null){
            $result = $query->getRow();
        }elseif($count != null){
            $result = $query->getNumRows();
        }else{
            $result = $query->getResult();
        }
        
        // echo '<pre>';print_r($result); exit;
        return $result;
    }
    // public function get_one_internship_student_detail($ie_id){ // not use
    //     $builder = $this->db->table('tbl_internship_enrollment e');
    //     $builder->select('e.*,mj.sub_name,cl.college_name,c.ic_name');
    //     $builder->join('tbl_mjcsubject mj', 'e.mjc_id = mj.mjc_id', 'left');
    //     $builder->join('tbl_colleges cl', 'e.clg_id = cl.clg_id', 'left');
    //     $builder->join('tbl_intern_course c', 'e.ic_id = c.ic_id', 'left');
        
    //     $builder->where('e.ie_id', $ie_id);
        
    //     $query = $builder->get();
    //     $result = $query->getRow();
        
    //     return $result;
    // }
    public function get_one_internship_course_detail($ia_id){
        $builder = $this->db->table('tbl_internship_applications ia');
        $builder->select('ia.*,ie.stu_name,ie.email,ie.phone,ie.image,c.ic_name,c.duration,c.exam_ques,c.exam_duration sub_exam_duration,mj.sub_name,cl.college_name');
        $builder->join('tbl_internship_enrollment ie', 'ia.ie_id = ie.ie_id', 'left');
        $builder->join('tbl_intern_course c', 'ia.ic_id = c.ic_id', 'left');
        $builder->join('tbl_mjcsubject mj', 'ia.mjc_id = mj.mjc_id', 'left');
        $builder->join('tbl_colleges cl', 'ia.clg_id = cl.clg_id', 'left');
        
        $builder->where('ia.ia_id', $ia_id);
        
        $query = $builder->get();
        $result = $query->getRow();
        
        return $result;
    }
    public function get_applied_internship_courses($ie_id){
        $builder = $this->db->table('tbl_internship_applications ia');
        $builder->select('ia.*,ie.stu_name,ie.email,ie.phone,ie.image,c.ic_name,c.c_pdf,c.project_part2,mj.sub_name mjc_subject,cl.college_name');
        $builder->join('tbl_internship_enrollment ie', 'ia.ie_id = ie.ie_id', 'left');
        $builder->join('tbl_intern_course c', 'ia.ic_id = c.ic_id', 'left');
        $builder->join('tbl_mjcsubject mj', 'ia.mjc_id = mj.mjc_id', 'left');
        $builder->join('tbl_colleges cl', 'ia.clg_id = cl.clg_id', 'left');
        
        $builder->where('ia.ie_id', $ie_id);
        
        $query = $builder->get();
        $result = $query->getResult();
        
        return $result;
    }
    public function get_question_bank($ie_id = null, $count=null,$limit=null, $offset=null){
        $result = [];
        $builder = $this->db->table('tbl_question_bank qb');
        $builder->select('qb.*,ic.ic_name');
        $builder->join('tbl_intern_course ic', 'qb.ic_id = ic.ic_id', 'left');
        // $builder->join('tbl_colleges cl', 'e.clg_id = cl.clg_id', 'left');
        // $builder->join('tbl_intern_course c', 'e.ic_id = c.ic_id', 'left');
        if($ie_id != null){
            $builder->where('ie_id', $ie_id);
        }
        $search = session('s_ic_id');
        if(!empty($search)){
            $builder->groupStart()
                ->where('qb.ic_id', $search, 'after')
                // ->orLike('email', $search, 'after')
                // ->orLike('phone', $search, 'after')
                // ->orLike('enroll_id', $search, 'after')
                ->groupEnd();
        }

        $builder->orderBy('q_id','DESC');
        $builder->limit($limit, $offset);
        $query = $builder->get();
        if($ie_id != null){
            $result = $query->getRow();
        }elseif($count != null){
            $result = $query->getNumRows();
        }else{
            $result = $query->getResult();
        }
        
        // echo '<pre>';print_r($result); exit;
        return $result;
    }
    public function get_questions($ic_id, $quesLimit, $existQues=null){
        $builder = $this->db->table('tbl_question_bank');
        $builder->select('*');
        $builder->where('status', 1);
        $builder->where('ic_id', $ic_id);
        if (!empty($existQues)) {
            $ids = explode(',', $existQues); 
            $builder->whereNotIn('q_id', $ids);
        }
        $builder->orderBy('RAND()');
        $builder->limit($quesLimit);
        $query = $builder->get();

        // $query = $this->db->getLastQuery(); echo $query;exit;
        if($quesLimit == 0){
            $result = [];
        }else{
            $result = $query->getResult();
        }
        
        return $result;
    }
    public function get_grade($percent){
        $builder = $this->db->table('tbl_grade');

        $builder->select('*');
        $builder->where('marks_from <=', $percent);
        $builder->where('marks_to >=', $percent);

        $result = $builder->get()->getRow();

        return $result;
    }
    public function get_exam_review($ie_id){
        $result = [];
        $builder = $this->db->table('tbl_exam_review rv');
        $builder->select('rv.*,ic.ic_name');
        $builder->join('tbl_internship_applications ia', 'rv.ia_id = ia.ia_id', 'left');
        $builder->join('tbl_intern_course ic', 'ia.ic_id = ic.ic_id', 'left');
        // $builder->join('tbl_intern_course c', 'e.ic_id = c.ic_id', 'left');
        $builder->where('rv.ie_id', $ie_id);

        $builder->orderBy('rv.id','DESC');
        // $builder->limit($limit, $offset);
        $query = $builder->get();
        
        $result = $query->getResult();
        
        // echo '<pre>';print_r($result); exit;
        return $result;
    }
}