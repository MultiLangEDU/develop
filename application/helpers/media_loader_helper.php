<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('loadJS')) {
    function loadJS($files) {
        if (!empty($files) && is_array($files)) {
            foreach ($files as $file=>$params) {
                if ($params != 'external') {
                    echo '<script src="'.base_url('assets/js/'.$file.'.js').'" type="text/javascript"></script>'."\n";
                } else {
                    echo '<script src="'.$file.'" type="text/javascript"></script>'."\n";
                }
            }
        }
    }
}

if (!function_exists('loadCSS')) {
    function loadCSS($files) {
        if (!empty($files) && is_array($files)) {
            foreach ($files as $file=>$params) {
                if ($params != 'external') {
                    $paramsString = '';
                    foreach ($params as $param=>$value) {
                        $paramsString .= $param.'="'.$value.'" ';
                    }
                    echo '<link rel="stylesheet" href="'.base_url('assets/style/'.$file.'.css').'" '.$paramsString.'type="text/css">'."\n";
                } else {
                    echo '<link rel="stylesheet" href="'.$file.'" type="text/css">'."\n";
                }
            }
        }
    }
}