<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/***********************
Users model
************************/

class Courses_model extends MY_Model{
	
    public $table = 'courses';
    public $pk = 'id';
    
    public function getRecords($page = null, $per_page = null, $where = false)
    {
        if(!empty($where)){
            $this->db->where($where);
        }
        if(!is_null($page) && !is_null($per_page)){
            $this->db->limit($page, $per_page);    
        }
        $this->db->select('courses.*, count(classes.course_id) as total_classes');
        $this->db->join('classes', 'courses.id = classes.course_id', 'LEFT')->group_by('courses.id');
        return parent::getRecords();
    }

}