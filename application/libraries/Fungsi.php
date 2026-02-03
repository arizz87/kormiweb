<?php

Class Fungsi {

    protected $ci;

    function __construct(){
        $this->ci =& get_instance();
    }

    function user_login(){
        $this->ci->load->model('mod_user');
        $user_id=$this->ci->session->userdata('kode_user');
        $user_data=$this->ci->mod_user->get($user_id)->row();
        return $user_data;
    }
}