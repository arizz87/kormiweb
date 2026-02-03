<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends My_Controller {
	
	public function __construct()
	{
		parent::__construct();
        $this->load->database(); 
        $this->load->model('M_Login');
	}

	public function index()
	{	
			 
        $this->load->view('frontend/login/index'); 
	}


	public function proses_login()
	{
    if (!$this->input->is_ajax_request()) {
        redirect('admin/dashboard');    
        exit;
    }

    $username = $this->input->post('username', TRUE);
    $password = $this->input->post('password', TRUE);

    if (empty($username) || empty($password)) {
        $res = [
            'status' => 'error',
            'message' => 'Username atau Password tidak boleh kosong.',
            'csrf' => [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            ]
        ];
        $this->_response($res);
    }

    $user = $this->M_Login->get_by_username($username);

    if ($user) {
        // Hitung batas percobaan login (misal 5 kali / 10 menit)
        $max_attempts = 5;
        $lock_duration = 10 * 60; // 10 menit

        if ($user->failed_login_attempts >= $max_attempts) {
            $last = strtotime($user->last_login_attempt);
            if (time() - $last < $lock_duration) {
                $res = [
                    'status' => 'error',
                    'message' => 'Akun terkunci sementara karena terlalu banyak percobaan gagal. Silakan coba lagi nanti.',
                    'csrf' => [
                        'name' => $this->security->get_csrf_token_name(),
                        'hash' => $this->security->get_csrf_hash()
                    ]
                ];
                $this->_response($res);
            }
        }

        // Cek password
        if (password_verify($password, $user->password)) {
            // Login berhasil → reset percobaan
            $this->M_Login->update_login_attempt($username, TRUE);

            // Regenerasi session ID
            $this->session->sess_regenerate(TRUE);

            $params = [
                'kode_user' => $user->id_user, 
                'username' => $user->username,
                'nama_pengguna' => $user->nama_pengguna, 
                'level' => $user->level, 
            ];
            $this->session->set_userdata($params);

			create_log_activity(user()->username.' telah melakukan login',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
            
            $res = [
                'status' => 'success',
                'message' => 'Selamat menjalankan halaman admin.',
                'csrf' => [
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                ]
            ];
        } else {
            // Password salah → tambah hitungan gagal
            $this->M_Login->update_login_attempt($username, FALSE);

            $res = [
                'status' => 'error',
                'message' => 'Username atau Password salah.',
                'csrf' => [
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                ]
            ];
        }
    } else {
        // Username tidak ditemukan
        $res = [
            'status' => 'error',
            'message' => 'Akun tidak ditemukan.',
            'csrf' => [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            ]
        ];
    }

    $this->_response($res);
	}

	// Fungsi bantu untuk kirim response JSON + exit
	private function _response($res)
	{
		header('Content-Type: application/json');
		echo json_encode($res);
		exit;
	}


 
	public function logout()
		{ 
			$params=array('id_user','level','username');
			$this->session->unset_userdata($params);
		    create_log_activity(user()->username.' telah melakukan logout',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
           redirect('login');
		} 

}
/* End of file Blog.php */
/* Location: ./application/controllers/Blog.php */