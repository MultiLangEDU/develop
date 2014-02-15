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
        return parent::getRecords();
    }

}

