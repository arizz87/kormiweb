<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pengguna extends My_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();  
        $this->load->database(); 
        $this->load->model('M_User');
	}

	public function index()
	{
		$data = [
			'title' => 'Pengaturan Data Pengguna',
			'view' => 'backend/pengguna/index',
			'contentTitle' => 'Pengaturan Data Pengguna',
			'pengguna' => $this->M_User->get_user_data(),
		];

		$this->load->view('layout/backend/content',$data);
	}

	public function tambah()
	{
		$data = [
			'title' => 'Pengaturan Data Pengguna',
			'contentTitle' => 'Tambah Data Pengguna',
			'view' => 'backend/pengguna/tambah', 
			'action' => 'Tambah',  
		];

		$this->load->view('layout/backend/content',$data);
	}

  
	public function edit($id=0)
	{
        if (!$id) {
        redirect('admin/data-pengguna');
        }

        $cek = $this->M_User->getOne($id);

        if (!$cek) {
        redirect('admin/data-pengguna');
        }
		$data = [
			'title' => 'Pengaturan Data Pengguna',
			'contentTitle' => 'Edit Data Pengguna',
			'view' => 'backend/pengguna/edit',
			'action' => 'Edit',   
			'pengguna' => $cek, 
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
    redirect('admin/data-pengguna');
    }

    $enc_id    = $this->input->post('enc_id', TRUE);
    $nonce     = $this->input->post('nonce', TRUE);
    $signature = $this->input->post('signature', TRUE);
    $action    = $this->input->post('action', TRUE);
  
    // Simpan Aksi Tambah
    if ($action === 'Tambah') { 
		cek_session();   
    
		  $username = $this->input->post('username');
		  $pass = $this->input->post('password'); 
		  $nama_pengguna = $this->input->post('nama_pengguna'); 
		  $email = $this->input->post('email'); 
		  $level = $this->input->post('level');  
          $password = password_hash($pass, PASSWORD_BCRYPT); // hash password 

        $data=$this->db->query("select max(id_user) maxKode from tbl_user")->row_array();   
        $noUrut= (int)$data['maxKode'] + 1;   
    
        if ($username == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Username Pengguna .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($pass == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Password Pengguna .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($nama_pengguna == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Nama Pengguna .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($email == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Email Pengguna .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else{  
        /* ================================
        * INSERT Tabel
        * ================================ */
        $data = [
            'id_user'           =>  $noUrut, 
			'username' 		    =>  $username,
			'nama_pengguna'     =>  $nama_pengguna,  
			'email'	            =>  $email,
			'password'	        =>  $password,
			'level'             =>  $level
        ];

        $this->db->insert('tbl_user', $data);
        
        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil menambah data akun pengguna',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
       
        /* ================================
        * RESPONSE
        * ================================ */
        $res = [
            'status'  => 'success',
            'message' => 'Data Akun Pengguna Berhasil Disimpan.',
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
    
 		  $username = $this->input->post('username');
		  $pass = $this->input->post('password'); 
		  $nama_pengguna = $this->input->post('nama_pengguna'); 
		  $email = $this->input->post('email'); 
		  $level = $this->input->post('level');  
          $password = password_hash($pass, PASSWORD_BCRYPT); // hash password 
		  $id = $this->input->post('id'); 

    
        if ($username == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Username Pengguna .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($nama_pengguna == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Nama Pengguna .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($email == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Email Pengguna .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else{
             if ($pass != ""){   
                    $data = array(   
			        'username' 		    =>  $username,
			        'nama_pengguna'     =>  $nama_pengguna,  
			        'email'	            =>  $email,
			        'password'	        =>  $password,
			        'level'             =>  $level
                     );  
             }else{ 
                    $data = array(   
			        'username' 		    =>  $username,
			        'nama_pengguna'     =>  $nama_pengguna,  
			        'email'	            =>  $email, 
			        'level'             =>  $level
                     );  
             }
              
            $this->db->where('id_user', aes_decrypt_id($id));   
            $this->db->update('tbl_user', $data);  

        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil mengupdate data akun pengguna',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
       
        /* ================================
        * RESPONSE
        * ================================ */
        $res = [
            'status'  => 'success',
            'message' => 'Data Akun Pengguna Berhasil Disimpan.',
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
            $kode = aes_decrypt_id($id); 
            $cek = $this->db
            ->where('id_user', $kode)
            ->get('tbl_user')
            ->row_array();

            if (user()->level =="admin"){ 
            if ($cek['username']!="admin"){
		    $this->db->where('id_user', aes_decrypt_id($id));
            $this->db->delete('tbl_user');
            }

        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil menghapus data akun pengguna',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
            }
            
            $this->session->set_flashdata('flash','dihapus.');
            redirect('admin/data-pengguna');
	}
 
}

/* End of file Blog.php */
/* Location: ./application/controllers/admin/Blog.php */