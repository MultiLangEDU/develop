<?php
class Classes extends MY_Controller{

	function __construct()
    {
		parent::__construct();
	}
    
    public function index($page = 0)
    {
        /* Start Pagination */

        $num_pages = $this->classes_model->countRows();

        $this->load->library('pagination');
        $config=array(
            'base_url'         => site_url('admin/classes/index'),
            'total_rows'     => $num_pages,
            'per_page'         => 20,
            'num_links'        => 3,
            'uri_segment'        => 4
        );

        $config['full_tag_open'] = '<ul class="pagination pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        
        $this->pagination->initialize($config);

        $data = array(
            'classes' => $this->classes_model->getRecords($config['per_page'], $page),
            'pagination' => $this->pagination->create_links(),
        );
        $this->load->admin_view('classes/index', $data);
    }
    
    public function add_edit($id = null)
    {
        $this->load->library('form_validation');
        if($this->input->post()){
            $this->save($id);
        }

        $row = $this->classes_model->getRecord($id);
        if(empty($row)){
            $row = new stdClass();
            $row->id = '';
            $row->course_id = '';
            $row->name = '';
            $row->description = '';
        }

        $data = array(
            'row' => $row,
            'courses' => $this->courses_model->getRecords(),
        );

        $this->load->admin_view('classes/add_edit',$data);
    }
    
    /*Delete Function*/
    
    public function delete($id)
    {
    	$this->classes_model->deleteRow($id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    private function save($id)
    {
        $this->form_validation->set_rules('course', 'Course', 'trim|required|xss_clean|is_natural_no_zero');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean|min_length[2]');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');

        
        if(!$this->form_validation->run()){
            return FALSE;
        }

        $insert_data = array(
            'course_id' => $this->input->post('course'),
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
        );
        
        if(is_numeric($id)){
            $this->classes_model->update($id, $insert_data);
        } else{
            $insert_data['create_date'] = date('Y-m-d');
            $this->classes_model->insert($insert_data);
        }
        redirect('admin/classes');
    }
    
}