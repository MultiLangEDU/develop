<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('out')) {
    function out($var, $dump = false) {
        echo '<pre>';
        if ($dump)
            var_dump($var);
        else
            print_r($var);
        echo '</pre>';
    }
}