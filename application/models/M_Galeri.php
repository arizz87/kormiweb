<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Galeri extends CI_Model {
	
	public function get_galeri()
    {
		$this->db->where('tampil', 'Ya');
		$this->db->order_by('galeri_tgl', 'DESC'); // terbaru di atas
		$this->db->limit(30);
        return $this->db->get('tbl_galeri')->result_array();
    }
  
	public function get_galeri_data()
    { 
		$this->db->order_by('galeri_tgl', 'DESC'); // terbaru di atas 
        return $this->db->get('tbl_galeri')->result_array();
    }
 
	public function getOne($id)
	{
		return $this->db->get_where("tbl_galeri",["id_galeri" => aes_decrypt_id($id)])->row_array();
	}

}

/* End of file M_Blog.php */
/* Location: ./application/models/M_Blog.php */