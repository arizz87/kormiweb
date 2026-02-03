<?php

function check_session_login(){
    $ci =& get_instance();
    $user_session=$ci ->session->userdata('kode_user');
    if ($user_session){
        redirect('dashboard');
    }
}

function check_not_login(){
    $ci =& get_instance();
    $user_session=$ci ->session->userdata('kode_user');
    if (!$user_session){
        redirect('login');
    }
}

function cek_session() {
    $CI =& get_instance();
    if (!$CI->session->userdata('kode_user')) {
        if ($CI->input->is_ajax_request()) {
            echo json_encode(['status' => 'session_expired']);
            exit;
        } else {
            redirect('dashboard');
        } 
    }
}

function check_popup_update()
{
    $CI = &get_instance();

    // Ambil data session
    $npsn       = $_SESSION['npsn'] ?? null;
    $kode_user  = $_SESSION['kode_user'] ?? null;

    // Ambil data user
    $datauser = $CI->db->get_where('tb_user', ['kode_user'=> $kode_user])->row_array();

    // Ambil data sekolah
    $datanpsn = $CI->db->get_where('sekolah', ['npsn'=> $npsn])->row_array();


    // =============================
    // KONDISI WAJIB UPDATE
    // =============================

    // 1. Status user aktif?
    $harus_update1 = (!empty($datauser) && $datauser['status'] == 1) ? 0 : 1;

    // 2. Data sekolah ditemukan?
    $harus_update2 = !empty($datanpsn) ? 0 : 1;

    // 3. Jenjang terisi?
    $harus_update3 = (!empty($datanpsn) && !empty($datanpsn['jenjang'])) ? 0 : 1; 

    // =============================
    // HASIL AKHIR
    // =============================
    // Jika salah satu kondisi belum terpenuhi → popup muncul
    if ($datauser['level']=="user"){
    if ($harus_update1 == 1 || $harus_update2 == 1 || $harus_update3 == 1) {
        return 1; // tampilkan popup
    } else {
        return 0; // tidak tampil
    }
    }else{
    if ($harus_update1 == 1) {
        return 1; // tampilkan popup
    } else {
        return 0; // tidak tampil
    }
        
    }
}


// ambil user data yang sedang login
function user()
{
	$CI =& get_instance();
	$user = $CI->db->get_where('tbl_user',[
		'id_user' => $CI->session->userdata('kode_user'),
	])->row();
	return $user;
}

// hitung jumlah record
function count_data($table)
{
	$ci = get_instance();
	return $ci->db->count_all($table);
}
 
function create_slug($str)
{
	$illegal_string=[" ","?","!","(",")","^","$","#","@","{","}","+","[","]","/","'\'",
					"<",">",";",":","|","'",'"',",","`","*","%"];
	return str_replace($illegal_string,"-",$str);
}

// buat log activity
function create_log_activity($name,$user,$metode,$browser)
{
	$CI =& get_instance();
	$CI->db->insert('tbl_log_activity',[
		'log_activity_name' => $name,
		'log_activity_user' => $user,
		'metode' => $metode,
		'browser_pengguna' => $browser,
	]);
}

function rupiah($angka){
    $jadi="Rp."." ".number_format($angka,0,',','.');
    //$jadi=number_format($angka,0,',','.');
    return $jadi;
}

function rupiah2($angka){
    $jadi=number_format($angka,0,',','.');
    //$jadi=number_format($angka,0,',','.');
    return $jadi;
}

function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
        $temp = penyebut($nilai - 10). " Belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " Seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " Seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
}

function terbilang($nilai) {
    if($nilai<0) {
        $hasil = "minus ". trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }     		
    return $hasil;
}

// Mendapatkan IP pengunjung menggunakan getenv()
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'IP tidak dikenali';
    return $ipaddress;
}
  
  
// Mendapatkan IP pengunjung menggunakan $_SERVER
function get_client_ip_2() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'IP tidak dikenali';
    return $ipaddress;
}
  
  
// Mendapatkan jenis web browser pengunjung
function get_client_browser() {
    $browser = '';
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
        $browser = 'Netscape';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
        $browser = 'Firefox';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
        $browser = 'Chrome';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
        $browser = 'Opera';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
        $browser = 'Internet Explorer';
    else
        $browser = 'Other';
    return $browser;
}

if (!function_exists('scan_file_safe')) {
    function scan_file_safe($tmp)
    {
        if (!file_exists($tmp)) {
            return false;
        }

        $content = file_get_contents($tmp);
        if ($content === false) {
            return false;
        }

        $bad = [
            '<?php',
            '<?=',
            'eval(',
            'base64_decode',
            'shell_exec',
            'system(',
            'passthru',
            'exec('
        ];

        foreach ($bad as $b) {
            if (stripos($content, $b) !== false) {
                return false;
            }
        }

        return true;
    }
}