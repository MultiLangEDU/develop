<?php
class Login extends CI_Controller
{

	var $logged_in_user;

	function __construct(){

		parent::__construct();

		if ( ($this->auth->isLoggedIn()) && ($this->uri->segment(1) !== 'logout'))
			return redirect ("admin","location");

	}

    /***
    * Callback for checking email and password. Returns true if there is an email and password combination
    * 
    * @param mixed $email
    * @param mixed $passPostKey
    */
	function cb_emailPassword($email,$passPostKey){
		$this->load->model('users_model');
		$result = $this->users_model->getUserByEmailPassword($email,$this->input->post('password'));
		if (is_null($result)){
			$this->form_validation->set_message('cb_emailPassword', $this->lang->line('error_login'));
			return FALSE;
		}
		$this->logged_in_user = $result;
		

		return TRUE;
	}

    /***
    * Checks if an email exists. Returns true if email exists. False if email does not exist
    * 
    * @param mixed $email
    */
	function cb_emailExists($email){
		$this->load->model('users_model');
		$exists = $this->users_model->getUserByEmail($email);
		if (is_null($exists)){
			$this->form_validation->set_message('cb_emailExists', $this->lang->line('error_no_user_with_this_email'));
			return FALSE;
		}
		return TRUE;

	}

	/* Code by Tony Arora*/
	function cb_emailAlreadyExists($email){
		$this->load->model('users_model');
		$exists = $this->users_model->getUserByEmail($email);
		if ($exists){
			$this->form_validation->set_message('cb_emailAlreadyExists', $this->lang->line('error_user_already_exists_with_this_email'));
			return FALSE;
		}
		return TRUE;

	}
	
	function index()
    {
        $this->load->model('users_model');
   //     $password = $this->users_model->registerUserNew('test@test.com', 'Test', 'Test', 'password');
        
		$this->load->admin_view('login');
	}


	function forgot(){
		$this->liger_theme->setSlot('login/forgot'); 
		$this->liger_theme->setTitle($this->lang->line('forgot_password'));

		$this->liger_theme->render(array(),'layouts/plain');
	}

	function signup(){
		//$data['nametest']='siroco';
		$this->liger_theme->setSlot('login/signup'); 
		$this->liger_theme->setTitle($this->lang->line('signup'));

		$this->liger_theme->render(array(),'layouts/plain');
		//$this->liger_theme->render($data,'layouts/plain');
	}
	
	function doSignup(){
		
		$this->load->library('form_validation');	
		$this->form_validation->set_rules('email',$this->lang->line('email'),'trim|required|valid_email|callback_cb_emailAlreadyExists');
		$this->form_validation->set_rules('firstname',$this->lang->line('first_name'),'trim|required|min_length[5]');
		$this->form_validation->set_rules('lastname',$this->lang->line('last_name'),'trim|required');
		$this->form_validation->set_rules('password',$this->lang->line('password'),'trim|required|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm',$this->lang->line('password_confirm'),'trim|required');

		
		if ($this->form_validation->run($this)==TRUE){
			$this->load->model('users_model');
			$data['userId'] = $this->users_model->registerUserNew($this->input->post('email'),$this->input->post('firstname'),$this->input->post('lastname'),$this->input->post('password'));
			
			$this->session->set_flashdata('message',array('type'=>'notice',$this->lang->line('signup_text')));
			
			$this->load->library('email');
			$this->email->from($this->config->item('from_email'), $this->config->item('from_name'));
			$this->email->to($this->input->post('email'));
			$this->email->subject($this->lang->line('signup_email_subject'));
			$this->email->message($this->load->view('emails/signup_mail',$data,TRUE));
			$this->email->set_newline("\r\n");

			$this->email->send();
			
			$this->session->set_flashdata('message', array('type'=>'notice','text'=>$this->lang->line('signup_text')));
			return redirect('login/index','location');		
		} else{
			$this->session->set_flashdata('message', array('type'=>'warning','text'=>validation_errors()));
			return redirect('login/signup','location');
		}
	}
	
	function doForgot(){
				
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('email',$this->lang->line('email'),'trim|required|valid_email|callback_cb_emailExists');
		if ($this->form_validation->run($this)==TRUE){	
			$data['key'] = $this->users_model->updateResetPass($this->input->post('email'));
			$this->session->set_flashdata('message',array('type'=>'notice',$this->lang->line('forgot_you_will_receive')));
			
			$this->load->library('email');
			$this->email->from($this->config->item('from_email'), $this->config->item('from_name'));
			$this->email->to($this->input->post('email'));
			$this->email->subject($this->lang->line('forgot_email_subject'));
			$this->email->message($this->load->view('emails/reset_pass',$data,TRUE));
			$this->email->set_newline("\r\n");

			$this->email->send();
			
			$this->session->set_flashdata('message', array('type'=>'notice','text'=>$this->lang->line('forgot_you_will_receive')));
			return redirect ('login/index','location');
		}else{
			$this->session->set_flashdata('message', array('type'=>'warning','text'=>validation_errors()));
			return redirect('login/forgot','location');
		}
	}
	
	
	
	function changeResetPass($reset_key=false){

		$this->load->model('users_model');
		if ($reset_key) $reset_key = str_replace("_", "=", $reset_key);
		if ((!$reset_key)||(!$this->users_model->resetCodeExists($reset_key))){
			$this->session->set_flashdata('message',array('type'=>'error','text'=>$this->lang->line('error_forgot_code_not_found')));
			return redirect ("login/index","location");
		}
		
		if ($this->input->post('doChange')!==false){			
			$this->load->library('form_validation');
			$this->form_validation->set_rules('password',$this->lang->line('password'),'required|min_length[6]');
			$this->form_validation->set_rules('password_repeat',$this->lang->line('password_confirm'),'matches[password]');
			if ($this->form_validation->run()==TRUE){
				$result = $this->users_model->updatePassFromReset($reset_key,$this->input->post('password'));

				if ($result==TRUE){
					$this->session->set_flashdata('message',array('type'=>'notice','text'=>$this->lang->line('change_correct')));
					return redirect('login/index','location');					
				}
			}						
		}
		$this->liger_theme->setSlot('login/reset'); 
		$this->liger_theme->setTitle($this->lang->line('reset_password'));

		$this->liger_theme->render(array(),'layouts/plain');
	}

	/***
	Performs login
	***/
	function doLogin(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('password', 'Password','trim|required');
		$this->form_validation->set_rules('email', 'Email','trim|required|valid_email|callback_cb_emailPassword["password"]');
		//$this->form_validation->set_rules('email',$this->lang->line('email'),'trim|required|valid_email');			
		if ($this->form_validation->run($this)==TRUE){
			$this->auth->setLoginInfo($this->logged_in_user);
			
			if($this->input->post('return', true) && $this->input->post('return', true))				
			{
				$url = urldecode($this->input->post('return', true));
				return redirect($url, 'location');
			}
			else
				return redirect('admin', 'location');
		}else{

			$this->session->set_flashdata('message', array(	'type'	=> 'warning','text'	=> validation_errors()));			
			return redirect('login', 'location');
		}
	}

	function logout(){
		$this->auth->logout();
		redirect ('admin/login');
	}
}