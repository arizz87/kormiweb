function numbersonly(myfield, e, dec)
{
var key;
var keychar;
if (window.event)
 key = window.event.keyCode;
else if (e)
 key = e.which;
else
 return true;
keychar = String.fromCharCode(key);
// control keys
if ((key==null) || (key==0) || (key==8) || 
 (key==9) || (key==13) || (key==27) )
 return true;
// numbers
else if ((("0123456789:.").indexOf(keychar) > -1))
 return true;
// decimal point jump
else if (dec && (keychar == "."))
 {
 myfield.form.elements[dec].focus();
 return false;
 }
else
 return false;
}
function specialonly(myfield, e, dec)
{
var key;
var keychar;
if (window.event)
 key = window.event.keyCode;
else if (e)
 key = e.which;
else
 return true;
keychar = String.fromCharCode(key);
// control keys
if ((key==null) || (key==0) || (key==8) || 
 (key==9) || (key==13) || (key==27) )
 return true;
// numbers
else if ((("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-`&()/ ").indexOf(keychar) > -1))
 return true;
// decimal point jump
else if (dec && (keychar == "."))
 {
 myfield.form.elements[dec].focus();
 return false;
 }
else
 return false;
}
function togglex() {
   var elemen=document.getElementById('idalasan');
  if (parseInt(document.fm.alasan.value) != 0) {
    elemen.style.display='';
	fm.idalasan.focus();
  } else {
    elemen.style.display='none';
	document.getElementById('idalasan').value=''
  }
  var elemen=document.getElementById('isi');
  if (parseInt(document.fm.alasan.value) == 2) {
    elemen.style.display='';
  } else {
    elemen.style.display='none';
	document.getElementById('isi').value=''
  }
  var elemen=document.getElementById('upload');
  if (parseInt(document.fm.alasan.value) == 3) {
    elemen.style.display='none';
  } else {
    elemen.style.display='';
  }
  var elemen=document.getElementById('fupload');
  if (parseInt(document.fm.alasan.value) == 3) {
    elemen.style.display='none';
  } else {
    elemen.style.display='';
  }
}
function togglexedit() {
   var elemen=document.getElementById('idalasanedit');
  if (parseInt(document.fmrevisi.alasanedit.value) == 0) {
    elemen.style.display='none';
	document.getElementById('dlg2').style.height='auto'
	fmrevisi.idalasanedit.focus();
  } else {
    elemen.style.display='none';
	document.getElementById('idalasanedit').value=''
	document.getElementById('fuploadedit').value=''
  }
  var elemen=document.getElementById('isiedit');
  if (parseInt(document.fmrevisi.alasanedit.value) == 2) {
    elemen.style.display='';
	document.getElementById('idalasanedit').style.display='';
	document.getElementById('dlg2').style.height='auto'
	fmrevisi.idalasanedit.focus();
  } else {
    elemen.style.display='none';
	document.getElementById('isiedit').value=''
  }
  var elemen=document.getElementById('uploadedit');
  if (parseInt(document.fmrevisi.alasanedit.value) == 3) {
    elemen.style.display='none';
  } else {
    elemen.style.display='';
  }
  var elemen=document.getElementById('fuploadedit');
  if (parseInt(document.fmrevisi.alasanedit.value) == 3) {
    elemen.style.display='none';
	document.getElementById('idalasanedit').style.display='';
	document.getElementById('dlg2').style.height='auto'
	fmrevisi.idalasanedit.focus();
  } else {
    elemen.style.display='';
  }
}
function togglexeditx() {
   var elemen=document.getElementById('idalasaneditx');
  if (parseInt(document.fmedit.alasaneditx.value) == 1) {
    elemen.style.display='';
	fmedit.idalasaneditx.focus();
	document.getElementById('isieditx').style.display='none';
	document.getElementById('file1').style.display='';
	document.getElementById('file2').style.display='';
	document.getElementById('file3').style.display='';
  }
  else if (parseInt(document.fmedit.alasaneditx.value) == 2) {
    elemen.style.display='';
	fmedit.idalasaneditx.focus();
	document.getElementById('isieditx').style.display='';
	document.getElementById('file1').style.display='';
	document.getElementById('file2').style.display='';
	document.getElementById('file3').style.display='';
  } 
  else if (parseInt(document.fmedit.alasaneditx.value) == 3) {
    elemen.style.display='';
	fmedit.idalasaneditx.focus();
	document.getElementById('isieditx').style.display='none';
	document.getElementById('file1').style.display='none';
	document.getElementById('file2').style.display='none';
	document.getElementById('file3').style.display='none';
  } else {
    elemen.style.display='none';
	document.getElementById('isieditx').style.display='none';
}}
function toggle2() {
   var elemen=document.getElementById('catatan');
  if (document.getElementById('status').value == 2) {
	   elemen.style.display='';
	   elemen.focus();
  }else{
	elemen.style.display='none';
	document.getElementById('file1').style.display='';
	document.getElementById('file2').style.display='';
	document.getElementById('file3').style.display='';
  }

}
function jml()
{
var jumlah=(parseFloat(document.fm.total_tarik.value) / parseFloat(document.fm.total_produksi.value))*100
document.fm.efektif.value= jumlah.toFixed(2);
document.fm.efektif2.value= jumlah.toFixed(2);

}
function jmledit()
{
var jumlah=(parseFloat(document.fmedit.total_tarik.value) / parseFloat(document.fmedit.total_produksi.value))*100
document.fmedit.efektif.value= jumlah.toFixed(2);
document.fmedit.efektif2.value= jumlah.toFixed(2);

}
