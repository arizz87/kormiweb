<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
<?php $data=$this->db->query("select * from tbl_instansi")->row_array(); ?>
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('') ?>" target=blank>
        <div class="sidebar-brand-icon">
        <img style="width:20%;" class="size-medium img-responsive" src="<?= base_url() ?>home/image-logo/logo-kormi2.png" alt="xxx"> <?=$data['nama_lembaga']?>
        </div> 
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <?php
    if ($_SESSION['level'] =="admin"){
    ?> 
    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $this->uri->segment(2) == 'dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li> 
    <!-- Nav Item - Tables -->
    <li class="nav-item <?= $this->uri->segment(2) == 'berita' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/berita') ?>">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Berita/Artikel</span></a>
    </li>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $this->uri->segment(2) == 'galeri' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/galeri') ?>">
            <i class="fas fa-fw fa-camera"></i>
            <span>Galeri Photo</span></a>
    </li>
    <!-- Nav Item - Tables -->
    <li class="nav-item <?= $this->uri->segment(2) == 'video' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/video') ?>">
            <i class="fas fa-fw fa-play"></i>
            <span>Galeri Video</span></a>
    </li>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $this->uri->segment(2) == 'agenda' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/agenda') ?>">
            <i class="fas fa-fw fa-calendar-check"></i>
            <span>Agenda/Event</span></a>
    </li> 
    <!-- Nav Item - Tables -->
    <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo2"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Tools Setting</span>
        </a>
        <?php
        if (($this->uri->segment(2) == 'profil') or ($this->uri->segment(2) == 'video-header') or ($this->uri->segment(2) == 'daftar-pertanyaan') or ($this->uri->segment(2) == 'data-pengguna')){
        $show="show" ;   
        }else{
        $show="" ;
        }
        
        ?>
        <div id="collapseTwo2" class="collapse <?=$show?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= $this->uri->segment(2) == 'profil' ? 'active' : '' ?>" href="<?= base_url('admin/profil') ?>">Profil Lembaga</a>
                <a class="collapse-item <?= $this->uri->segment(2) == 'video-header' ? 'active' : '' ?>" href="<?= base_url('admin/video-header') ?>">Video Header Web</a>
                <a class="collapse-item <?= $this->uri->segment(2) == 'daftar-pertanyaan' ? 'active' : '' ?>" href="<?= base_url('admin/daftar-pertanyaan') ?>">Daftar Pertanyaan</a>
                <a class="collapse-item <?= $this->uri->segment(2) == 'data-pengguna' ? 'active' : '' ?>" href="<?= base_url('admin/data-pengguna') ?>">Data Pengguna</a>
            </div>
        </div> 
    </li>  
    <li class="nav-item <?= $this->uri->segment(2) == 'update-password' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/update-password') ?>">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Update Password</span></a>
    </li> 
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-power-off"></i>
            <span>Logout</span></a>
    </li>
    <?php
    }else{
    ?> 
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $this->uri->segment(2) == 'dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>   
    <!-- Nav Item - Tables -->
    <li class="nav-item <?= $this->uri->segment(2) == 'berita' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/berita') ?>">
            <i class="fas fa-fw fa-desktop"></i>
            <span>Berita/ Informasi</span></a>
    </li>  
    <!-- Nav Item - Tables -->
    <li class="nav-item <?= $this->uri->segment(2) == 'galeri' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/galeri') ?>">
            <i class="fas fa-fw fa-images"></i>
            <span>Galeri Photo</span></a>
    </li> 
    <!-- Nav Item - Tables -->
    <li class="nav-item <?= $this->uri->segment(2) == 'video' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/video') ?>">
            <i class="fas fa-fw fa-play"></i>
            <span>Galeri Video</span></a>
    </li> 
    <li class="nav-item <?= $this->uri->segment(2) == 'update_password' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/update_password') ?>">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Ubah Password</span></a>
    </li>
    <?php
    }
    ?>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>