<?php
if (user()->level =="admin"){
?>
<div class="row">
  <div class="col-lg-8">
    <div class="card"> 
      <div class="card-body">
          <form  enctype="multipart/form-data" class="form-horizontal" name="postform" id="inputForm" method="post" action="<?= base_url('admin/data-pengguna/proses'); ?>">  
		  <input type='hidden' name='<?= $this->security->get_csrf_token_name(); ?>' value='<?= $this->security->get_csrf_hash(); ?>' id='token'>
		  <input type="hidden" name="action" value="<?= $action ?>"> 
          <input type="hidden" name="id" value="<?= aes_encrypt_id($pengguna['id_user']) ?>">  
          <div class="row">
          <div class="col-lg-12">
          <div class="flash-data-gagal" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
          <?php if ($this->session->flashdata('flash')) : ?>
          <?php endif; ?> 
            <div class=row>
            <div class=col-lg-6>
            <div class="form-group" style="font-size:14px">
              <label for="judul">Username</label><br>
              <input name="username" style="font-size:14px" id="username" class="form-control" placeholder="" value="<?=$pengguna['username']?>">
            </div>
           </div> 
            <div class=col-lg-6>
            <div class="form-group" style="font-size:14px">
              <label for="m">Password</label><br>
              <input name="password" style="font-size:14px" id="password" class="form-control" placeholder="* Kosongkan jika tidak merubah password">
            </div>  
          </div>
          </div>
            <div class=row>
            <div class=col-lg-6>
            <div class="form-group" style="font-size:14px">
              <label for="judul">Nama Pengguna</label><br>
              <input name="nama_pengguna" style="font-size:14px" id="nama_pengguna" class="form-control" placeholder="" value="<?=$pengguna['nama_pengguna']?>">
            </div>
           </div> 
            <div class=col-lg-6>
            <div class="form-group" style="font-size:14px">
              <label for="m">Email Pengguna</label><br>
              <input name="email" style="font-size:14px" id="email" class="form-control" placeholder="" value="<?=$pengguna['email']?>">
            </div>  
          </div>
          </div>
            <div class="form-group" style="font-size:14px">
              <label for="author">Level Pengguna</label><br>
              <?php
              if($pengguna['level']=="admin"){
              ?>
              <input type="radio" name="level" id="level1" value="admin" checked /> admin &nbsp;&nbsp;&nbsp; 
              <input type="radio" name="level" id="level2" value="user" /> user 
              <?php
              }else if($pengguna['level']=="user"){
              ?>  
               <input type="radio" name="level" id="level1" value="admin" /> admin &nbsp;&nbsp;&nbsp; 
               <input type="radio" name="level" id="level2" value="user" checked /> user 
              <?php 
              }else {
              ?>  
                <input type="radio" name="level" id="level1" value="admin" /> admin &nbsp;&nbsp;&nbsp; 
                <input type="radio" name="level" id="level2" value="user" checked/> user 
                <?php 
              }
              ?>
            </div> 
            <hr>
            <div class="form-group">
            <button type="submit" id="btn" style="font-size:13px" class="btn btn-primary" ><span id=waiting><i class="fa fa-save"></i> Simpan</span></button> 
			<a href="<?= base_url('admin/data-pengguna') ?>" style="font-size:13px" class="btn btn-danger"> <i class="fas fa-times fa-fw"></i>  
              Batal</a>
            </div>  </div>
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
					window.location.href = "<?=base_url()?>admin/data-pengguna";
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