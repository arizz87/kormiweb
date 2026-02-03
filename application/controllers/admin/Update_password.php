<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_password extends My_Controller {

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
			'title' => 'Perubahan Password',
			'view' => 'backend/update_password',
			'contentTitle' => 'Perubahan Password',
			'pengguna' => $this->M_User->get_user_data(),
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
    if ($action === 'Update') { 
     cek_session();    
		  $pass = $this->input->post('password');  
          $password = password_hash($pass, PASSWORD_BCRYPT); // hash password   
    
        if ($pass == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Password Baru tidak boleh kosong .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else{ 
                    $data = array(    
			        'password'	        =>  $password, 
                     );   

            $this->db->where('id_user', $_SESSION['kode_user']);   
            $this->db->update('tbl_user', $data);  

        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil merubah password baru',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
       
        /* ================================
        * RESPONSE
        * ================================ */
        $res = [
            'status'  => 'success',
            'message' => 'Password Baru Berhasil Disimpan.',
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