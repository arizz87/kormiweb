<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Profil extends CI_Model {
	
	public function get_profil()
    {
        return $this->db->get('tbl_instansi')->row_array();
    }
  
	public function get_profil_data()
    { 
		$this->db->order_by('id_instansi', 'DESC'); // terbaru di atas 
        return $this->db->get('tbl_instansi')->result_array();
    }
 
	public function getOne($id)
	{
		return $this->db->get_where("tbl_instansi",["id_instansi" => aes_decrypt_id($id)])->row_array();
	}

}
