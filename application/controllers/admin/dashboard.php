<?php
class Dashboard extends MY_Controller{
	
	var $logged_in_user;

	function __construct()
    {
		parent::__construct();
	}
    
    public function index()
    {
        $this->load->admin_view('dashboard');
    }
    
    
}