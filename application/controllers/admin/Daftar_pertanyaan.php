<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_pertanyaan extends My_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();  
        $this->load->database(); 
        $this->load->model('M_Pertanyaan');
	}

	public function index()
	{
		$data = [
			'title' => 'Pengaturan Daftar Pertanyaan',
			'view' => 'backend/pertanyaan/index',
			'contentTitle' => 'Pengaturan Daftar Pertanyaan',
			'pertanyaan' => $this->M_Pertanyaan->get_pertanyaan_data(),
		];

		$this->load->view('layout/backend/content',$data);
	}

	public function tambah()
	{
		$data = [
			'title' => 'Pengaturan Daftar Pertanyaan',
			'contentTitle' => 'Buat Daftar Pertanyaan',
			'view' => 'backend/pertanyaan/tambah', 
			'action' => 'Tambah',  
		];

		$this->load->view('layout/backend/content',$data);
	}

  
	public function edit($id=0)
	{
        if (!$id) {
        redirect('admin/daftar-pertanyaan');
        }

        $cek = $this->M_Pertanyaan->getOne($id);

        if (!$cek) {
        redirect('admin/daftar-pertanyaan');
        }
		$data = [
			'title' => 'Pengaturan Daftar Pertanyaan',
			'contentTitle' => 'Edit Daftar Pertanyaan',
			'view' => 'backend/pertanyaan/edit',
			'action' => 'Edit',   
			'pertanyaan' => $cek, 
		];

		$this->load->view('layout/backend/content',$data);
	} 
  
    public function proses()
    { 
	cek_session(); 
    $res = [
        'status'  => 'fatal',
        'message' => 'Unknown error.',
        'csrf' => [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        ] 
    ];
    
    // hanya terima POST
    if ($this->input->method() !== 'post') {
    redirect('admin/daftar-pertanyaan');
    }

    $enc_id    = $this->input->post('enc_id', TRUE);
    $nonce     = $this->input->post('nonce', TRUE);
    $signature = $this->input->post('signature', TRUE);
    $action    = $this->input->post('action', TRUE);
  
    // Simpan Aksi Tambah
    if ($action === 'Tambah') { 
		cek_session();   
    
		  $pertanyaan = $this->input->post('pertanyaan');
		  $jawaban = $this->input->post('jawaban'); 
		  $posting = $this->input->post('posting');  

        $data=$this->db->query("select max(id_pertanyaan) maxKode from tbl_pertanyaan")->row_array();   
        $noUrut= (int)$data['maxKode'] + 1;   
    
        if ($pertanyaan == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Pertanyaan seputar KORMI .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($jawaban == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Jawaban dari Pertanyaan .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else{  
        /* ================================
        * INSERT Tabel
        * ================================ */
        $data = [
            'id_pertanyaan'     =>  $noUrut, 
			'pertanyaan' 		=>  $pertanyaan,
			'jawaban' 	        =>  $jawaban,  
			'user_id'	        =>  user()->id_user,
			'tampil'           =>  $posting
        ];

        $this->db->insert('tbl_pertanyaan', $data);
        
        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil menambah daftar pertanyaan',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
       
        /* ================================
        * RESPONSE
        * ================================ */
        $res = [
            'status'  => 'success',
            'message' => 'Data Daftar Pertanyaan Berhasil Disimpan.',
            'csrf'    => [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            ]
        ];

    } 
        echo json_encode($res);
        exit;
    }else if ($action === 'Edit') { 
     cek_session();   
    
 		  $pertanyaan = $this->input->post('pertanyaan');
		  $jawaban = $this->input->post('jawaban');  
		  $posting = $this->input->post('posting');  
		  $id = $this->input->post('id'); 

    
         if ($pertanyaan == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Pertanyaan seputar KORMI .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else if ($jawaban == "") {
          $res=['status'=>'error',
              'message'=>'Maaf Anda Belum Mengisi Jawaban dari Pertanyaan .. !',
          'csrf'=>['name'=>$this->security->get_csrf_token_name(),
              'hash'=>$this->security->get_csrf_hash()]]; 
        } else{  
              $data = array(  
			        'pertanyaan' 		=>  $pertanyaan,
			        'jawaban' 	        =>  $jawaban,  
			        'user_id'	        =>  user()->id_user,
			        'tampil'           =>  $posting
                  );   
              
            $this->db->where('id_pertanyaan', aes_decrypt_id($id));   
            $this->db->update('tbl_pertanyaan', $data);  

        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil mengupdate daftar pertanyaan',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
       
        /* ================================
        * RESPONSE
        * ================================ */
        $res = [
            'status'  => 'success',
            'message' => 'Data Daftar Pertanyaan Berhasil Disimpan.',
            'csrf'    => [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            ]
        ];

    } 
        echo json_encode($res);
        exit;   
    }
    }

    private function json_out($arr)
    {
    header("Content-Type: application/json");
    echo json_encode($arr);
    exit;
    }
   
	public function delete($id=0)
	{
            if (user()->level =="admin"){ 
		    $this->db->where('id_pertanyaan', aes_decrypt_id($id));
            $this->db->delete('tbl_pertanyaan');

        /* ================================
        * Update Log Aplikasi
        * ================================ */
        create_log_activity(user()->username.' berhasil menghapus daftar pertanyaan',user()->username,$_SERVER['REQUEST_URI'],$_SERVER['HTTP_USER_AGENT']);
            }
            
            $this->session->set_flashdata('flash','dihapus.');
            redirect('admin/daftar-pertanyaan');
	}
 
}

/* End of file Blog.php */
/* Location: ./application/controllers/admin/Blog.php */