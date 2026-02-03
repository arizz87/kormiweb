<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Ppid extends CI_Model {

	public function create($table,$data=[])
	{
		return $this->db->insert($table,$data);
	}
		
	public function get_profil($limit,$start,$kategori_id=NULL)
	{	
		if ($kategori_id) {
			$this->db->where("id_ppid",$kategori_id);
		}
		return $this->db->get('tbl_ppid',$limit,$start);
	}

	public function get_profil_detail($slug)
	{
		return $this->db->get_where("tbl_ppid",["judul_slug" => $slug]);
	}	

}

/* End of file M_Blog.php */
/* Location: ./application/models/M_Blog.php */