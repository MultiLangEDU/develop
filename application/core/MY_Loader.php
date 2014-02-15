<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Loader extends CI_Loader
{

    public function theme_view($view, $vars = array(), $return = FALSE)
    {
        $ci = &get_instance();

        $currSection = $ci->uri->segment(2);
        $vars['section'] = $currSection;
        $vars['subsection'] = $ci->uri->segment(3);
        
        $result = '';
        $result .= $this->_ci_load(array('_ci_view' => 'frontend/_header', '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
        $result .= $this->_ci_load(array('_ci_view' => 'frontend/'.$view, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
        $result .= $this->_ci_load(array('_ci_view' => 'frontend/_footer', '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
        return $result;
    }
    
    public function admin_view($view, $vars = array(), $return = FALSE)
    {
        $ci = &get_instance();
        
        $currSection = $ci->uri->segment(2);
        $vars['section'] = $currSection;
        $vars['subsection'] = $ci->uri->segment(3);
        $vars['subsection2'] = $ci->uri->segment(4);

        if($ci->uri->segment(2) != 'login'){
            $user_id = $ci->auth->getUser()->id;
            $vars['user'] = $ci->users_model->getRecord($user_id);
            $vars['all_users_count'] = $ci->users_model->countRows();
            $vars['all_students_count'] = $ci->users_model->countRows(array('user_type' => 3));
            $vars['all_courses_count'] = $ci->courses_model->countRows();
        }
        
        $result = '';
        if($ci->uri->segment(2) != 'login'){
            $result .= $this->_ci_load(array('_ci_view' => 'admin/_header', '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
            $result .= $this->_ci_load(array('_ci_view' => 'admin/_sidebar', '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
        }
        $result .= $this->_ci_load(array('_ci_view' => 'admin/'.$view, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
        if($ci->uri->segment(2) != 'login')
            $result .= $this->_ci_load(array('_ci_view' => 'admin/_footer', '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
        return $result;
    }

}