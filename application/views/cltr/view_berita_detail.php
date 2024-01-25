<?php 
    $user_crt = $this->model_users->user_kuliner($record['username']);
 ?>

<div class="breadcrumb-area">
    <!-- Top Breadcrumb Area -->
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(<?php echo base_url() ?>template/<?php echo template_cltr() ?>/assets/img/bg-img/26.jpg);">
        <!--<h2 style="text-align:center"><?php echo $title ?></h2>-->
    </div>
</div>
<br>
<!-- ##### Blog Content Area Start ##### -->
<section class="blog-content-area section-padding-0-100">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Blog Posts Area -->
            <div class="col-12 col-md-8">
                <div class="blog-posts-area">

                    <!-- Post Details Area -->
                    <div class="single-post-details-area">
                        <div class="post-content">
                            <h4 class="post-title"><?php echo $title ?></h4>
                            <div class="post-meta mb-30">
                                <a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $record['tanggal'] ?></a>
                                <a href="#"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $user_crt->nama_lengkap ?></a>
                            </div>
                            <div class="post-thumbnail mb-30">
                                <?php 
                                    if(!empty($record['gambar'])){
                                ?>
                                <img src="<?php echo base_url() ?>asset/foto_content/<?php echo $record['gambar'] ?>" alt="">
                                <?php
                                    }
                                ?>
                                <div style="font-size:12px; color:#9d9f9d; text-align: justify; width:95%"><?php echo $record['caption']  ?></div>
                            </div>
                            <p><?php echo $record['isi_berita'] ?></p>
                        </div>
                    </div>

                    <!-- Post Tags & Share -->
                    <div class="post-tags-share d-flex justify-content-between align-items-center">
                        <!-- Tags -->
                        <ol class="popular-tags d-flex align-items-center flex-wrap">
                            <li><span>Tag:</span></li>
                            <?php 
                                $idf = $record['id_post'];
                                $tag_berita = $this->db->query("SELECT tag, tag_asli FROM cltr_post WHERE id_post = '$idf'")->row();
                                if (!empty($tag_berita->tag)) {
                                    $pica_tag = explode(",", $tag_berita->tag);
                                    $pc_tag = explode(",", $tag_berita->tag_asli);
                                    $jum_tag = count($pica_tag);
                                    for ($i=0; $i < $jum_tag; $i++) { 
                                ?>
                                <li><a style="font-size:10px" href="<?php echo site_url('berita/tag/'.$pc_tag[$i]) ?>"><?php echo $pica_tag[$i] ?></a></li>
                                <?php 
                                    }
                                }
                            ?>
                            
                        </ol>
                        <!-- Share -->
                        <div class="post-share">
                            <?php $share = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
            
                            <a href="https://www.facebook.com/sharer.php?u=<?php echo $share; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="https://twitter.com/share?url=<?php echo $share; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="https://plus.google.com/share?url=<?php echo $share; ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                            <a href="whatsapp://send?text=<?php echo $share; ?>"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blog Sidebar Area -->
            <div class="col-12 col-sm-9 col-md-4">
                <div class="post-sidebar-area">

                    <!-- ##### Single Widget Area ##### -->
                    <div class="single-widget-area">
                        <form action="<?php echo site_url('berita/cari') ?>" method="post" class="search-form">
                            <input type="search" name="cari" id="widgetsearch" placeholder="Search...">
                            <button type="submit" name="submit"><i class="icon_search"></i></button>
                        </form>
                    </div>
                    <div class="single-widget-area">
                        
    	      		</div>

                    <!-- ##### Single Widget Area ##### -->
                    <div class="single-widget-area">
                        <!-- Title -->
                        <div class="widget-title">
                            <h4 style="color:#188A06">Konten Terkait</h4>
                        </div>
                        
                        <?php 
                            foreach ($infoterkait->result() as $infokait) {
                            $tgl_info = tgl_indo($infokait->tanggal);
                        ?>
                        <!-- Single Latest Posts -->
                        <div class="single-latest-post d-flex align-items-center">
                            <div class="post-content">
                                <a href="<?php echo site_url('berita/detail/'.$infokait->judul_seo) ?>" class="post-title">
                                    <h6><?php echo $infokait->judul ?></h6>
                                </a>
                                <a href="#" class="post-date"><?php echo $tgl_info ?> | Di baca : <?php echo $infokait->dibaca ?></a>
                            </div>
                        </div>
                        <?php    
                            }
                        ?>
                    </div>
                    
                    <div class="single-widget-area">
                        <!-- Title -->
                        <div class="widget-title">
                            <h4 style="color:#188A06"><?php echo $basis ?> Terkini</h4>
                        </div>
                        
                        <?php 
                        $barus = $this->db->query("SELECT a.*, b.nama_lengkap FROM cltr_post a INNER JOIN users b ON a.username=b.username WHERE a.acc = 1 AND a.id_page = '$id_p' ORDER BY a.id_post DESC LIMIT 5")->result_array();
                            foreach ($barus as $brs) {
                               $tanggal_barus = tgl_indo($brs['tanggal']);
                        ?>
                        <!-- Single Latest Posts -->
                        <div class="single-latest-post d-flex align-items-center">
                            
                            <div class="post-content">
                                <a href="<?php echo site_url('berita/detail/'.$brs['judul_seo']) ?>" class="post-title">
                                    <h6><?php echo $brs['judul'] ?></h6>
                                </a>
                                <a href="#" class="post-date"><?php echo $tanggal_barus ?></a>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                    
                    <div class="single-widget-area">
                        <!-- Title -->
                        <div class="widget-title">
                            <h4 style="color:#188A06"><?php echo $basis ?> Terpopuler</h4>
                        </div>
                        
                        <?php 
                        $xss = $this->db->query("SELECT a.*, b.nama_lengkap FROM cltr_post a INNER JOIN users b ON a.username=b.username WHERE a.acc = 1 AND a.id_page = '$id_p' ORDER BY a.dibaca DESC LIMIT 5")->result_array();
                            foreach ($xss as $xs) {
                               $tanggal_xs = tgl_indo($xs['tanggal']);
                        ?>
                        <!-- Single Latest Posts -->
                        <div class="single-latest-post d-flex align-items-center">
                            
                            <div class="post-content">
                                <a href="<?php echo site_url('berita/detail/'.$xs['judul_seo']) ?>" class="post-title">
                                    <h6><?php echo $xs['judul'] ?></h6>
                                </a>
                                <a href="#" class="post-date"><?php echo $tanggal_xs ?></a>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Blog Content Area End ##### -->