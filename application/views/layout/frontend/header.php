<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>KORMI Kabupaten Brebes</title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>

    <!-- Favicons -->
    <link href="<?=base_url()?>home/image-logo/kormi-icon.png" rel="icon" />  
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
	  <!-- Vendor CSS Files -->
    <link href="<?=base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?=base_url()?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"/>
    <link href="<?=base_url()?>assets/vendor/aos/aos.css" rel="stylesheet"/>
    <link href="<?=base_url()?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet"/>
    <link href="<?=base_url()?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet"/> 
    <!-- Main CSS File -->
    <link href="<?=base_url()?>assets/css/main.css" rel="stylesheet"/>    
    </head>

  <body class="index-page">
    <header id="header" class="header d-flex align-items-center fixed-top">
      <div class="container-fluid container-xl position-relative d-flex align-items-center">
        <a href="<?=base_url()?>" class="logo d-flex align-items-center me-auto"> 
          <img src="<?=base_url()?>home/image-logo/logo-kormi2.png" alt=""/>
          <h1 class="sitename">KORMI <span style=color:#f4944c>BREBES</span></h1>
        </a> 
        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="<?=base_url()?>" class="active">Beranda</a></li>
            <li class="dropdown">
              <a href="#"
                ><span>Tentang Kami</span>
                <i class="bi bi-chevron-down toggle-dropdown"></i
              ></a>
              <ul>
                <li><a href="<?=base_url()?>#about">Profil</a></li>
                <li><a href="#">Visi dan Misi</a></li>
                <li><a href="#">Struktur Organisasi</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#"
                ><span>Event Olahraga</span>
                <i class="bi bi-chevron-down toggle-dropdown"></i
              ></a>
              <ul>
                <li><a href="#">FORNAS</a></li>
                <li><a href="#">FORPROV</a></li>
                <li><a href="#">FORKAB/FORKOT</a></li>
                <li><a href="#">Umum</a></li>
              </ul>
            </li>
            <li><a href="<?=base_url()?>#berita">Berita</a></li>
            <li><a href="<?=base_url()?>#galeri">Galeri</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </header>
    