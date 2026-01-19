<?php

declare(strict_types=1);

if (!function_exists('form_validation_helper')) {
    function form_validation_helper($data)
    {
        $CI = &get_instance();
        $CI->load->library('form_validation');

        $CI->form_validation->set_rules($data);
        $CI->form_validation->run();

        return $CI->form_validation->error_array();
    }
}