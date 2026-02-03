<?php
if (user()->level =="admin"){
?>
<div class="row">
  <div class="col-lg-9">
    <div class="card"> 
      <div class="card-body">
          <form  enctype="multipart/form-data" class="form-horizontal" name="postform" id="inputForm" method="post" action="<?= base_url('admin/video-header/proses'); ?>">  
		      <input type='hidden' name='<?= $this->security->get_csrf_token_name(); ?>' value='<?= $this->security->get_csrf_hash(); ?>' id='token'>
		      <input type="hidden" name="action" value="edit-video"> 
          <input type="hidden" name="id" value="<?= aes_encrypt_id($video['id_video']) ?>">  
          <div class="row">
          <div class="col-lg-12">
          <div class="flash-data-gagal" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
          <?php if ($this->session->flashdata('flash')) : ?>
          <?php endif; ?>
            <div class="form-group" style="font-size:14px">
              <label for="judul">Judul Video</label>
              <input name="judul" style="font-size:14px" id="judul" class="form-control col-lg-10" placeholder="" value="<?= $video['judul_video'] ?>">
            </div>
            <div class="form-group" style="font-size:14px">
              <label for="m">Kata Sambutan</label>
               <textarea name="sambutan" class="form-control col-lg-10" rows=10><?= $video['sambutan'] ?></textarea>
            </div>   
            <div class="form-group" style="font-size:14px">
              <label for="m">Link Video</label>
              <input id="tanggal" style="font-size:14px" type="text" name="link" class="form-control col-lg-10" placeholder="Contoh: https://www.xxxx.com/assets/video/"  value="<?= $video['link_video'] ?>"></input> 
            </div> 
            <div class="form-group" style="font-size:14px">
              <label for="m">Nama File Video</label>
              <input id="tanggal" style="font-size:14px" type="text" name="nama" class="form-control col-lg-6"  value="<?= $video['nama_file'] ?>"></input> 
            </div>   
            <hr>
            <div class="form-group">
            <button type="submit" id="btn" style="font-size:13px" class="btn btn-primary" ><span id=waiting><i class="fa fa-save"></i> Simpan</span></button> 
			    <a href="<?= base_url('admin/video-header') ?>" style="font-size:13px" class="btn btn-danger"> <i class="fas fa-times fa-fw"></i>  
              Batal</a>
            </div> 
          </div> 
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
}else{
?>        
<span style="color:red">Maaf anda tidak memiliki akses !</span>
<?php
}
?>  
<script src="<?=base_url()?>assets/js/jquery-3.6.0.min.js"></script>   
<script>
$(document).on("submit", "#inputForm", function (e) {
	e.preventDefault();
	let csrfName = $("#token").attr("name");
	let csrfHash = $("#token").val();
	let url = $(this).attr("action");
	let formData = new FormData(this);
	formData.append(csrfName, csrfHash);
	$.ajax({
		url: url,
		type: "POST",
		data: formData,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function (res) {
			try {
				var json = JSON.parse(res);
				if (json.status === "session_expired") {
					return;
				}
			} catch (e) {}
			if (res.status === "success") {
				$("#waiting").html(
					'<img src="' +'<?=base_url()?>home/image/loading3.gif" width="20" height="20"> Mohon tunggu...'
				);
				$("#btn").prop("disabled", true);
                Swal({
                    text: res.message,  
                    position: "top-end",
                    type: 'success',
                    showConfirmButton: false, 
					timerProgressBar: true,
                    timer: 1800
                }); 
				setTimeout(function () {
					window.location.href = "<?=base_url()?>admin/video-header";
				}, 1900);
			} else if (res.status === "fatal") { 
                Swal({
                    text: res.message,  
                    position: "top-end",
                    type: 'error',
                    showConfirmButton: false, 
					timerProgressBar: true,
                    timer: 1800
                }); 
				setTimeout(function () {
					location.reload();
				}, 1900);
			} else {
                Swal({
                    text: res.message,  
                    position: "top-end",
                    type: 'error',
                    showConfirmButton: false, 
                    timer: 2200
                }); 
			}
			if (res.csrf && res.csrf.hash) {
				$("#token").val(res.csrf.hash);
			}
		},
		error: function (xhr) {
			if (xhr.status === 401 || xhr.status === 403) {
                Swal({
					title: "Session Habis",
					text: "Maaf sessi Anda telah habis.",
                    type: 'warning',
                    showConfirmButton: false, 
					timerProgressBar: true,
                    timer: 2200
                }).then(() => {
					location.reload();
				});
				return;
			}
             Swal({
					text: "HTTP " + xhr.status + " - Terjadi kesalahan pada Server",
				    title: "ERROR",
                    type: 'error',
                    showConfirmButton: false, 
					timerProgressBar: true,
                    timer: 1800
                }); 
			setTimeout(function () {
				location.reload();
			}, 1800);
		},
	});
}); 
</script>