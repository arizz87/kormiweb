<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends My_Controller {
 
    function __construct()
    {
        parent::__construct();
        $this->load->database(); 
        $this->load->model('M_Login');
    } 

	public function index()
	{  
		check_not_login();  
        $data = [
			'title' => 'Pengaturan Agenda',
			'contentTitle' => 'Pengaturan Agenda',
			'view' => 'backend/wait',
		]; 
		$this->load->view('layout/backend/content',$data);
	}
 
    
	public function logout()
		{ 
			$params=array('id_user','level','username');
			$this->session->unset_userdata($params);
			create_log_activity('Melakukan Logout',user()->username);
			redirect('login');
		} 
}

     