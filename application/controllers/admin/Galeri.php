<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends My_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();  
        $this->load->database(); 
        $this->load->model('M_Galeri');
	}

	public function index()
	{
		$data = [
			'title' => 'Pengaturan Galeri Photo',
			'view' => 'backend/galeri/index',
			'contentTitle' => 'Pengaturan Galeri Photo',
			'galeri' => $this->M_Galeri->get_galeri_data(),
		];

		$this->load->view('layout/backend/content',$data);
	}

	public function tambah()
	{
		$data = [
			'title' => 'Pengaturan Galeri Photo',
			'contentTitle' => 'Buat Galeri Photo',
			'view' => 'backend/galeri/tambah', 
			'action' => 'Tambah',  
		];

		$this->load->view('layout/backend/content',$data);
	}

  
	public function edit($id=0)
	{
        if (!$id) {
        redirect('admin/galeri');
        }

        $cek = $this->M_Galeri->getOne($id);

        if (!$cek) {
        redirect('admin/galeri');
        }

		$data = [
			'title' => 'Pengaturan Galeri Photo',
			'contentTitle' => 'Edit Galeri Photo',
			'view' => 'backend/galeri/edit',
			'action' => 'Edit',   
			'galeri' => $cek, 
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
    redirect('admin/galeri');
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
		  $tanggal = $this->input->post('tanggal'); 
		  $posting = $this->input->post('posting'); 
		  $author = $this->input->post('author');

        $allowed_types = ['image/jpg','image/jpeg','image/png']; 
		  
		date_default_timezone_set('Asia/Jakarta');	 
		$waktu=date("H:i:s");  
	 
        $data=$this->db->query("select max(id_galeri) maxKode from tbl_galeri")->row_array();   
        $noUrut= (int)$data['maxKode'] + 1;   
    
        if ($judul == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Judul Galeri .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($tanggal == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Tanggal Galeri .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if (empty($_FILES['file1x']['name'])) {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Memilih File Gambar Galeri .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        }else if((!in_array($_FILES['file1x']['type'],$allowed_types))) { 
          $res=['status'=>'error',
              'message'=>'Maaf File Gambar Galeri Bukan Berformat JPG/ JPEG/ PNG. .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if (($_FILES['file1x']['size'] > 2000000)) {
          $res=['status'=>'error',
              'message'=>'Maaf File Gambar Galeri lebih dari 2 MB .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($author == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Pembuat / Author .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else{ 
 
        /* ================================
        * INISIALISASI VARIABEL
        * ================================ */
        $file_Galeri = ''; 

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
                'message'=>'File Gambar Galeri bukan JPG/ JPEG/ PNG asli.',
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
                'message'=>'File Gambar Galeri terdeteksi berbahaya.',
                'csrf'=>['name'=>$this->security->get_csrf_token_name(),
                'hash'=>$this->security->get_csrf_hash()]];  
                 echo json_encode($res); 
                exit;   
        }
       
        /* ================================
        * UPLOAD FILE KE FOLDER
        * ================================ */
        if ($allow_upload1) { 
            $name_Galeri = 'galeri-' . date('YmdHis') . '-' . mt_rand(1000,9999);
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
                'file_name'        => $name_Galeri
            ];

            $this->load->library('upload');
            $this->upload->initialize($config1); 

            if (!$this->upload->do_upload('file1x')) {
                $res=['status'=>'error',
                'message'=>'Gagal upload File Gambar Galeri, silahkan cari gambar lain.',
                'csrf'=>['name'=>$this->security->get_csrf_token_name(),
                'hash'=>$this->security->get_csrf_hash()]];  
                 echo json_encode($res); 
                exit;  
            }

            $data1        = $this->upload->data();
            $file_Galeri  = $data1['file_name'];
        }     

        /* ================================
        * INSERT Tabel
        * ================================ */
        $data = [
            'id_galeri'           =>  $noUrut, 
			'galeri_tgl' 		    =>  $tanggal.' '.$waktu,
			'galeri_tgl_edit' 	=>  $tanggal, 
			'galeri_author'	    =>  htmlentities($author),
			'judul_galeri'	    =>	htmlentities($judul), 
			'galeri_img'	        =>	$file_Galeri ?? '', 
			'user_id'	        =>  user()->id_user,
			'tampil'           =>  $posting
        ];

        $this->db->insert('tbl_galeri', $data);

        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil menambah galeri photo',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
       
        /* ================================
        * RESPONSE
        * ================================ */
        $res = [
            'status'  => 'success',
            'message' => 'Data Galeri Photo Berhasil Disimpan.',
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
		  $tanggal = $this->input->post('tanggal'); 
		  $posting = $this->input->post('posting'); 
		  $author = $this->input->post('author');
		  $id = $this->input->post('id'); 

        $allowed_types = ['image/jpg','image/jpeg','image/png']; 
		  
		date_default_timezone_set('Asia/Jakarta');	 
		$waktu=date("H:i:s");  
	 
        $data=$this->db->query("select max(id_galeri) maxKode from tbl_galeri")->row_array();   
        $noUrut= (int)$data['maxKode'] + 1;   
    
        if ($judul == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Judul Galeri .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($tanggal == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Tanggal Galeri .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if((!empty($_FILES['file1x']['name']) && !in_array($_FILES['file1x']['type'],$allowed_types))) { 
          $res=['status'=>'error',
              'message'=>'Maaf File Gambar Galeri Bukan Berformat JPG/ JPEG/ PNG. .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ((!empty($_FILES['file1x']['name']) && $_FILES['file1x']['size'] > 2000000)) {
          $res=['status'=>'error',
              'message'=>'Maaf File Gambar Galeri lebih dari 2 MB .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($author == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Pembuat / Author .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        }  else{  
              $data = array(  
			        'galeri_tgl' 	    =>  $tanggal.' '.$waktu,
			        'galeri_tgl_edit' 	=>  $tanggal, 
			        'galeri_author'	    =>  htmlentities($author),
			        'judul_galeri'	    =>	htmlentities($judul),
			        'user_id'	        =>  user()->id_user,
			        'tampil'           =>  $posting
                  );   
              
            $this->db->where('id_galeri', aes_decrypt_id($id));   
            $this->db->update('tbl_galeri', $data);  
 
        /* ================================
        * INISIALISASI VARIABEL
        * ================================ */
        $file_Galeri = ''; 

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
                'message'=>'File Gambar Galeri bukan JPG/ JPEG/ PNG asli.',
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
                'message'=>'File Gambar Galeri terdeteksi berbahaya.',
                'csrf'=>['name'=>$this->security->get_csrf_token_name(),
                'hash'=>$this->security->get_csrf_hash()]];  
                 echo json_encode($res); 
                exit;   
        }
       
        /* ================================
        * UPLOAD FILE KE FOLDER
        * ================================ */ 
        if ($allow_upload1) { 
            $cek=$this->db->query("SELECT * FROM tbl_galeri where id_galeri='".aes_decrypt_id($id)."'")->row_array();
            if (!empty($cek['galeri_img'])) {
            $old_path = FCPATH . './storage/gambar/' . $cek['galeri_img'];
            if (file_exists($old_path) && is_file($old_path)) {
            unlink($old_path);
            }
            }
            $name_Galeri = 'galeri-' . date('YmdHis') . '-' . mt_rand(1000,9999);
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
                'file_name'        => $name_Galeri
            ];

            $this->load->library('upload');
            $this->upload->initialize($config1); 

            if ($this->upload->do_upload('file1x')) {
            $data1 = $this->upload->data();
            $this->db->where('id_galeri', aes_decrypt_id($id));
            $this->db->update('tbl_galeri', ['galeri_img' => $data1['file_name']]);
            } else {
                $res=['status'=>'error',
                'message'=>'Gagal upload File Gambar Galeri, silahkan cari gambar lain.',
                'csrf'=>['name'=>$this->security->get_csrf_token_name(),
                'hash'=>$this->security->get_csrf_hash()]];  
                 echo json_encode($res); 
                exit;  
            } 

            
        }      

        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil mengupdate galeri photo',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
       
        /* ================================
        * RESPONSE
        * ================================ */
        $res = [
            'status'  => 'success',
            'message' => 'Data Galeri Photo Berhasil Disimpan.',
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
		$blog=$this->db->query("SELECT * FROM tbl_galeri where id_galeri='".aes_decrypt_id($id)."'")->row_array();   
            if (!empty($blog['galeri_img'])) {
            $old_path = FCPATH . './storage/gambar/' . $blog['galeri_img'];
            if (file_exists($old_path) && is_file($old_path)) {
            unlink($old_path);
            }
            }
		    $this->db->where('id_galeri', $blog['id_galeri']);
            $this->db->delete('tbl_galeri');

        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil menghapus galeri photo',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
       
            $this->session->set_flashdata('flash','dihapus.');
            redirect('admin/galeri');
	}
 
}

/* End of file Blog.php */
/* Location: ./application/controllers/admin/Blog.php */