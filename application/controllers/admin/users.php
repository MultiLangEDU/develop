<?php
class Users extends MY_Controller{
	
	var $logged_in_user;

	function __construct()
    {
		parent::__construct();
	}
    
    public function index($page = 0)
    {
    	$this->load->model('users_model');
        /* Start Pagination */

        $num_pages = $this->users_model->countRows();
        $this->load->library('pagination');
        $config=array(
            'base_url'         => site_url('admin/users/index/'),
            'total_rows'     => $num_pages,
            'per_page'         => 8,
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
            'users' => $this->users_model->getRecords($config['per_page'], $page),
            'pagination' => $this->pagination->create_links(),
        );
        $this->load->admin_view('users/index', $data);
    }
    
    public function add_edit($id = null)
    {
        $this->load->library('form_validation');
        if($this->input->post()){
            $this->save($id);
        }

        $row = $this->users_model->getRecord($id);
        if(empty($row)){
            $row = new stdClass();
            $row->id = '';
            $row->email = '';
            $row->password = '';
            $row->first_name = '';
            $row->last_name = '';
            $row->address = '';
            $row->city = '';
            $row->zip = '';
            $row->country = '';
            $row->telephone = '';
            $row->user_type = '';
        }

        $data = array(
            'row' => $row,
            'users_types' => $this->users_model->getUserTypes(),
        );

        $this->load->admin_view('users/add_edit',$data);
    }
    
    /*Delete Function*/
    
    public function delete($id)
    {
    	$this->load->model('users_model');
    	$this->users_model->deleteUser($id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    private function save($id)
    {
        if(!is_numeric($id)){
            $this->form_validation->set_rules('email','Email' ,'trim|required|valid_email|callback_cb_emailAlreadyExists');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');    
        } else{
            $password = $this->input->post('password');
            if(!empty($password)){
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
            }
        }
        
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim');
        $this->form_validation->set_rules('city', 'City', 'trim');
        $this->form_validation->set_rules('zip', 'zip', 'trim');
        $this->form_validation->set_rules('country', 'country', 'trim');
        $this->form_validation->set_rules('telephone', 'telephone', 'trim');
        $this->form_validation->set_rules('type', 'Type', 'trim');

        
        if(!$this->form_validation->run()){
            return FALSE;
        }

        $insert_data = array(
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'zip' => $this->input->post('zip'),
            'country' => $this->input->post('country'),
            'telephone' => $this->input->post('telephone'),
            'user_type' => $this->input->post('type'),
        );
        
        if(is_numeric($id)){
            $this->users_model->updateUser($id,$this->input->post('email'), $password, $this->input->post('first_name'),$this->input->post('last_name'), $insert_data);
        } else{
            $data['userId'] = $this->users_model->registerUserNew($this->input->post('email'),$this->input->post('first_name'),$this->input->post('last_name'),$this->input->post('password'), $insert_data);
        }
        redirect('admin/users');
    }
    
    function cb_emailAlreadyExists($email){
        $exists = $this->users_model->getUserByEmail($email);
        if ($exists){
            $this->form_validation->set_message('cb_emailAlreadyExists', 'Email already exists');
            return FALSE;
        }
        return TRUE;
    }
    
}