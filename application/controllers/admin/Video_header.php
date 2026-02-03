<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video_header extends My_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();  
        $this->load->database(); 
        $this->load->model('M_Video');
	}

	public function index()
	{
		$data = [
			'title' => 'Pengaturan Video Header',
			'view' => 'backend/video-header/index',
			'contentTitle' => 'Pengaturan Video Header',
			'video' => $this->M_Video->get_video_header(),
		];

		$this->load->view('layout/backend/content',$data);
	}

	public function edit($id=0)
	{
        if (!$id) {
        redirect('admin/video-header');
        }

        $cek = $this->M_Video->getVideo($id);

        if (!$cek) {
        redirect('admin/video-header');
        }
		$data = [
			'title' => 'Pengaturan Video Header',
			'contentTitle' => 'Edit Video Header',
			'view' => 'backend/video-header/edit',
			'action' => 'Edit',   
			'video' => $cek, 
		];

		$this->load->view('layout/backend/content',$data);
	} 
  
    public function proses()
    { 
	cek_session(); 
    $res = [
        'status'  => 'fatal',
        'message' => 'Unknown error.',
        'csrf' => [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        ] 
    ];
    
    // hanya terima POST
    if ($this->input->method() !== 'post') {
    redirect('admin/video-header');
    }

    $enc_id    = $this->input->post('enc_id', TRUE);
    $nonce     = $this->input->post('nonce', TRUE);
    $signature = $this->input->post('signature', TRUE);
    $action    = $this->input->post('action', TRUE);
   
    
    if ($action === 'edit-video') { 
     cek_session();   
    
 		  $judul = $this->input->post('judul');
		  $sambutan = $this->input->post('sambutan');
		  $link = $this->input->post('link'); 
		  $nama = $this->input->post('nama');
		  $id = $this->input->post('id'); 

        if ($judul == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Judul Video .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($sambutan == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Kata Sambutan .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($link == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Link Video .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($nama == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Nama File Video .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else{  
              $data = array(  
                    'judul_video'	    =>  htmlentities($judul),
                    'sambutan'	        =>	htmlentities($sambutan), 
                    'link_video'	    =>	htmlentities($link), 
                    'nama_file'	         =>	htmlentities($nama), 
                    'user_id'	        =>  user()->id_user 
                  );   
              
            $this->db->where('id_video', aes_decrypt_id($id));   
            $this->db->update('tb_video_header', $data);  
   
        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil mengupdate video header web',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
       
        /* ================================
        * RESPONSE
        * ================================ */
        $res = [
            'status'  => 'success',
            'message' => 'Data Video Header Berhasil Disimpan.',
            'csrf'    => [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            ]
        ];

    } 
        echo json_encode($res);
        exit;   
    }
    }

    private function json_out($arr)
    {
    header("Content-Type: application/json");
    echo json_encode($arr);
    exit;
    }
    
 
}

/* End of file Blog.php */
/* Location: ./application/controllers/admin/Blog.php */