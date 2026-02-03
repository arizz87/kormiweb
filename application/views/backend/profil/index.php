<?php
if (user()->level =="admin"){
?>
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
<?php if ($this->session->flashdata('flash')) : ?>
<?php endif; ?> 
<div class="flash-data-gagal" data-flashdata="<?= $this->session->flashdata('flashx'); ?>"></div>
<?php if ($this->session->flashdata('flashx')) : ?>
<?php endif; ?> 
<?php $data=$this->db->query("select * from tbl_instansi")->row_array(); ?>
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header bg-primary" style=color:white>Profil Data Instansi</div>
            <div class="card-body">
            <form  enctype="multipart/form-data" class="form-horizontal" name="postform" id="inputForm" method="post" action="<?= base_url('admin/profil/proses'); ?>">  
            <input type='hidden' name='<?= $this->security->get_csrf_token_name(); ?>' value='<?= $this->security->get_csrf_hash(); ?>' id='token'>
            <input type="hidden" name="action" value="update-profil">
            <input type="hidden" name="idinstansi" value="<?= encrypt_data($data['id_instansi']) ?>" id="idinstansi" class="form-control"> 
                <div class="form-group">
                    <label for="">Nama Lembaga/ Instansi</label>
                    <input type="" name="nama_lembaga" value="<?= $data['nama_lembaga'] ?>" id="nama_lembaga" class="form-control">
                </div> 
                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea name="alamat" class="form-control"><?= $data['alamat'] ?></textarea> 
                </div> 
                <div class="row">
                <div class="form-group col-sm-4">
                    <label for="">No Telepon</label>
                    <input type="" name="notelp" value="<?= $data['no_telpon'] ?>" id="notelp" class="form-control">
                </div>
                <div class="form-group col-sm-8">
                    <label for="">Alamat Email</label>
                    <input type="" name="email" value="<?= $data['email'] ?>" id="email" class="form-control">
                </div>
                </div>
                <div class="row">
                <div class="form-group col-sm-4">
                    <label for="">Facebook</label>
                    <input type="" name="facebook" value="<?= $data['facebook'] ?>" id="facebook" class="form-control">
                </div>
                <div class="form-group col-sm-4">
                    <label for="">Instragram</label>
                    <input type="" name="instragram" value="<?= $data['instragram'] ?>" id="instragram" class="form-control">
                </div>
                <div class="form-group col-sm-4">
                    <label for="">No Whatsapp</label>
                    <input type="" name="no_wa" value="<?= $data['no_wa'] ?>" id="no_wa" class="form-control">
                </div>
                </div><hr>
                <div class="row bg-light">
                <div class="form-group col-sm-6">
                    <label for=""><b>Prolog</b></label>
                    <textarea name="prolog" class="form-control" rows=10><?= $data['prolog'] ?></textarea> 
                </div>
                <div class="form-group col-sm-6">
                    <label for=""><b>Sejarah</b></label>
                    <textarea name="sejarah" class="form-control" rows=10><?= $data['sejarah'] ?></textarea> 
                </div>
                </div>
                <hr>
                <div class="form-group" align=right> 
                <button type="submit" class="btn btn-primary btn-sm"><span id=waiting><i class="fas fa-save fa-fw"></i>  Update Profil</button>
                </div>
            </form>
            </div>
        </div> 
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header bg-primary" style=color:white>Photo Kepala Instansi</div>
            <div class="card-body"> 
            <form  enctype="multipart/form-data" class="form-horizontal" name="postform" id="inputForm" method="post" action="<?= base_url('admin/profil/proses'); ?>">  
            <input type='hidden' name='<?= $this->security->get_csrf_token_name(); ?>' value='<?= $this->security->get_csrf_hash(); ?>' id='token'>
            <input type="hidden" name="action" value="update-photo">
            <input type="hidden" name="idpoto" value="<?= encrypt_data($data['id_instansi']) ?>" id="idpoto" class="form-control">  
            <input type="hidden" name="old" value="<?= $data['pimpinan_img'] ?>" id="old" class="form-control">     
            <div class="form-group"> 
            <?php
            if(!empty($data['pimpinan_img'])){
            ?>
             <img src="<?= base_url() ?>home/image/<?= $data['pimpinan_img'] ?>" class="img-thumbnail img-preview"  width="400" height="800"> <p><p>
            <?php
            }else{
            ?>
            <img src="<?= base_url() ?>home/image/noimage.jpeg" class="img-thumbnail img-preview"  width="300" height="200"> <p><p>
           <?php 
            }
            ?>  
            <div class="form-group">  
                            <div class="custom-file col-sm-10">
                                <input type="file" class="custom-file-input" id="image" name="file1x" onchange="previewGmb()">
                                <label class="custom-file-label" for="sampul">Pilih Gambar Pengganti</label><p>
                <font style=color:red;font-size:12px>* Format gambar <b>jpg, jpeg, gif, png</b> (maks 2MB)</font>
                                <?= form_error('sampul', '<small class="text-danger">', '</small>'); ?>
                            </div> 
            </div> <hr>
                <div class="form-group" align=right> 
                <button type="submit" class="btn btn-primary btn-sm"><span id=waiting2><i class="fas fa-save fa-fw"></i>  Update Photo</button>
                </div> </form> 
            </div>
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
					window.location.href = "<?=base_url()?>admin/profil";
				}, 1900);
			}else if (res.status === "success2") { 
				$("#waiting2").html(
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
					window.location.href = "<?=base_url()?>admin/profil";
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