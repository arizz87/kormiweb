 <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(<?=base_url()?>home/image-logo/cover-kormi.png);">
      <div class="container position-relative">
        <h1>BERITA & ARTIKEL</h1> 
      </div>
    </div><!-- End Page Title -->

    <!-- Service Details Section -->
    <section id="service-details" class="service-details section"> 
      <div class="container">
          <div class="row gy-4"> 
		  <div class="col-md-8" id="faqAccordion" data-aos="fade-up" data-aos-delay="100">  
            <h3><?=$detail['blog_title']?></h3> 
            <font style=color:brown;font-weight:bold;font-size:14px><i class="bi bi-calendar2-check"></i> <?= format_hari($detail['blog_tgl']) ?>, <?= format_indo($detail['blog_tgl']) ?></font>
            <p>
            <div class="artikel_detail_image">
		    <img class="img-fluid services-img" src="<?= base_url('home/image/').$detail['blog_img']; ?>" alt="<?= $detail['blog_title'] ?>">
            </div>
            <div style=text-align:justify>
            <?=$detail['blog_isi']?>
            </div> 
            <div class="artikel_detail_share">
            <h3>Bagikan Berita :</h3>
            <?php
            $url   = current_url(); // URL halaman berita
            $title = isset($blog['blog_slug']) ? urlencode($blog['blog_slug']) : '';
            ?>
            <div class="artikel_detail_share_layout">
            <div class="artikel_detail_share_box">
            <a href="https://x.com/intent/post?url=<?= urlencode($url) ?>" target="_blank" rel="noopener"><iconify-icon class="bi bi-twitter-x"></i></a>&nbsp; 
            </div>
            <div class="artikel_detail_share_box">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($url) ?>" target="_blank" rel="noopener"><iconify-icon class="bi bi-facebook"></i></a>&nbsp; 
            </div>
            <div class="artikel_detail_share_box">
            <a href="https://www.instagram.com/" target="_blank" title="Salin link lalu bagikan di Instagram"><iconify-icon class="bi bi-instagram"></i></a>&nbsp; 
            </div>
            <div class="artikel_detail_share_box">
            <a href="https://wa.me/?text=<?= urlencode($title . ' ' . $url) ?>"  target="_blank" rel="noopener"><iconify-icon class="bi bi-whatsapp"></i></a>
            </div> 
            </div>
            </div>
          </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100"> 
            <div class="artikel_section_sidebar_box">
            <h3>Berita Terbaru</h3>
            <div class="services-list">
                    <ul> 
                    <?php  
                    if (isset($new_blogs) && !empty($new_blogs)): ?>
                    <?php foreach ($new_blogs as $blog): ?> 
                    <a href="<?=base_url()?>berita/detail/<?=$blog['blog_slug']?>">
                     <?= substr($blog['blog_title'], 0); ?>
                    </a>  
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p>Tidak ada berita.</p>
                    <?php endif; ?>          
                    </ul>
                </div>
            </div> 
			
            </div>
            <!-- End Service Item --> 
          </div>
        </div> 
    </section><!-- /Service Details Section -->