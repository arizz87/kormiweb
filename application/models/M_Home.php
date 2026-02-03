<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Home extends CI_Model {

	//get data jurusan
	public function get_info_jurusan()
	{
		return $this->db->select('tbl_jurusan.*,tbl_kategori_jurusan.nama_kategori_jurusan')
					->from('tbl_jurusan')
					->join('tbl_kategori_jurusan','tbl_jurusan.kategori_jurusan_id=tbl_kategori_jurusan.id_kategori_jurusan')
					->order_by('tbl_jurusan.id_jurusan','ASC')->get()->result_array();
	}

	
	// agenda
	public function get_agenda_by_id($id)
	{
		return $this->db->get_where("tbl_agenda",["id_agenda" => $id]);
	}

	public function get_agenda($limit=NULL,$start=NULL)
	{
		return $this->db->order_by('created_at','DESC')->get("tbl_agenda",$limit,$start);
	}

	//pengumuman
	public function get_pengumuman_by_id($id=NULL)
	{
		return $this->db->get_where("tbl_pengumuman",["id_pengumuman" => $id]);
	}

	public function get_pengumuman($limit,$start)
	{
		return $this->db->order_by('created_at','DESC')->get("tbl_pengumuman",$limit,$start);
	}

}

/* End of file M_Home.php */
/* Location: ./application/models/M_Home.php */