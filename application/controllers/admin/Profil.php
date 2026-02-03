<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends My_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();  
        $this->load->database(); 
        $this->load->model('M_Profil');
	}

	public function index()
	{
		$data = [
			'title' => 'Pengaturan Profil Lembaga',
			'view' => 'backend/profil/index',
			'contentTitle' => 'Pengaturan Profil Lembaga',
			'galeri' => $this->M_Profil->get_profil_data(),
		];

		$this->load->view('layout/backend/content',$data);
	}


	public function updateinstansi()
	{
		$id=$this->input->post('idinstansi');
		$this->db->where("id_instansi",decrypt_data($id));
		$this->db->update("tbl_instansi",[
			'nama_lembaga' => htmlentities($this->input->post('nama_lembaga', TRUE)),
			'prolog' => htmlentities($this->input->post('prolog', TRUE)),
			'sejarah' => htmlentities($this->input->post('sejarah', TRUE)),
			'alamat' => htmlentities($this->input->post('alamat', TRUE)),
			'no_telpon' => htmlentities($this->input->post('notelp', TRUE)),
			'email' => htmlentities($this->input->post('email', TRUE)),
			'facebook' => htmlentities($this->input->post('facebook', TRUE)),
			'instragram' => htmlentities($this->input->post('instragram', TRUE)),
			'no_wa' => htmlentities($this->input->post('no_wa', TRUE)),
		]); 
		create_log_activity(user()->username.' berhasil merubah profil data lembaga/ instansi',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);	

		$this->session->set_flashdata('flash', 'disimpan');
		redirect('admin/profile');
	}
	
	public function updatephoto()
	{  
		if(empty($_FILES['file']['name'])) { 
			$this->session->set_flashdata('flash','disimpan');
			redirect('admin/profile');
		}else{
			$allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
			if(in_array($_FILES['file']['type'],$allowed_types)){ 
			if ($_FILES['file']['size'] > 2000000) {
				$this->session->set_flashdata('flashx','kapasitas file gambar lebih dari 2 MB');
				redirect('admin/profile');
			}else{ 
				$id=$this->input->post('idpoto');
				$old = $this->input->post('old');   
				$path = './storage/gambar/'.$old;
				chmod($path, 0777);
				unlink($path);
				$pimpinan_img = upload_img("profile");
				$this->db->where("id_instansi",$id);	 
				$this->db->update("tbl_instansi",[
					'pimpinan_img'	=>	$pimpinan_img, 	
				]); 
				create_log_activity(user()->username.' berhasil merubah foto kepala instansi',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);	
				$this->session->set_flashdata('flash','disimpan');
				redirect('admin/profile');
			}
			}else{ 
			$this->session->set_flashdata('flashx','format gambar bukan jpeg/jpg/png/gif');
			redirect('admin/profile');
			}
		}	 
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
    redirect('admin/profil');
    }

    $enc_id    = $this->input->post('enc_id', TRUE);
    $nonce     = $this->input->post('nonce', TRUE);
    $signature = $this->input->post('signature', TRUE);
    $action    = $this->input->post('action', TRUE);
  
    // Simpan Aksi Tambah
    if ($action === 'update-profil') { 
		cek_session();   
    
 		  $nama_lembaga = $this->input->post('nama_lembaga');
		  $alamat = $this->input->post('alamat');
		  $notelp = $this->input->post('notelp'); 
		  $email = $this->input->post('email'); 
		  $facebook = $this->input->post('facebook');
		  $instragram = $this->input->post('instragram');
		  $no_wa = $this->input->post('no_wa');
		  $prolog = $this->input->post('prolog');
		  $sejarah = $this->input->post('sejarah');
		  $id = $this->input->post('idinstansi'); 

        if ($nama_lembaga == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Nama Lembaga/ Instansi .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($alamat == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Alamat Lembaga/ Instansi .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($notelp == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi No.Telepon .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        }else if ($email == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Alamat Email .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        }else if ($facebook == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Facebook .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        }else if ($instragram == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Instragram .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        }else if ($no_wa == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi No.Whatsapp .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        }else if ($prolog == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Prolog .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        }else if ($sejarah == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Sejarah .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else{ 

        /* ================================
        * INSERT Tabel
        * ================================ */
        $data = [
            'nama_lembaga' => htmlentities($this->input->post('nama_lembaga', TRUE)),
			'prolog' => $this->input->post('prolog', TRUE),
			'sejarah' =>$this->input->post('sejarah', TRUE),
			'alamat' => htmlentities($this->input->post('alamat', TRUE)),
			'no_telpon' => htmlentities($this->input->post('notelp', TRUE)),
			'email' => htmlentities($this->input->post('email', TRUE)),
			'facebook' => htmlentities($this->input->post('facebook', TRUE)),
			'instragram' => htmlentities($this->input->post('instragram', TRUE)),
			'no_wa' => htmlentities($this->input->post('no_wa', TRUE)),
        ];

            $this->db->where('id_instansi', decrypt_data($id));   
            $this->db->update('tbl_instansi', $data);  

        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil mengupdate data profil lembaga',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
       
        /* ================================
        * RESPONSE
        * ================================ */
        $res = [
            'status'  => 'success',
            'message' => 'Data Profil Lembaga Berhasil Disimpan.',
            'csrf'    => [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            ]
        ];

    } 
        echo json_encode($res);
        exit;
    }else if ($action === 'update-photo') { 
     cek_session();   
    
 		  $file1x = $this->input->post('file1x');
		  $id = $this->input->post('idpoto'); 

        $allowed_types = ['image/jpg','image/jpeg','image/png']; 
		  
		date_default_timezone_set('Asia/Jakarta');	 
		$waktu=date("H:i:s");  
	 
       
        if((!empty($_FILES['file1x']['name']) && !in_array($_FILES['file1x']['type'],$allowed_types))) { 
          $res=['status'=>'error',
              'message'=>'Maaf File Gambar Photo Pimpinan Bukan Berformat JPG/ JPEG/ PNG. .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ((!empty($_FILES['file1x']['name']) && $_FILES['file1x']['size'] > 2000000)) {
          $res=['status'=>'error',
              'message'=>'Maaf File Gambar Photo Pimpinan lebih dari 2 MB .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        }  else{  
 
        /* ================================
        * INISIALISASI VARIABEL
        * ================================ */
        $file_profil = ''; 

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
                'message'=>'File Gambar Photo Pimpinan bukan JPG/ JPEG/ PNG asli.',
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
                'message'=>'File Gambar Photo Pimpinan terdeteksi berbahaya.',
                'csrf'=>['name'=>$this->security->get_csrf_token_name(),
                'hash'=>$this->security->get_csrf_hash()]];  
                 echo json_encode($res); 
                exit;   
        }
       
        /* ================================
        * UPLOAD FILE KE FOLDER
        * ================================ */ 
        if ($allow_upload1) { 
            $cek=$this->db->query("SELECT * FROM tbl_instansi where id_instansi='".decrypt_data($id)."'")->row_array();
            if (!empty($cek['pimpinan_img'])) {
            $old_path = FCPATH . './storage/gambar/' . $cek['pimpinan_img'];
            if (file_exists($old_path) && is_file($old_path)) {
            unlink($old_path);
            }
            }
            $name_photo = 'profil-' . date('YmdHis') . '-' . mt_rand(1000,9999);
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
                'file_name'        => $name_photo
            ];

            $this->load->library('upload');
            $this->upload->initialize($config1); 

            if ($this->upload->do_upload('file1x')) {
            $data1 = $this->upload->data();
            $this->db->where('id_instansi', decrypt_data($id));
            $this->db->update('tbl_instansi', ['pimpinan_img' => $data1['file_name']]);
            } else {
                $res=['status'=>'error',
                'message'=>'Gagal upload File Gambar Photo Pimpinan, silahkan cari gambar lain.',
                'csrf'=>['name'=>$this->security->get_csrf_token_name(),
                'hash'=>$this->security->get_csrf_hash()]];  
                 echo json_encode($res); 
                exit;  
            } 

            
        }      

        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil mengupdate data photo profil lembaga',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
       
        /* ================================
        * RESPONSE
        * ================================ */
        $res = [
            'status'  => 'success2',
            'message' => 'Data Photo Profil Lembaga Berhasil Disimpan.',
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