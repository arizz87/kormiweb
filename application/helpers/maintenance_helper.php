<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function maintenance_check()
{
    $CI =& get_instance();
    $CI->config->load('maintenance');

    if ($CI->config->item('maintenance_mode') === TRUE) {

        // Jangan loop
        if ($CI->router->class === 'maintenance') {
            return;
        }
 

       // RENDER VIEW MANUAL
        echo $CI->load->view('maintenance', [], TRUE);

        // STOP EKSEKUSI
        exit;
    }
}
