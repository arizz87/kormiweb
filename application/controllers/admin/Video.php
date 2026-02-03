<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends My_Controller {

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
			'title' => 'Pengaturan Galeri Video',
			'view' => 'backend/video/index',
			'contentTitle' => 'Pengaturan Galeri Video',
			'video' => $this->M_Video->get_video_data(),
		];

		$this->load->view('layout/backend/content',$data);
	}

	public function tambah()
	{
		$data = [
			'title' => 'Pengaturan Galeri Video',
			'contentTitle' => 'Buat Galeri Video',
			'view' => 'backend/video/tambah', 
			'action' => 'Tambah',  
		];

		$this->load->view('layout/backend/content',$data);
	}

  
	public function edit($id=0)
	{
        if (!$id) {
        redirect('admin/video');
        }

        $cek = $this->M_Video->getOne($id);

        if (!$cek) {
        redirect('admin/video');
        }
		$data = [
			'title' => 'Pengaturan Galeri Video',
			'contentTitle' => 'Edit Galeri Video',
			'view' => 'backend/video/edit',
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
    redirect('admin/video');
    }

    $enc_id    = $this->input->post('enc_id', TRUE);
    $nonce     = $this->input->post('nonce', TRUE);
    $signature = $this->input->post('signature', TRUE);
    $action    = $this->input->post('action', TRUE);
  
    // Simpan Aksi Tambah
    if ($action === 'Tambah') { 
		cek_session();   
    
 		  $file1x = $this->input->post('file1x');
		  $judul = $this->input->post('judul');
		  $link = $this->input->post('link'); 
		  $posting = $this->input->post('posting'); 
		  $nama = $this->input->post('nama');

        $allowed_types = ['image/jpg','image/jpeg','image/png']; 
		  
		date_default_timezone_set('Asia/Jakarta');	 
		$waktu=date("H:i:s");  
	 
        $data=$this->db->query("select max(id_video) maxKode from tbl_video")->row_array();   
        $noUrut= (int)$data['maxKode'] + 1;   
    
        if ($judul == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Judul Video .. !',
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
        } else if (empty($_FILES['file1x']['name'])) {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Memilih File Gambar Video .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        }else if((!in_array($_FILES['file1x']['type'],$allowed_types))) { 
          $res=['status'=>'error',
              'message'=>'Maaf File Gambar Video Bukan Berformat JPG/ JPEG/ PNG. .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if (($_FILES['file1x']['size'] > 2000000)) {
          $res=['status'=>'error',
              'message'=>'Maaf File Gambar Video lebih dari 2 MB .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else{ 
 
        /* ================================
        * INISIALISASI VARIABEL
        * ================================ */
        $file_video = ''; 

        $allow_upload1 = (isset($_FILES['file1x']) &&
            !empty($_FILES['file1x']['name']) &&
            $_FILES['file1x']['size'] > 0 &&
            $_FILES['file1x']['size'] <= 2000000
        );
 
        /* ================================
        * VALIDASI EKSTENSI FILE UPLOAD
        * ================================ */
        if ($allow_upload1) { 
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime  = finfo_file($finfo, $_FILES['file1x']['tmp_name']);
            finfo_close($finfo);

            if (!in_array($mime, ['image/jpg','image/jpeg','image/png'])) {
             $res=['status'=>'error',
                'message'=>'File Gambar Video bukan JPG/ JPEG/ PNG asli.',
                'csrf'=>['name'=>$this->security->get_csrf_token_name(),
                'hash'=>$this->security->get_csrf_hash()]];  
                 echo json_encode($res); 
                exit;      
            }
        }    
  
        /* ================================
        * VALIDASI ISI FILE UPLOAD
        * ================================ */
        if ($allow_upload1 && !scan_file_safe($_FILES['file1x']['tmp_name'])) {
             $res=['status'=>'error',
                'message'=>'File Gambar Video terdeteksi berbahaya.',
                'csrf'=>['name'=>$this->security->get_csrf_token_name(),
                'hash'=>$this->security->get_csrf_hash()]];  
                 echo json_encode($res); 
                exit;   
        }
       
        /* ================================
        * UPLOAD FILE KE FOLDER
        * ================================ */
        if ($allow_upload1) { 
            $name_video = 'video-' . date('YmdHis') . '-' . mt_rand(1000,9999);
            $upload_path = FCPATH.'./storage/gambar/';

            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, true);
            }

            $config1 = [
                'upload_path'      => $upload_path,
                'allowed_types'    => 'jpg|jpeg|png',
                'max_size'         => 2048,
                'file_ext_tolower' => TRUE,
                'remove_spaces'    => TRUE,
                'overwrite'        => FALSE,
                'file_name'        => $name_video
            ];

            $this->load->library('upload');
            $this->upload->initialize($config1); 

            if (!$this->upload->do_upload('file1x')) {
                $res=['status'=>'error',
                'message'=>'Gagal upload File Gambar Video, silahkan cari gambar lain.',
                'csrf'=>['name'=>$this->security->get_csrf_token_name(),
                'hash'=>$this->security->get_csrf_hash()]];  
                 echo json_encode($res); 
                exit;  
            }

            $data1        = $this->upload->data();
            $file_video  = $data1['file_name'];
        }     

        /* ================================
        * INSERT Tabel
        * ================================ */
        $data = [
            'id_video'           =>  $noUrut,  
			'judul_video'	    =>  htmlentities($judul),
			'link_video'	    =>	htmlentities($link), 
			'nama_file'	         =>	htmlentities($nama), 
			'video_img'	        =>	$file_video ?? '', 
			'user_id'	        =>  user()->id_user,
			'tampil'           =>  $posting
        ];

        $this->db->insert('tbl_video', $data);

        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil menambah galeri video',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
       
        /* ================================
        * RESPONSE
        * ================================ */
        $res = [
            'status'  => 'success',
            'message' => 'Data Galeri Video Berhasil Disimpan.',
            'csrf'    => [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            ]
        ];

    } 
        echo json_encode($res);
        exit;
    }else if ($action === 'Edit') { 
     cek_session();   
    
 		  $file1x = $this->input->post('file1x');
		  $judul = $this->input->post('judul');
		  $link = $this->input->post('link'); 
		  $posting = $this->input->post('posting'); 
		  $nama = $this->input->post('nama');
		  $id = $this->input->post('id'); 

        $allowed_types = ['image/jpg','image/jpeg','image/png']; 
		  
		date_default_timezone_set('Asia/Jakarta');	 
		$waktu=date("H:i:s");  
	 
        $data=$this->db->query("select max(id_video) maxKode from tbl_video")->row_array();   
        $noUrut= (int)$data['maxKode'] + 1;   
    
        if ($judul == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Judul Video .. !',
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
        } else if((!empty($_FILES['file1x']['name']) && !in_array($_FILES['file1x']['type'],$allowed_types))) { 
          $res=['status'=>'error',
              'message'=>'Maaf File Gambar Video Bukan Berformat JPG/ JPEG/ PNG. .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ((!empty($_FILES['file1x']['name']) && $_FILES['file1x']['size'] > 2000000)) {
          $res=['status'=>'error',
              'message'=>'Maaf File Gambar Video lebih dari 2 MB .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        }  else{  
              $data = array(  
                    'judul_video'	    =>  htmlentities($judul),
                    'link_video'	    =>	htmlentities($link), 
                    'nama_file'	         =>	htmlentities($nama), 
                    'user_id'	        =>  user()->id_user,
                    'tampil'           =>  $posting
                  );   
              
            $this->db->where('id_video', aes_decrypt_id($id));   
            $this->db->update('tbl_video', $data);  
 
        /* ================================
        * INISIALISASI VARIABEL
        * ================================ */
        $file_video = ''; 

        $allow_upload1 = (isset($_FILES['file1x']) &&
            !empty($_FILES['file1x']['name']) &&
            $_FILES['file1x']['size'] > 0 &&
            $_FILES['file1x']['size'] <= 2000000
        );
 
        /* ================================
        * VALIDASI EKSTENSI FILE UPLOAD
        * ================================ */
        if ($allow_upload1) { 
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime  = finfo_file($finfo, $_FILES['file1x']['tmp_name']);
            finfo_close($finfo);

            if (!in_array($mime, ['image/jpg','image/jpeg','image/png'])) {
             $res=['status'=>'error',
                'message'=>'File Gambar Video bukan JPG/ JPEG/ PNG asli.',
                'csrf'=>['name'=>$this->security->get_csrf_token_name(),
                'hash'=>$this->security->get_csrf_hash()]];  
                 echo json_encode($res); 
                exit;      
            }
        }    
  
        /* ================================
        * VALIDASI ISI FILE UPLOAD
        * ================================ */
        if ($allow_upload1 && !scan_file_safe($_FILES['file1x']['tmp_name'])) {
             $res=['status'=>'error',
                'message'=>'File Gambar Video terdeteksi berbahaya.',
                'csrf'=>['name'=>$this->security->get_csrf_token_name(),
                'hash'=>$this->security->get_csrf_hash()]];  
                 echo json_encode($res); 
                exit;   
        }
       
        /* ================================
        * UPLOAD FILE KE FOLDER
        * ================================ */ 
        if ($allow_upload1) { 
            $cek=$this->db->query("SELECT * FROM tbl_video where id_video='".aes_decrypt_id($id)."'")->row_array();
            if (!empty($cek['video_img'])) {
            $old_path = FCPATH . './storage/gambar/' . $cek['video_img'];
            if (file_exists($old_path) && is_file($old_path)) {
            unlink($old_path);
            }
            }
            $name_video = 'video-' . date('YmdHis') . '-' . mt_rand(1000,9999);
            $upload_path = FCPATH.'./storage/gambar/';

            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, true);
            }

            $config1 = [
                'upload_path'      => $upload_path,
                'allowed_types'    => 'jpg|jpeg|png',
                'max_size'         => 2048,
                'file_ext_tolower' => TRUE,
                'remove_spaces'    => TRUE,
                'overwrite'        => FALSE,
                'file_name'        => $name_video
            ];

            $this->load->library('upload');
            $this->upload->initialize($config1); 

            if ($this->upload->do_upload('file1x')) {
            $data1 = $this->upload->data();
            $this->db->where('id_video', aes_decrypt_id($id));
            $this->db->update('tbl_video', ['video_img' => $data1['file_name']]);
            } else {
                $res=['status'=>'error',
                'message'=>'Gagal upload File Gambar Video, silahkan cari gambar lain.',
                'csrf'=>['name'=>$this->security->get_csrf_token_name(),
                'hash'=>$this->security->get_csrf_hash()]];  
                 echo json_encode($res); 
                exit;  
            } 

            
        }      

        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil mengupdate galeri video',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
       
        /* ================================
        * RESPONSE
        * ================================ */
        $res = [
            'status'  => 'success',
            'message' => 'Data Galeri Video Berhasil Disimpan.',
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
   
	public function delete($id=0)
	{
		$blog=$this->db->query("SELECT * FROM tbl_video where id_video='".aes_decrypt_id($id)."'")->row_array();   
            if (!empty($blog['video_img'])) {
            $old_path = FCPATH . './storage/gambar/' . $blog['video_img'];
            if (file_exists($old_path) && is_file($old_path)) {
            unlink($old_path);
            }
            }
		    $this->db->where('id_video', $blog['id_video']);
            $this->db->delete('tbl_video');

        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil menghapus galeri video',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
       
            $this->session->set_flashdata('flash','dihapus.');
            redirect('admin/video');
	}
 
}

/* End of file Blog.php */
/* Location: ./application/controllers/admin/Blog.php */