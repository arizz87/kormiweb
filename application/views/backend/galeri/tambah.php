<div class="row">
  <div class="col-lg">
    <div class="card"> 
      <div class="card-body">
          <form  enctype="multipart/form-data" class="form-horizontal" name="postform" id="inputForm" method="post" action="<?= base_url('admin/galeri/proses'); ?>">  
		  <input type='hidden' name='<?= $this->security->get_csrf_token_name(); ?>' value='<?= $this->security->get_csrf_hash(); ?>' id='token'>
		  <input type="hidden" name="action" value="<?= $action ?>">   
          <div class="row">
          <div class="col-lg-4">
          <div class="flash-data-gagal" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
          <?php if ($this->session->flashdata('flash')) : ?>
          <?php endif; ?>  
            <div class="form-group" style="font-size:14px">
              <label for="judul">Judul Berita</label>
              <input name="judul" style="font-size:14px" id="judul" class="form-control" placeholder="">
            </div>
            <div class="form-group" style="font-size:14px">
              <label for="m">Tanggal Galeri</label>
              <input id="tanggal" style="font-size:14px" type="date" name="tanggal" class="form-control col-lg-8"></input> 
            </div> 
            <div class="form-group" style="font-size:14px">
              <label for="author">Pembuat / Author</label>
              <input readonly="" style="font-size:14px" name="author" value="<?= user()->nama_pengguna ?>" id="author" class="form-control col-lg-8" placeholder="Penulis"></input> 
            </div> 
            <div class="form-group" style="font-size:14px">
              <label for="author">Tampil di Web</label><br>
              <input type="radio" name="posting" id="posting1" value="Ya" /> Ya &nbsp;&nbsp;&nbsp; 
              <input type="radio" name="posting" id="posting2" value="Tidak" checked /> Tidak 
            </div>
            <hr>
            <div class="form-group">
            <button type="submit" id="btn" style="font-size:13px" class="btn btn-primary" ><span id=waiting><i class="fa fa-save"></i> Simpan</span></button> 
			      <a href="<?= base_url('admin/galeri') ?>" style="font-size:13px" class="btn btn-danger"> <i class="fas fa-times fa-fw"></i>  
              Batal</a>
            </div> 
          </div>
          <div class="col-lg-4"> 
            <div class="form-group" style="font-size:14px">
            <label for="sampul_preview" class="col-form-label">Gambar Preview</label><br>
            <img src="<?= base_url('home/'); ?>image/default.jpg" class="img-thumbnail img-preview" width="300" height="200">
            </div>   
            <div class="form-group" style="font-size:14px">  
              <div class="custom-file">
              <input type="file" class="custom-file-input" id="image" name="file1x" onchange="previewGmb()">
              <label class="custom-file-label" for="sampul">Pilih Gambar</label><p>
              <font style=color:red;font-size:12px>* Format gambar <b>jpg, jpeg, png </b>(maks 2MB)
              </font>
              <?= form_error('sampul', '<small class="text-danger">', '</small>'); ?>
              </div> 
            </div>  
          </div>  
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
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
					window.location.href = "<?=base_url()?>admin/galeri";
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