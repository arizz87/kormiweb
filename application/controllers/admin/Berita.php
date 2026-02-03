<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends My_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();  
        $this->load->database(); 
        $this->load->model('M_Blog');
	}

	public function index()
	{
		$data = [
			'title' => 'Pengaturan Berita/Artikel',
			'view' => 'backend/berita/index',
			'contentTitle' => 'Pengaturan Berita/Artikel',
			'blogs' => $this->M_Blog->get_blogs_data(),
		];

		$this->load->view('layout/backend/content',$data);
	}

	public function tambah()
	{
		$data = [
			'title' => 'Pengaturan Berita/Artikel',
			'contentTitle' => 'Buat Berita/Artikel',
			'view' => 'backend/berita/tambah', 
			'action' => 'Tambah',  
		];

		$this->load->view('layout/backend/content',$data);
	}

  
	public function edit($id=0)
	{
        if (!$id) {
        redirect('admin/berita');
        }

        $blog = $this->M_Blog->getOne($id);

        if (!$blog) {
        redirect('admin/berita');
        }

		$data = [
			'title' => 'Pengaturan Berita/Artikel',
			'contentTitle' => 'Edit Berita/Artikel',
			'view' => 'backend/berita/edit',
			'action' => 'Edit',   
			'blog' => $blog, 
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
    redirect('admin/berita');
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
		  $berita_isi = $this->input->post('berita_isi'); 

        $allowed_types = ['image/jpg','image/jpeg','image/png']; 
		  
		date_default_timezone_set('Asia/Jakarta');	 
		$waktu=date("H:i:s");  
	 
        $data=$this->db->query("select max(id_blog) maxKode from tbl_blog")->row_array();   
        $noUrut= (int)$data['maxKode'] + 1;   
    
        if ($judul == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Judul Berita .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($tanggal == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Tanggal Berita .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if (empty($_FILES['file1x']['name'])) {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Memilih File Gambar Berita .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        }else if((!in_array($_FILES['file1x']['type'],$allowed_types))) { 
          $res=['status'=>'error',
              'message'=>'Maaf File Gambar Berita Bukan Berformat JPG/ JPEG/ PNG. .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if (($_FILES['file1x']['size'] > 2000000)) {
          $res=['status'=>'error',
              'message'=>'Maaf File Gambar Berita lebih dari 2 MB .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($author == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Pembuat / Author .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        }  else if ($berita_isi == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Isian Berita .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else{ 
 
        /* ================================
        * INISIALISASI VARIABEL
        * ================================ */
        $file_berita = ''; 

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
                'message'=>'File Gambar Berita bukan JPG/ JPEG/ PNG asli.',
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
                'message'=>'File Gambar Berita terdeteksi berbahaya.',
                'csrf'=>['name'=>$this->security->get_csrf_token_name(),
                'hash'=>$this->security->get_csrf_hash()]];  
                 echo json_encode($res); 
                exit;   
        }
       
        /* ================================
        * UPLOAD FILE KE FOLDER
        * ================================ */
        if ($allow_upload1) { 
            $name_berita = 'berita-' . date('YmdHis') . '-' . mt_rand(1000,9999);
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
                'file_name'        => $name_berita
            ];

            $this->load->library('upload');
            $this->upload->initialize($config1); 

            if (!$this->upload->do_upload('file1x')) {
                $res=['status'=>'error',
                'message'=>'Gagal upload File Gambar Berita, silahkan cari gambar lain.',
                'csrf'=>['name'=>$this->security->get_csrf_token_name(),
                'hash'=>$this->security->get_csrf_hash()]];  
                 echo json_encode($res); 
                exit;  
            }

            $data1        = $this->upload->data();
            $file_berita  = $data1['file_name'];
        }     

        /* ================================
        * INSERT Tabel
        * ================================ */
        $data = [
            'id_blog'           =>  $noUrut,
            'blog_slug'         =>  create_slug(strtolower($judul)).'-'.mt_rand(),
			'blog_tgl' 		    =>  $tanggal.' '.$waktu,
			'blog_tgl_edit' 	=>  $tanggal, 
			'blog_author'	    =>  htmlentities($author),
			'blog_title'	    =>	htmlentities($judul),
			'blog_isi'	        =>	$berita_isi, 
			'blog_img'	        =>	$file_berita ?? '', 
			'user_id'	        =>  user()->id_user,
			'posting'           =>  $posting
        ];

        $this->db->insert('tbl_blog', $data);

        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil menambah berita/artikel',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
       
        /* ================================
        * RESPONSE
        * ================================ */
        $res = [
            'status'  => 'success',
            'message' => 'Data Berita/Artikel Berhasil Disimpan.',
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
		  $berita_isi = $this->input->post('berita_isi'); 
		  $id = $this->input->post('id'); 

        $allowed_types = ['image/jpg','image/jpeg','image/png']; 
		  
		date_default_timezone_set('Asia/Jakarta');	 
		$waktu=date("H:i:s");  
	 
        $data=$this->db->query("select max(id_blog) maxKode from tbl_blog")->row_array();   
        $noUrut= (int)$data['maxKode'] + 1;   
    
        if ($judul == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Judul Berita .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($tanggal == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Tanggal Berita .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if((!empty($_FILES['file1x']['name']) && !in_array($_FILES['file1x']['type'],$allowed_types))) { 
          $res=['status'=>'error',
              'message'=>'Maaf File Gambar Berita Bukan Berformat JPG/ JPEG/ PNG. .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ((!empty($_FILES['file1x']['name']) && $_FILES['file1x']['size'] > 2000000)) {
          $res=['status'=>'error',
              'message'=>'Maaf File Gambar Berita lebih dari 2 MB .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($author == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Pembuat / Author .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        }  else if ($berita_isi == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Isian Berita .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else{  
              $data = array(  
                    'blog_slug'         =>  create_slug(strtolower($judul)).'-'.mt_rand(),
			        'blog_tgl' 		    =>  $tanggal.' '.$waktu,
			        'blog_tgl_edit' 	=>  $tanggal, 
			        'blog_author'	    =>  htmlentities($author),
			        'blog_title'	    =>	htmlentities($judul),
			        'blog_isi'	        =>	$berita_isi,  
			        'user_id'	        =>  user()->id_user,
			        'posting'           =>  $posting
                  );   
              
            $this->db->where('id_blog', aes_decrypt_id($id));   
            $this->db->update('tbl_blog', $data);  
 
        /* ================================
        * INISIALISASI VARIABEL
        * ================================ */
        $file_berita = ''; 

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
                'message'=>'File Gambar Berita bukan JPG/ JPEG/ PNG asli.',
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
                'message'=>'File Gambar Berita terdeteksi berbahaya.',
                'csrf'=>['name'=>$this->security->get_csrf_token_name(),
                'hash'=>$this->security->get_csrf_hash()]];  
                 echo json_encode($res); 
                exit;   
        }
       
        /* ================================
        * UPLOAD FILE KE FOLDER
        * ================================ */
        if ($allow_upload1) { 
            $cek=$this->db->query("SELECT * FROM tbl_blog where id_blog='".aes_decrypt_id($id)."'")->row_array();
            if (!empty($cek['blog_img'])) {
            $old_path = FCPATH . './storage/gambar/' . $cek['blog_img'];
            if (file_exists($old_path) && is_file($old_path)) {
            unlink($old_path);
            }
            }
            $name_berita = 'berita-' . date('YmdHis') . '-' . mt_rand(1000,9999);
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
                'file_name'        => $name_berita
            ];

            $this->load->library('upload');
            $this->upload->initialize($config1); 

            if ($this->upload->do_upload('file1x')) {
            $data1 = $this->upload->data();
            $this->db->where('id_blog', aes_decrypt_id($id));
            $this->db->update('tbl_blog', ['blog_img' => $data1['file_name']]);
            } else {
                $res=['status'=>'error',
                'message'=>'Gagal upload File Gambar Berita, silahkan cari gambar lain.',
                'csrf'=>['name'=>$this->security->get_csrf_token_name(),
                'hash'=>$this->security->get_csrf_hash()]];  
                 echo json_encode($res); 
                exit;  
            } 

            
        }      

        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil mengupdate berita/artikel',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
            
        /* ================================
        * RESPONSE
        * ================================ */
        $res = [
            'status'  => 'success',
            'message' => 'Data Berita/Artikel Berhasil Disimpan.',
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
		$blog=$this->db->query("SELECT * FROM tbl_blog where id_blog='".aes_decrypt_id($id)."'")->row_array();   
            if (!empty($blog['blog_img'])) {
            $old_path = FCPATH . './storage/gambar/' . $blog['blog_img'];
            if (file_exists($old_path) && is_file($old_path)) {
            unlink($old_path);
            }
            }
		    $this->db->where('id_blog', $blog['id_blog']);
            $this->db->delete('tbl_blog');

        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil menghapus berita/artikel',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
       
            $this->session->set_flashdata('flash','dihapus.');
            redirect('admin/berita');
	}
 

}

/* End of file Blog.php */
/* Location: ./application/controllers/admin/Blog.php */