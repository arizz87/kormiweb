<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_video extends CI_Model {
	
	public function get_video()
    {
		$this->db->where('tampil', 'Ya');
		$this->db->order_by('id_video', 'DESC'); // terbaru di atas
        return $this->db->get('tbl_video')->result_array();
    }
  
	public function get_video_data()
    { 
		$this->db->order_by('id_video', 'DESC'); // terbaru di atas 
        return $this->db->get('tbl_video')->result_array();
    }
 
	public function getOne($id)
	{
		return $this->db->get_where("tbl_video",["id_video" => aes_decrypt_id($id)])->row_array();
	}

	public function get_video_header()
    { 
		$this->db->order_by('id_video', 'DESC'); // terbaru di atas 
        return $this->db->get('tb_video_header')->result_array();
    }
	
	public function get_video_header_data()
    { 
		$this->db->order_by('id_video', 'DESC'); // terbaru di atas 
        return $this->db->get('tb_video_header')->row_array();
    }
	public function getVideo($id)
	{
		return $this->db->get_where("tb_video_header",["id_video" => aes_decrypt_id($id)])->row_array();
	}
 

}

/* End of file M_Blog.php */
/* Location: ./application/models/M_Blog.php */