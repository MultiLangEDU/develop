<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $CI =& get_instance();

        if($CI->uri->segment(1) == 'admin' and $CI->uri->segment(2) != 'login' and !$CI->auth->isLoggedIn()){
            redirect('admin/login');
        }
    }

}