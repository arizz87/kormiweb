<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends My_Controller {
	
	public function __construct()
	{
		parent::__construct();
        $this->load->database(); 
		$this->load->library('pagination'); 
		$this->load->model('M_Profil');
	}

	public function index()
	{	
			
        $data['content'] = $this->load->view('frontend/home/index', [], TRUE);
		$this->load->view('layout/frontend/header',$data); 
		$this->load->view('layout/frontend/main',$data); 
		$this->load->view('layout/frontend/footer',$data);  
	}

	
	public function detail($slug=0)
	{	
		//unset session keyword
		$this->session->unset_userdata('keyword');

        //cek apakah blog yang dikunjungi itu ada / sesuai di url 
		if ($this->M_Profil->get_profil_detail($slug)->num_rows()>0) {
			$data['title'] 				= 	'Profil';
			$data['profil_detail']		=	$this->M_Profil->get_profil_detail($slug)->row_array();    	
            $data['content'] = $this->load->view('frontend/profil/detail', [], TRUE);
				$this->load->view('layout/frontend/header',$data);
		        $this->load->view('layout/frontend/main',$data);  
				$this->load->view('layout/frontend/footer');	 
		}else{
			$this->session->set_flashdata('warning','Profil yang anda tuju tidak ditemukan !');
			redirect('profil');
		} 
	}
 

}

/* End of file Blog.php */
/* Location: ./application/controllers/Blog.php */