<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('format_indo')) {
  function format_indo($date){
    date_default_timezone_set('Asia/Jakarta');
    // array hari dan bulan
    $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
    $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    
    // pemisahan tahun, bulan, hari, dan waktu
    $tahun = substr($date,0,4);
    $bulan = substr($date,5,2);
    $tgl = substr($date,8,2);
    $waktu = substr($date,11,5);
    $hari = date("w",strtotime($date));
    $result = $tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." (".$waktu." WIB)";

    return $result;
  }
}
  
if (!function_exists('format_indo2')) {
    function format_indo2($date){
      date_default_timezone_set('Asia/Jakarta');
      // array hari dan bulan
      $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
      $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
      
      // pemisahan tahun, bulan, hari, dan waktu
      $tahun = substr($date,0,4);
      $bulan = substr($date,5,2);
      $tgl = substr($date,8,2);
      $waktu = substr($date,11,5);
      $hari = date("w",strtotime($date));
      $result = $tgl."-".$bulan."-".$tahun;
  
      return $result;
    }
}

if (!function_exists('format_indo3')) {
    function format_indo3($date){
      date_default_timezone_set('Asia/Jakarta');
      // array hari dan bulan
      $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
      $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
      
      // pemisahan tahun, bulan, hari, dan waktu
      $tahun = substr($date,0,4);
      $bulan = substr($date,5,2);
      $tgl = substr($date,8,2);
      $waktu = substr($date,11,5);
      $hari = date("w",strtotime($date));
      $result = $Hari[(int)$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun;
  
      return $result;
    }
  }

if (!function_exists('format_tahun')) {
  function format_tahun($date){
    date_default_timezone_set('Asia/Jakarta');
    // array hari dan bulan
    $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
    $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    
    // pemisahan tahun, bulan, hari, dan waktu
    $tahun = substr($date,0,4);
    $bulan = substr($date,5,2);
    $tgl = substr($date,8,2);
    $waktu = substr($date,11,5);
    $hari = date("w",strtotime($date));
    $result = $tgl."-".$bulan."-".$tahun;

    return $tahun;
  }
}

if (!function_exists('format_hari')) {
  function format_hari($date){
    date_default_timezone_set('Asia/Jakarta');
    // array hari dan bulan
    $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
    $Bulan = array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des");
    
    // pemisahan tahun, bulan, hari, dan waktu
    $tahun = substr($date,0,4);
    $bulan = substr($date,5,2);
    $tgl = substr($date,8,2);
    $waktu = substr($date,11,5);
    $hari = date("w",strtotime($date));
    $result = $tgl."-".$bulan."-".$tahun;

    return$Hari[(int)$hari];
  }
}

function bln_indonesia($bulan) {
$array_bulan=array("01"=>"Januari",
"02"=>"Feb",
"03"=>"Mar",
"04"=>"April",
"05"=>"Mei",
"06"=>"Juni",
"07"=>"Juli",
"08"=>"Agustus",
"09"=>"September",
"10"=>"Oktober",
"11"=>"Nopember",
"12"=>"Desember");
$bln_temp=explode("-",$bulan);
$bln=$bln_temp[1];
$thn=$bln_temp[0];
$nama_bulan=$array_bulan[$bln];
return $nama_bulan." ".$thn;
}

function tgl_indonesia($tanggal) {
$array_bulan=array("01"=>"Januari",
"02"=>"Februari",
"03"=>"Maret",
"04"=>"April",
"05"=>"Mei",
"06"=>"Juni",
"07"=>"Juli",
"08"=>"Agustus",
"09"=>"September",
"10"=>"Oktober",
"11"=>"Nopember",
"12"=>"Desember");
$tgl_temp=explode("-",$tanggal);
$tgl=$tgl_temp[2];
$bln=$tgl_temp[1];
$thn=$tgl_temp[0];
$nama_bulan=$array_bulan[$bln];
return $tgl." ".$nama_bulan." ".$thn;
}


function tgl_indonesia2($tanggal2) {
$array_bulan2=array("00"=>"00",
"01"=>"01",
"02"=>"02",
"03"=>"03",
"04"=>"04",
"05"=>"05",
"06"=>"06",
"07"=>"07",
"08"=>"08",
"09"=>"09",
"10"=>"10",
"11"=>"11",
"12"=>"12");
$tgl_temp2=explode("-",$tanggal2);
$tgl2=$tgl_temp2[2];
$bln2=$tgl_temp2[1];
$thn2=$tgl_temp2[0];
$nama_bulan2=$array_bulan2[$bln2];
return $tgl2."-".$nama_bulan2."-".$thn2;
}

function tgl_indonesia3($tanggal3) {
$array_bulan3=array("01"=>"Januari",
"02"=>"Februari",
"03"=>"Maret",
"04"=>"April",
"05"=>"Mei",
"06"=>"Juni",
"07"=>"Juli",
"08"=>"Agustus",
"09"=>"September",
"10"=>"Oktober",
"11"=>"Nopember",
"12"=>"Desember");
$tgl_temp3=explode("-",$tanggal3);//2021-09-08
$tgl3=$tgl_temp3[2];
$bln3=$tgl_temp3[1];
$thn3=$tgl_temp3[0];
$nama_bulan3=$array_bulan3[$thn3];
return $nama_bulan3;
}

function getbulan($bulann) {
 switch ((int)$bulann) {
        case 1: return 'Jan';
        case 2: return 'Feb';
        case 3: return 'Mar';
        case 4: return 'Apr';
        case 5: return 'Mei';
        case 6: return 'Jun';
        case 7: return 'Jul';
        case 8: return 'Agu';
        case 9: return 'Sep';
        case 10: return 'Okt';
        case 11: return 'Nov';
        case 12: return 'Des';
        default: return '-';
    }
}

function getbulan2($bulann2) {
 switch ((int)$bulann2) {
        case 1: return 'Jan';
        case 2: return 'Feb';
        case 3: return 'Mar';
        case 4: return 'Apr';
        case 5: return 'May';
        case 6: return 'Jun';
        case 7: return 'Jul';
        case 8: return 'Aug';
        case 9: return 'Sep';
        case 10: return 'Oct';
        case 11: return 'Nov';
        case 12: return 'Dec';
        default: return '-';
    }   
}


if (!function_exists('format_indo5')) {
    function format_indo5($date){
      date_default_timezone_set('Asia/Jakarta');
      // array hari dan bulan
      $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
      $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
      
      // pemisahan tahun, bulan, hari, dan waktu
      $tahun = substr($date,0,4);
      $bulan = substr($date,5,2);
      $tgl = substr($date,8,2);
      $waktu = substr($date,11,9);
      $hari = date("w",strtotime($date));
      $result = $tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." (".$waktu." WIB)";
  
      return $result;
    }
  }