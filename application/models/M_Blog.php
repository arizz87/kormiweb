<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Blog extends CI_Model {
	
	public function get_blogs()
    {
		$this->db->where('posting', 'Posting');
		$this->db->order_by('blog_tgl', 'DESC'); // terbaru di atas
		$this->db->limit(30);
        return $this->db->get('tbl_blog')->result_array();
    }

	
	public function get_blogs_terbaru()
    {
		$this->db->where('posting', 'Posting');
		$this->db->order_by('blog_tgl', 'DESC'); // terbaru di atas
		$this->db->limit(10);
        return $this->db->get('tbl_blog')->result_array();
    }
 
	public function get_blog_detail($slug)
	{
		return $this->db->get_where("tbl_blog",["blog_slug" => $slug]);
	} 

	public function get_blogs_data()
    { 
		$this->db->order_by('blog_tgl', 'DESC'); // terbaru di atas 
        return $this->db->get('tbl_blog')->result_array();
    }
 
	public function getOne($id)
	{
		return $this->db->get_where("tbl_blog",["id_blog" => aes_decrypt_id($id)])->row_array();
	}

}

/* End of file M_Blog.php */
/* Location: ./application/models/M_Blog.php */