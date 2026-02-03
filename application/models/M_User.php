<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_User extends CI_Model {
	
	public function get_user()
    {
		$this->db->where('tampil', 'Ya');
		$this->db->order_by('id_user', 'ASC'); // terbaru di atas 
        return $this->db->get('tbl_user')->result_array();
    }
  
	public function get_user_data()
    { 
		$this->db->order_by('id_user', 'ASC'); // terbaru di atas 
        return $this->db->get('tbl_user')->result_array();
    }
 
	public function getOne($id)
	{
		return $this->db->get_where("tbl_user",["id_user" => aes_decrypt_id($id)])->row_array();
	}

}

/* End of file M_Blog.php */
/* Location: ./application/models/M_Blog.php */