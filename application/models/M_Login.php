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

    public function check_login_limit($username, $ip, $max = 5, $lock = 600)
    {
        $row = $this->db->get_where('login_attempts', [
            'username' => $username,
            'ip_address' => $ip
        ])->row();

        if ($row) {
            if ($row->attempts >= $max) {
                if (time() - strtotime($row->last_attempt) < $lock) {
                    return FALSE; // masih terkunci
                }
            }
        }
        return TRUE;
    }

    public function increase_attempt($username, $ip)
    {
        $row = $this->db->get_where('login_attempts', [
            'username' => $username,
            'ip_address' => $ip
        ])->row();

        if ($row) {
            $this->db->update('login_attempts', [
                'attempts' => $row->attempts + 1,
                'last_attempt' => date('Y-m-d H:i:s')
            ], ['id' => $row->id]);
        } else {
            $this->db->insert('login_attempts', [
                'username' => $username,
                'ip_address' => $ip,
                'attempts' => 1,
                'last_attempt' => date('Y-m-d H:i:s')
            ]);
        }
    }

    public function reset_attempt($username, $ip)
    {
        $this->db->delete('login_attempts', [
            'username' => $username,
            'ip_address' => $ip
        ]);
    }

}
?>