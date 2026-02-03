 
      <!-- Hero Section -->
      <section id="hero" class="hero section dark-background">
        <video autoplay muted loop playsinline class="hero-bg-video" data-aos="fade-in">
          <source src="<?=$video_header['link_video']?><?=$video_header['nama_file']?>" type="video/mp4"/>
        </video> 
        <div class="container d-flex flex-column align-items-center">
          <h2 data-aos="fade-up" data-aos-delay="100">
           <?=$video_header['judul_video']?>
          </h2>
          <center>
            <p data-aos="fade-up" data-aos-delay="200">
            <?=$video_header['sambutan']?>
            </p>
          </center>
          <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
            <a href="#about" class="btn btn-danger px-4 py-2"">Ayo Mulai ...</a>
          </div>
        </div>
      </section>
      <!-- /Hero Section -->

      <!-- About Section -->
      <section id="about" class="about section">
        <p></p>
        <div class="container">
          <div class="row gy-4">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
              <img
                src="<?=base_url()?>home/image/<?=$profils['pimpinan_img']?>"
                class="img-fluid rounded-4 mb-4 img-proporsional"
                alt=""
              />
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250" style="text-align:justify">
              <div class="content ps-0 ps-lg-5">
                <h1><strong>PROLOG</strong></h1>
                <?=$profils['prolog']?>
              </div>
              <p></p>
              <div class="content ps-0 ps-lg-5">
                <h1><strong>SEJARAH</strong></h1>
                <?=$profils['sejarah']?>
              </div>
            </div>
          </div>
        </div>
      </section> 

      <!-- Services Section -->
      <section id="berita" class="services section">
        <!-- Section Title --> 
        <div class="container section-title" data-aos="fade-up">
          <h2>Berita</h2>
          <p>Berita Terkini<br /></p>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row gy-5">  
        <?php  
        if (isset($new_blogs) && !empty($new_blogs)): ?>
        <?php foreach ($new_blogs as $blog): ?> 
            <div class="col-xl-4 col-md-6 service-card" data-aos="zoom-in" data-aos-delay="400">
              <div class="service-item">
                <div class="img">
                  <img src="<?=base_url()?>home/image/<?=$blog['blog_img']?>" class="img-fluid" alt=""/>
                </div>
                <div class="details position-relative">  
				  <p style=color:green;font-size:13px><i class="bi bi-calendar-check"></i> Posting <?=format_indo($blog['blog_tgl'])?></p>
                  <a href="<?=base_url()?>berita/detail/<?=$blog['blog_slug']?>" class="stretched-link">
                    <h6><b><?= substr($blog['blog_title'], 0); ?></b></h6>					
					<button style=font-size:14px class="btn btn-success px-3 py-2">
					  Baca Selengkapnya
					</button> 
                  </a> 
                </div>
              </div>
            </div>  
        <?php endforeach; ?>
        <?php else: ?>
       	<span class="fw-bolder text-muted fs-6">
		Belum ada data.
		</span>
        <?php endif; ?>    
          </div>
        </div>
		<div class="row" data-aos="fade-up">
        <div class="col-12">
            <nav id="paginationWrapper">
            <ul class="pagination justify-content-center mt-4" id="pagination"></ul>
            </nav>
            <div class="text-center mt-4">
            <button id="toggleButton" style=font-size:14px class="btn btn-danger px-3 py-2">
            Berita Selengkapnya
            </button>
        </div>
        </div>
        </div>
      </section>  
      <!-- Services 2 Section -->
      <section id="galeri" class="services-2 about section light-background"> 
      <div class="container"> 
					<div class="row gy-4"> 
					<div class="accordion col-md-7" id="faqAccordion" data-aos="fade-up">  
					<div class="service-item d-flex position-relative h-100"> 
					<div class="fs-3"><i class="bi bi-question-circle-fill" style=color:red></i><b> Pertanyaan yang Sering Diajukan</b></div><hr>
          <?php
          $daftar = $this->db->query("SELECT * FROM tbl_pertanyaan WHERE tampil = 'Ya'")->result_array();
          ?> 
          <div class="accordion" id="faqAccordion">
          <?php if (!empty($daftar)) : ?>
              <?php foreach ($daftar as $row) : 
                  $heading = 'heading_' . $row['id_pertanyaan'];
                  $collapse = 'collapse_' . $row['id_pertanyaan'];
              ?>
          <div class="accordion-item border-0 border-bottom py-3">
          <h2 class="accordion-header" id="<?= $heading ?>">
            <button class="accordion-button collapsed bg-white px-3 py-3 fw-semibold"
                type="button"data-bs-toggle="collapse" data-bs-target="#<?= $collapse ?>"aria-expanded="false" aria-controls="<?= $collapse ?>" style="box-shadow:none;">
                <span class="fw-bolder accent-color fs-6"><?= htmlspecialchars($row['pertanyaan']) ?></span>
            </button>
          </h2> 
          <div id="<?= $collapse ?>" class="accordion-collapse collapse" aria-labelledby="<?= $heading ?>" data-bs-parent="#faqAccordion">
            <div class="accordion-body px-4 py-3 fw-medium accent-color-3 fs-6"
                 style="border-left:4px solid #dc3545;background:#F6F6F6;text-align:justify">
                <?= $row['jawaban'] ?>
            </div>
          </div>
          </div>
          <?php endforeach; ?> 
          <?php else : ?>
          <div class="accordion-item border-0 py-3">
          <h2 class="accordion-header">
            <button class="accordion-button bg-white px-3 py-3 fw-semibold" disabled>
                <span class="fw-bolder text-muted fs-6">
                    Belum ada data.
                </span>
            </button>
          </h2>
          </div>
          <?php endif; ?>
          </div>    
          </div>
          </div>
					<div class="col-md-5" data-aos="fade-up" data-aos-delay="100">
					<div class="service-item d-flex position-relative h-100"> 
					<div class="swiper init-swiper">
					<div class="fs-3"><i class="bi bi-caret-right-square-fill" style=color:red></i><b> Video Kegiatan</b></div><br>
					<div class="bd-example">
            <?php if (!empty($videos)) : ?>
            <div id="carouselVideo" class="carousel slide" data-bs-ride="carousel"> 
                <!-- INDICATORS -->
                <div class="carousel-indicators">
                    <?php foreach ($videos as $i => $video) : ?>
                        <button type="button"
                            data-bs-target="#carouselVideo"
                            data-bs-slide-to="<?= $i ?>"
                            class="<?= $i === 0 ? 'active' : '' ?>"
                            <?= $i === 0 ? 'aria-current="true"' : '' ?>
                            aria-label="Slide <?= $i + 1 ?>">
                        </button>
                    <?php endforeach; ?>
                </div> 
                <!-- SLIDES -->
                <div class="carousel-inner">
                    <?php foreach ($videos as $i => $video) : ?>
                    <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>"> 
                        <img
                            src="<?= base_url('home/image/'.$video['video_img']) ?>"
                            class="img-fluid rounded-4"
                            alt="<?= htmlspecialchars($video['judul_video']) ?>"> 
                        <a href="<?= $video['link_video'] ?><?= $video['nama_file'] ?>"
                          class="glightbox pulsating-play-btn"></a> 
                        <div class="carousel-caption d-none d-md-block">
                            <center><b><?= htmlspecialchars($video['judul_video']) ?></b></center>
                        </div> 
                    </div>
                    <?php endforeach; ?>
                </div> 
                <!-- CONTROLS -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselVideo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button> 
                <button class="carousel-control-next" type="button" data-bs-target="#carouselVideo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button> 
					</div> 
                
				  <?php else : ?>
				  <div class="accordion-item border-0 py-3">
				  <h2 class="accordion-header">
					<button class="accordion-button bg-white px-3 py-3 fw-semibold" disabled>
						<span class="fw-bolder text-muted fs-6">
							Belum ada data.
						</span>
					</button>
				  </h2>
				  </div>
                <?php endif; ?>
				</div>  
            </div> 
            </div>
            </div> 
        </div> 
		<p><br> 
		
      <div class=" service-item portfolio">
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
         <div class="fs-3"><i class="bi bi-camera-fill" style=color:red></i><b> Galeri Kegiatan</b></div><br> 
          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200"> 
            
        <?php  
        $no=0;
        if (isset($galeris) && !empty($galeris)): ?>
        <?php foreach ($galeris as $galeri): 
        $no++;  
        ?>  
            <div class="col-lg-4 col-md-6 col-sm-6 portfolio-item isotope-item filter-app">
              <div class="portfolio-content h-100">
                <img src="<?=base_url()?>home/image/<?=$galeri['galeri_img']?>" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Galeri <?=$no?></h4>
                  <p><?=$galeri['judul_galeri']?></p>
                  <a href="<?=base_url()?>home/image/<?=$galeri['galeri_img']?>" title="<?=$galeri['judul_galeri']?>" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-eye-fill"></i> Lihat</a> 
                </div>
              </div>
            </div><!-- End Portfolio Item --> 
        <?php endforeach; ?>
        <?php else: ?>
        <span class="fw-bolder text-muted fs-6">
		Belum ada data.
		</span>
        <?php endif; ?>  
 
 
          </div> 
		  
		  
			<!-- PAGINATION -->
			<div class="row">
			  <div class="col-12">
				<nav>
				  <ul id="portfolio-pagination" class="pagination justify-content-center mt-4"></ul>
				</nav>
			  </div>
			</div>
	
        </div>
		</div>  
        </div> 
      </section>
      <section id="clients" class="clients section">
        <div class="container" data-aos="fade-up">
			<div class="swiper inorga-slider">
			<div class="swiper-wrapper"> 
			<div class="swiper-slide"> 
			<div class="inorga_box">
            <div class="inorga_image cursor-pointer">
            <img src="<?=base_url()?>home/image-logo/fortina.jpg" alt="------" class="w-100 h-auto object-contain cursor-pointer" style="transition: transform 0.3s ease-in-out; cursor: pointer;">
            </div>
            <h1 class="text-lg font-semibold mt-2">Persatuan Olahraga Tradisional Indonesia (PORTINA)</h1>
             </div>  
            </div>
			<div class="swiper-slide">  
			<div class="inorga_box">
            <div class="inorga_image cursor-pointer">
            <img src="<?=base_url()?>home/image-logo/inassoc.jpg" alt="------" class="w-100 h-auto object-contain cursor-pointer" style="transition: transform 0.3s ease-in-out; cursor: pointer;">
            </div>
            <h1 class="text-lg font-semibold mt-2">Indonesia Airsofter Association (INASSOC)</h1>
             </div>  
            </div> 
			<div class="swiper-slide"> 
			<div class="inorga_box">
            <div class="inorga_image cursor-pointer">
            <img src="<?=base_url()?>home/image-logo/asiafi2.jpg" alt="------" class="w-100 h-auto object-contain cursor-pointer" style="transition: transform 0.3s ease-in-out; cursor: pointer;">
            </div>
            <h1 class="text-lg font-semibold mt-2">Asosiasi Instruktur Aerobik dan Fitnes Indonesia (ASIAFI)</h1>
             </div>  
            </div> 
			<div class="swiper-slide"> 
			<div class="inorga_box">
            <div class="inorga_image cursor-pointer">
            <img src="<?=base_url()?>home/image-logo/aspina.jpg" alt="------" class="w-100 h-auto object-contain cursor-pointer" style="transition: transform 0.3s ease-in-out; cursor: pointer;">
            </div>
            <h1 class="text-lg font-semibold mt-2">Asosiasi Pushbike Indonesia (ASPINA)</h1>
             </div>   
            </div>
			<div class="swiper-slide"> 
			<div class="inorga_box">
            <div class="inorga_image cursor-pointer">
            <img src="<?=base_url()?>home/image-logo/fespati.jpg" alt="------" class="w-100 h-auto object-contain cursor-pointer" style="transition: transform 0.3s ease-in-out; cursor: pointer;">
            </div>
            <h1 class="text-lg font-semibold mt-2">Federasi Seni Panahan Tradisional Indonesia (FESPATI)</h1>
             </div>  
            </div>
			<div class="swiper-slide"> 
			<div class="inorga_box">
            <div class="inorga_image cursor-pointer">
            <img src="<?=base_url()?>home/image-logo/uld.jpg" alt="------" class="w-100 h-auto object-contain cursor-pointer" style="transition: transform 0.3s ease-in-out; cursor: pointer;">
            </div>
            <h1 class="text-lg font-semibold mt-2">The Universal Line Dance (ULD)</h1>
             </div>  
            </div> 
			<div class="swiper-slide"> 
			<div class="inorga_box">
            <div class="inorga_image cursor-pointer">
            <img src="<?=base_url()?>home/image-logo/kbi.jpg" alt="------" class="w-100 h-auto object-contain cursor-pointer" style="transition: transform 0.3s ease-in-out; cursor: pointer;">
            </div>
            <h1 class="text-lg font-semibold mt-2">Komunitas Bepers Indonesia (KBI)</h1>
             </div>  
            </div>    
          </div> 
    </div>
  </div>  
      </section> 
      <!-- /Services 2 Section -->
      <!-- Clients Section -->
