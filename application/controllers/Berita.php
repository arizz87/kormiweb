<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends My_Controller {
	
	public function __construct()
	{
		parent::__construct();
        $this->load->database(); 
		$this->load->library('pagination'); 
		$this->load->model('M_Blog');
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
		if ($this->M_Blog->get_blog_detail($slug)->num_rows()>0) {
			$data['title'] 				= 	'Berita';
			$data['detail']		=	$this->M_Blog->get_blog_detail($slug)->row_array();  
            $data['new_blogs']  = $this->M_Blog->get_blogs_terbaru();  	
            $data['content'] = $this->load->view('frontend/berita/detail',$data,TRUE);
				$this->load->view('layout/frontend/header',$data);
		        $this->load->view('layout/frontend/main',$data);  
				$this->load->view('layout/frontend/footer');	 
		}else{
			$this->session->set_flashdata('warning','Berita yang anda tuju tidak ditemukan !');
			redirect('home');
		} 
	}
 

}

/* End of file Blog.php */
/* Location: ./application/controllers/Blog.php */