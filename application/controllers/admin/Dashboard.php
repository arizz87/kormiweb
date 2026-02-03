<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends My_Controller {
 
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
			'title' => 'Halaman Admin',
			'contentTitle' => 'Halaman Admin Web',
			'view' => 'backend/dashboard',
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

     