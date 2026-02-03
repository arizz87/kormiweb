<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Login extends CI_Model
{
	public function __construct()
	{
	parent::__construct();
	}
	
   public function get_by_username($username)
    {
    $this->db->where('username', $username);
    return $this->db->get('tbl_user')->row();
    }

    public function update_login_attempt($username, $success)
    {
        if ($success) {
            // Reset jika berhasil login
            $this->db->where('username', $username)
                     ->update('tbl_user', [
                         'failed_login_attempts' => 0,
                         'last_login_attempt' => date('Y-m-d H:i:s')
                     ]);
        } else {
            // Gagal login → tambah hitungan gagal
            $this->db->set('failed_login_attempts', 'failed_login_attempts+1', FALSE)
                     ->set('last_login_attempt', date('Y-m-d H:i:s'))
                     ->where('username', $username)
                     ->update('tbl_user');
        }
    }

}
?>