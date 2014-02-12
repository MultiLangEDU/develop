<?php
class image_upload{

	function __construct()
    {
		$this->ci = &get_instance();
        $this->ci->load->library('upload');
        $this->ci->load->library('image_lib');
	}

    function do_upload($path, $size = array('width' => 1024, 'height' => 768))
    {
        $upload_conf = array(
            'upload_path'   => realpath($path),
            'allowed_types' => 'gif|jpg|png',
            'max_size'      => '3000000',
        );

        $this->ci->upload->initialize($upload_conf);
    
        // Change $_FILES to new vars and loop them
        foreach($_FILES['userfile'] as $key=>$val)
        {
            $i = 1;
            foreach($val as $v)
            {
                $field_name = "file_".$i;
                $_FILES[$field_name][$key] = $v;
                $i++;   
            }
        }
        unset($_FILES['userfile']);
        $error = array();
        $success = array();
        foreach($_FILES as $field_name => $file)
        {
            if ( ! $this->ci->upload->do_upload($field_name)) {
                $error['upload'][] = $this->ci->upload->display_errors();
            } else {
                $upload_data = $this->ci->upload->data();
                $resize_conf = array(
                    'source_image'  => $upload_data['full_path'], 
                    'new_image'     => $upload_data['full_path'],
                    'create_thumb' => false,
                    'width'         => $size['width'],
                    'height'        => $size['height'],
                    'quality'        => 100,
                );
                $this->ci->image_lib->initialize($resize_conf);
                $this->ci->image_lib->resize();

                chmod($upload_data['full_path'], 0755);
                /*Resize*/
                
                $resize_conf = array(
                    'source_image'  => $upload_data['full_path'], 
                    'new_image'     => $upload_data['file_path'].'thumb_'.$upload_data['file_name'],
                    'width'         => 200,
                    'height'        => 200,
                    'quality'        => 100,
                );
                
                               
                $this->ci->image_lib->initialize($resize_conf);
                 $this->ci->image_lib->resize(); 
                $resize_conf_miny = array(
                    'source_image'  => $upload_data['full_path'], 
                    'new_image'     => $upload_data['file_path'].'miny_'.$upload_data['file_name'],
                    'width'         => 40,
                    'height'        => 40,
                    'quality'        => 10,
                );
                $dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($resize_conf_miny['width'] / $resize_conf_miny['height']);
                $resize_conf_miny['master_dim'] = ($dim > 0)? "height" : "width";
                
                $this->ci->image_lib->initialize($resize_conf_miny);
                if ( ! $this->ci->image_lib->resize()) {
                    $error['resize'][] = $this->ci->image_lib->display_errors();
                } else {
                    
                    $image_config['image_library'] = 'gd2';
                    $image_config['source_image'] = $upload_data['file_path'].'thumb_'.$upload_data['file_name'];
                    $image_config['new_image'] = $upload_data['file_path'].'thumb_'.$upload_data['file_name'];
                    $image_config['quality'] = "100%";
                    $image_config['maintain_ratio'] = FALSE;
                    $image_config['width'] = 200;
                    $image_config['height'] = 200;
                    $image_config['x_axis'] = '0';
                    $image_config['y_axis'] = '0';
                    $this->ci->image_lib->clear();
                    $this->ci->image_lib->initialize($image_config);
                    $this->ci->image_lib->crop();
                    $success[] = $upload_data;
                }
            }
        }

        // see what we get
        if(count($error > 0)){
            $data['error'] = $error;
        } else {
            $data['success'] = $upload_data;
        }
        return $success;
    }

}	