<?php
namespace App\Models;
use CodeIgniter\Model;
class Service_model extends Model
{
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
    /*public function getAllRecord($table, $whereArr = null){
        $builder = $this->db->table($table);
        if($whereArr != null){
            $builder->where($whereArr);
        }
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function getAllRecordOrderByDesc($table, $whereArr=null, $orderBy=null){
        $builder = $this->db->table($table);
        if($whereArr != null){
            $builder->where($whereArr);
        }
        if($orderBy != null){
           $builder->orderBy($orderBy[0],$orderBy[1]);
        }
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function getOneRecord($table, $whereArr = null){
        $builder = $this->db->table($table);
        if($whereArr != null){
            $builder->where($whereArr);
        }
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function insertRecord($table, $data){
        $builder = $this->db->table($table);
        $builder->Insert($data);
        return $this->db->insertID();
    }
    public function updateRecord($table, $data, $whereArr){
        $builder = $this->db->table($table);
        $builder->where($whereArr);
        $result = $builder->update($data);
        return $result;
    }
    public function deleteRecord($table, $whereArr){
        $builder = $this->db->table($table);
        $builder->where($whereArr);
        $result = $builder->delete();
        return $result;
    }
    public function get_setting($id=''){
        $builder = $this->db->table($this->settingTbl);
        $builder->where('id',$id);
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function update_setting($data='', $id){
        $builder = $this->db->table($this->settingTbl);
        $builder->where('id',$id);
        //$query = $builder->get();
        $result = $builder->update($data);
        return $result;
    }
    public function get_banners(){
        $builder = $this->db->table($this->bannerTbl.' b');
        $builder->select('b.*, p.page_name');
        $builder->join($this->pageTbl.' p', 'b.page = p.id');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }*/
    
}