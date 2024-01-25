<div class="breadcrumb-area">
    <!-- Top Breadcrumb Area -->
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(<?php echo base_url() ?>template/<?php echo template_cltr() ?>/assets/img/bg-img/27.jpg);">
        <h2><?php echo $title ?></h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <!--<li class="breadcrumb-item"><a href="#"><?php echo $id_page ?></a></li>-->
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<!-- ##### Blog Area Start ##### -->
<section class="alazea-blog-area mb-100">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="row">
                    
                    <?php 
                        foreach ($destinasi->result_array() as $row){
                            $isi_berita = strip_tags($row['isi_berita']); 
                            $isi = substr($isi_berita,0,130); 
                            $isi = substr($isi_berita,0,strrpos($isi," "));
                            $tanggal = tgl_indo($row['tanggal']);
                            $user_cr = $this->model_users->user_kuliner($row['username']);
                    ?>
                     <!-- Single Blog Post Area -->
                    <div class="col-12 col-lg-6">
                        <div class="single-blog-post mb-50">
                            <div class="post-thumbnail mb-30">
                                <a href="<?php echo site_url('berita/detail/'.$row['judul_seo']) ?>"><img src="<?php echo base_url() ?>asset/foto_content/<?php echo $row['thumbnail'] ?>" alt=""></a>
                            </div>
                            <div class="post-content">
                                <a href="<?php echo site_url('berita/detail/'.$row['judul_seo']) ?>" class="post-title">
                                    <h5><?php echo $row['judul'] ?></h5>
                                </a>
                                <div class="post-meta">
                                    <a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $tanggal ?></a>
                                    <a href="#"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $user_cr->nama_lengkap ?></a>
                                </div>
                                <p class="post-excerpt"><?php echo $isi ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                   

                </div>
                

                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            <?php echo $this->pagination->create_links(); ?>
                        </nav>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-md-4">
                <div class="post-sidebar-area">

                    <!-- ##### Single Widget Area ##### -->
                    <div class="single-widget-area">
                        <form action="<?php echo site_url('berita/cari') ?>" method="post" class="search-form">
                            <input type="search" name="cari" id="widgetsearch" placeholder="Search...">
                            <button type="submit" name="submit"><i class="icon_search"></i></button>
                        </form>
                    </div>

                    <!-- ##### Single Widget Area ##### -->
                    <div class="single-widget-area">
                        <!-- Title -->
                        <div class="widget-title">
                            <h4 style="color:#188A06"><?php echo $title ?> Terkini</h4>
                        </div>
                        
                        <?php 
                            foreach ($hot as $ho) {
                                $tgl_hot = tgl_indo($ho->tanggal);
                        ?>
                        <!-- Single Latest Posts -->
                        <div class="single-latest-post d-flex align-items-center">
                            
                            <div class="post-content">
                                <a href="<?php echo site_url('berita/detail/'.$ho->judul_seo) ?>" class="post-title">
                                    <h6><?php echo $ho->judul ?></h6>
                                </a>
                                <a href="#" class="post-date"><?php echo $tgl_hot ?></a>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                    
                    
                    <!-- ##### Single Widget Area ##### -->
                    <div class="single-widget-area">
                        <!-- Title -->
                        <div class="widget-title">
                            <h4 style="color:#188A06"><?php echo $title ?> Terpopuler</h4>
                        </div>
                        
                        <?php
                            foreach ($popular as $pops) {
                            $tgl_pop = tgl_indo($pops->tanggal);
                        ?>
                        <!-- Single Latest Posts -->
                        <div class="single-latest-post d-flex align-items-center">
                            
                            <div class="post-content">
                                <a href="<?php echo site_url('berita/detail/'.$pops->judul_seo) ?>" class="post-title">
                                    <h6><?php echo $pops->judul ?></h6>
                                </a>
                                <a href="#" class="post-date"><?php echo $tgl_pop ?></a>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                    
                    <div id="gpr-kominfo-widget-container"></div>

                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Blog Area End ##### -->