<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/***********************
Users model
************************/

class Classes_model extends MY_Model{
	
    public $table = 'classes';
    public $pk = 'id';
    
    public function getRecords($page = null, $per_page = null, $where = false)
    {
        if(!empty($where)){
            $this->db->where($where);
        }
        if(!is_null($page) && !is_null($per_page)){
            $this->db->limit($page, $per_page);    
        }
        $this->db->select('classes.*, courses.name as course_name');
        $this->db->join('courses', 'courses.id = classes.course_id');
        return parent::getRecords();
    }

}

