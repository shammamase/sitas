<!-- Breadcrumb Area Start -->
    <?php 
        $url_img = base_url()."template/".template_cltr()."/img/bg-img/17.jpg";
     ?>
    <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(<?php echo $url_img ?>)">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">Tag : <?php echo $title ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->
    <!-- Blog Area Start -->
    <div class="roberto-news-area section-padding-100-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <?php 
                    foreach ($tagx->result_array() as $row){
                        $isi_berita = strip_tags($row['isi_berita']); 
                        $isi = substr($isi_berita,0,130); 
                        $isi = substr($isi_berita,0,strrpos($isi," "));
                        $tanggal = tgl_indo($row['tanggal']);
                        //if ($row['gambar'] == ''){ $foto = 'small_no-image.jpg'; }else{ $foto = $row['gambar']; }
                    ?>
                    <div class="single-blog-post d-flex align-items-center mb-50 wow fadeInUp" data-wow-delay="100ms">
                        <div class="post-thumbnail">
                            <a href="#"><img src="<?php echo base_url() ?>asset/foto_souvenir/<?php echo $row['gambar'] ?>"></a>
                        </div>
                        <div class="post-content">
                            <div class="post-meta">
                                <a href="#" class="post-author"><?php echo $row['hari'] ?></a>
                                <a href="#" class="post-tutorial"><?php echo $tanggal ?></a>
                            </div>
                            <a href="<?php echo site_url('souvenir/detail/'.$row['judul_seo']) ?>" class="post-title"><?php echo $row['judul'] ?></a>
                            <?php echo $isi ?>...
                            <br><br><a href="<?php echo site_url('souvenir/detail/'.$row['judul_seo']) ?>" class="btn continue-btn">Read More</a>
                        </div>
                    </div>
                    <?php
                    }
                     ?>
                    <!-- Pagination -->
                    <nav class="roberto-pagination wow fadeInUp mb-100" data-wow-delay="600ms">
                        <?php echo $this->pagination->create_links(); ?>
                    </nav>
                </div>

                <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                    <div class="roberto-sidebar-area pl-md-4">
                        <!-- Newsletter -->
                        <div class="single-widget-area mb-100">
                            <div class="newsletter-form">
                                <h5>Newsletter</h5>
                                <p>Subscribe our newsletter gor get notification new updates.</p>
                                
                                <form action="#" method="post">
                                    <input type="email" name="nl-email" id="nlEmail" class="form-control" placeholder="Enter your email...">
                                    <button type="submit" class="btn roberto-btn w-100">Subscribe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Area End -->