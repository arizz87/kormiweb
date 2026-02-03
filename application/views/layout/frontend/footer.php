   <?php
   $cek=$this->db->query("SELECT * FROM tbl_instansi")->row_array();
   ?>
   <footer id="footer" class="footer dark-background">
      <div class="container footer-top">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6 footer-about">
            <a href="index.html" class="logo d-flex align-items-center">
              <span class="sitename"><?=$cek['nama_lembaga']?></span>
            </a>
            <div class="footer-contact pt-3">
              <p><?=nl2br($cek['alamat'])?></p> 
            </div> 
          </div>

          <div class="col-lg-3 col-md-3 footer-links">
            <h4>Kontak Kami</h4>
			<ul>
      <?php
      if ($cek['no_telpon']=="0"){
      $no_telpon="";
      }else{
      $no_telpon="<li><a><i class='bi bi-telephone' aria-hidden='true'></i> ".$cek['no_telpon']."</a></li>";
      } 
      if ($cek['email']=="0" or $cek['email']=="-"){
      $email="";
      }else{
      $email="<li><a><i class='bi bi-envelope' aria-hidden='true'></i> ".$cek['email']."</a></li>";
      } 
      if ($cek['facebook']=="0"){
      $facebook="";
      }else{
      $facebook="<li><a><i class='bi bi-facebook' aria-hidden='true'></i> ".$cek['facebook']."</a></li>";
      }
      if ($cek['instragram']=="0"){
      $instragram="";
      }else{
      $instragram="<li><a><i class='bi bi-instagram' aria-hidden='true'></i> ".$cek['instragram']."</a></li>";
      }
      if ($cek['no_wa']=="0"){
      $no_wa="";
      }else{
      $no_wa="<li><a><i class='bi bi-whatsapp' aria-hidden='true'></i> ".$cek['no_wa']."</a></li>";
      }
      ?>
			<?=$no_telpon?>
      <?=$email?> 
      <?=$facebook?> 
      <?=$instragram?>  
      <?=$no_wa?>   
			</ul> 
          </div>
 

          <div class="col-lg-4 col-md-12 footer-newsletter" style=text-align:justify>
            <h4>Website KORMI</h4>
            <p>
            Website <a href="https://kormibrebeskab.org"><b>kormibrebeskab.org</b></a> adalah milik KORMI Kabupaten Brebes, sebuah platform yang menyediakan panduan dan informasi untuk kegiatan olahraga, solidaritas sosial, dan kreativitas untuk masyarakat.
            </p> 
          </div>
        </div>
      </div>

      <div class="container copyright text-center mt-4">
        <p>
          © <span>Copyright</span> 2026 | <strong class="px-1 sitename">KORMI Kabupaten Brebes</strong> 
        </p> 
      </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?=base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/php-email-form/validate.js"></script>
    <script src="<?=base_url()?>assets/vendor/aos/aos.js"></script>
    <script src="<?=base_url()?>assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?=base_url()?>assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>  
    <script src="<?=base_url()?>assets/js/main.js"></script> 
    <script>
</script>

  </body>
</html>