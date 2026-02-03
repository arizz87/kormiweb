<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends My_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Home'); 
		$this->load->model('M_Blog'); 
		$this->load->model('M_Galeri'); 
		$this->load->model('M_Video'); 
		$this->load->model('M_Profil'); 
        $this->load->database();
	}

	public function index()
	{
        $data['new_blogs']  = $this->M_Blog->get_blogs();
        $data['galeris']  = $this->M_Galeri->get_galeri();
        $data['videos']  = $this->M_Video->get_video();
        $data['profils']  = $this->M_Profil->get_profil();
        $data['video_header']  = $this->M_Video->get_video_header_data();

        // kirim DATA ke content
        $data['content'] = $this->load->view('frontend/home/index',$data,TRUE);
		$this->load->view('layout/frontend/header',$data); 
		$this->load->view('layout/frontend/main',$data); 
		$this->load->view('layout/frontend/footer',$data);  
	}

	
	public function image($filename=null)
    { 
    if (empty($filename)) {
       redirect();
    }

    // Cegah ../ dan karakter aneh
    $filename = basename($filename);

    // Path dinamis (tidak hardcode ./)
    $basePath = FCPATH . './storage/gambar/';
    $path = realpath($basePath . $filename);

    // Pastikan file ada & masih di folder berita
    if (!$path || !file_exists($path) || strpos($path, realpath($basePath)) !== 0) {
        show_error('File tidak ditemukan.');
    } 

    $mime = mime_content_type($path);

    header('Content-Type: '.$mime);
    header('Content-Length: '.filesize($path));
    header('Cache-Control: public, max-age=86400');

    readfile($path);
    exit;
    } 
	
	public function image_logo($filename=null)
    {   
    if (empty($filename)) {
       redirect();
    }

    // Cegah ../ dan karakter aneh
    $filename = basename($filename);

    // Path dinamis (tidak hardcode ./)
    $basePath = FCPATH . './storage/logo/';
    $path = realpath($basePath . $filename);

    // Pastikan file ada & masih di folder berita
    if (!$path || !file_exists($path) || strpos($path, realpath($basePath)) !== 0) {
        show_error('File tidak ditemukan.');
    } 

    $mime = mime_content_type($path);

    header('Content-Type: '.$mime);
    header('Content-Length: '.filesize($path));
    header('Cache-Control: public, max-age=86400');

    readfile($path);
    exit;
    }


}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
