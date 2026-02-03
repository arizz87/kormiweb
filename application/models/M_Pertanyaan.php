<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Pertanyaan extends CI_Model {
	
	public function get_pertanyaan()
    {
		$this->db->where('tampil', 'Ya');
		$this->db->order_by('id_pertanyaan', 'ASC'); // terbaru di atas 
        return $this->db->get('tbl_pertanyaan')->result_array();
    }
  
	public function get_pertanyaan_data()
    { 
		$this->db->order_by('id_pertanyaan', 'ASC'); // terbaru di atas 
        return $this->db->get('tbl_pertanyaan')->result_array();
    }
 
	public function getOne($id)
	{
		return $this->db->get_where("tbl_pertanyaan",["id_pertanyaan" => aes_decrypt_id($id)])->row_array();
	}

}

/* End of file M_Blog.php */
/* Location: ./application/models/M_Blog.php */