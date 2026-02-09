<html>
	<head>
		 <title>Admin Web KORMI Brebes</title> 
        <link href="<?=base_url()?>home/image-logo/kormi-icon.png" rel="icon" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
		<link rel="stylesheet" href="<?=base_url()?>assets/login-template/css/menu.css"/>
		<link rel="stylesheet" href="<?=base_url()?>assets/login-template/css/main.css"/>
		<link rel="stylesheet" href="<?=base_url()?>assets/login-template/css/bgimg.css"/>
		<link rel="stylesheet" href="<?=base_url()?>assets/login-template/css/font.css"/>
		<link rel="stylesheet" href="<?=base_url()?>assets/login-template/css/font-awesome.min.css"/> 
    <script type="text/javascript" src="<?=base_url()?>assets/login-template/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/login-template/js/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/login-template/plugins/sweetalert2/sweetalert2.min.css"> 
    <script src="<?=base_url()?>assets/login-template/plugins/sweetalert2/sweetalert2.min.js"></script>   
    <script>
        function passwordShowUnshow() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>  
  <style> 
  .inputbox {
    position: relative;
    border: 1px solid #D3D3D3;
    background-color: #fff;
    vertical-align: middle;
    display: inline-block;
    overflow: hidden;
    white-space: nowrap;
    margin: 0;
    padding: 0;
    -moz-border-radius: 5px 5px 5px 5px;
    -webkit-border-radius: 5px 5px 5px 5px;
    border-radius: 5px 5px 5px 5px;
    padding: 1px 6px 2px;
    
  }

  .inputbox:focus{
    -moz-box-shadow: 0 0 3px 0 #D3D3D3;
    -webkit-box-shadow: 0 0 3px 0 #D3D3D3;
    box-shadow: 0 0 3px 0 #D3D3D3;
  }

  .combobox {
      border: 1px solid #DCDCDC;
      font-weight: normal;
      height: 22px;
    padding: 1px 3px 2px;
      z-index: 1000;
    -moz-border-radius: 4px 4px 4px 4px;
      -webkit-border-radius: 4px 4px 4px 4px;
      border-radius: 4px 4px 4px 4px;
  }

  .combobox:focus{
    -moz-box-shadow: 0 0 3px 0 #D3D3D3;
    -webkit-box-shadow: 0 0 3px 0 #D3D3D3;
    box-shadow: 0 0 3px 0 #D3D3D3;
  }

  .inputboxnonaktif {
      border: 1px solid #999999;
    background-color:#E2E2D3;
      font-weight: normal;
      height: 22px;
    padding: 1px 5px 2px;
      z-index: 1000;
    text-transform:uppercase;
    -moz-border-radius: 4px 4px 4px 4px;
      -webkit-border-radius: 4px 4px 4px 4px;
      border-radius: 4px 4px 4px 4px;
  }
  .tombol{
    background:#006666;
    color:white;
    border-top:0;
    border-left:0;
    border-right:0;
    border-bottom:5px solid #ffff;
    padding:10px 20px;
    text-decoration:none;
    font-family:sans-serif;
    font-size:10pt;
  }
  .alert-danger {
    color: #78261f;
    background-color: #fadbd8;
    border-color: #f8ccc8;
  }
  .alert {
    position: relative;
    padding: 0.75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: 0.35rem;
  }
</style> 
</head>
<body> 
<div class="background"></div>
	<div class="backdrop"></div> 
	<div class="login-form-container" id="login-form">
	<div  class="animate__animated animate__rubberBand animate__repeat-2">
		<div class="login-form-content">
			<div class="login-form-header">
				<div class="logo">
					<img src="<?=base_url()?>home/image-logo/logo-kormi2.png" width=140 height=120 /></h1>
				</div>
				<div style="color:#077032; font-size:22px; font-weight:600">ADMIN KORMI BREBES</div>  
			</div>   
      <?php if($this->session->flashdata('error')) : ?>
      <p> <div class="alert alert-danger" style=font-size:13px><i class="fa fa-times-circle"></i> <?= $this->session->flashdata('error'); ?></div>
      <?php endif; ?> 
			<form method="post" id='loginForm' class="login-form" enctype="multipart/form-data" >
        <input type='hidden' name='<?= $this->security->get_csrf_token_name(); ?>' value='<?= $this->security->get_csrf_hash(); ?>' id='token'>
				<div class="input-container">
					<i class="fa fa-user"></i>
					<input type="text" class="input" id="username" name="username" placeholder="Username"/>
				</div>
				<div class="input-container">
					<i class="fa fa-lock"></i>
					<input type="password" class="input" id="password" name="password" placeholder="Password"/> 
				</div>  
				<div class="rememberme-container" style=font-size:13px> 
				 <input type="checkbox" onclick="passwordShowUnshow()"> <i class="fa fa-eye"></i> Lihat Password
				</div> 
				<button type="submit" id="btn" name="login" class="button"><span id=waiting><i class="fa fa-sign-in"></i> Login</span> </button> 
			</form> 
		</div></div>
	</div> 
<script>
var words = ['"Melayani Dapodik dengan ETIKA"','"Efektif, Transparan, Ikhlas, Komitmen, Amanah"'],
    part,
    i = 0,
    offset = 0,
    len = words.length,
    forwards = true,
    skip_count = 0,
    skip_delay = 60,
    speed = 60;
var wordflick = function () {
  setInterval(function () {
    if (forwards) {
      if (offset >= words[i].length) {
        ++skip_count;
        if (skip_count == skip_delay) {
          forwards = false;
          skip_count = 0;
        }
      }
    }
    else {
      if (offset == 0) {
        forwards = true;
        i++;
        offset = 0;
        if (i >= len) {
          i = 0;
        }
      }
    }
    part = words[i].substr(0, offset);
    if (skip_count == 0) {
      if (forwards) {
        offset++;
      }
      else {
        offset--;
      }
    }
    $('.word').text(part);
  },speed);
};

$(document).ready(function () {
  wordflick();
});
</script>
<script>
$('#loginForm').on('submit',function(e){
	e.preventDefault();
  
	var data=$(this).serialize();
	$.ajax({
  url:'<?= site_url('login/proses_login') ?>',
	method:'POST',
  data:data,
  dataType:'json',
	success:function(res){
		if(res.status==='success'){
        $('#waiting').html('<img src="' +'<?=base_url()?>home/image/loading3.gif" width="20" height="20"> Mohon tunggu...'); 
        $('#btn').prop('disabled', true);
				Swal.fire({
			    text: res.message,
					icon: "success", 
          title:'Login berhasil',
					showConfirmButton: false,
					timer: 1800,
          timerProgressBar: true
				});
				setTimeout(function () {
					  window.location.href='<?= site_url('admin/dashboard') ?>';
				}, 1900);
       
		}else{
      Swal.fire({
			text: res.message,
			icon: "error", 
      title:'Login gagal',
			showConfirmButton: false,
			timer: 2200,
		  }); 
		}
		if(res.csrf && res.csrf.hash) 
      $('#token').val(res.csrf.hash);
		},error:function(xhr){ 
				Swal.fire({
			   	text: 'HTTP '+xhr.status+' - Token tidak valid',
				icon: "error",
          		title:'ERROR',
				showConfirmButton: false,
				timer: 1800,
				});
				// setTimeout(function () {
				// 	  location.reload();
				// }, 1900); 
		}
		}
		);
		});
</script>
<script src="<?=base_url()?>assets/login-template/plugins/sweetalert2/myscript.js"></script>  	 
</body>
</html>