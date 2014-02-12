<?php
class auth{

	function __construct(){
		$this->ci = &get_instance();
		$this->ci->load->library('session');
	}
    /**
    * Sets login information
    * 
    * @param array $user_info
    */
	function setLoginInfo($user_info){
		$this->ci->session->set_userdata('user',$user_info);
		$this->ci->session->set_userdata('logged_in',true);

	}
    /**
    * Logs a user out
    * 
    * @param mixed 
    */
	function logout($user_info=false){
		$this->ci->session->unset_userdata('user');
		$this->ci->session->unset_userdata('logged_in');
	}

    /**
    * Gets current user array
    * 
    */
	function getUser(){
		return $this->ci->session->userdata('user');
	}
    
    /**
    * Checks if user is logged in
    * 
    */
	function isLoggedIn(){
		return $this->ci->session->userdata('logged_in');
	}

    
    /**
    * Returns current user role
    * 
    */
	function getRole(){
		$role = $this->ci->session->userdata('user');
		if ($role)
			return $role->user_type;
		else
			return -1;
	}

    /**
    * Gets user name and surname
    * 
    */
	function getGreeting(){
		$user = $this->ci->session->userdata('user');
		return $user->name ." " . $user->surname;
	}


    /**
    * Validates that current user has the same role
    * 
    * @param mixed $role_id
    */
	function requiresRole($role_id){
		$role = $this->getRole();
		if (is_array($role_id)){
			if (in_array($role, $role_id))
				return FALSE;
			else
				return FALSE;
		}
		if ($role==$role_id)
			return FALSE;
	}
    
    function isAdmin()
    {
        $role = $this->getRole();
        if($role == 1){
            return TRUE;
        }
        return FALSE;
    }
    
    function isHotel()
    {
        $role = $this->getRole();
        if($role == 2){
            return TRUE;
        }
        return FALSE;
    }
}	