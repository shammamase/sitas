<!-- ##### Blog Area Start ##### -->
    <section class="alazea-blog-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading -->
                    <div class="section-heading text-center">
                        <h2><?php echo $titel_satu ?></h2>
                        <p><?php echo $titel_dua ?></p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <?php 
                 $dbax = $this->db->query($dbase)->result();
                        foreach ($dbax as $dbx) {
                            $isi_berita = strip_tags($dbx->isi_berita); 
                            $isi = substr($isi_berita,0,130); 
                            $isi = substr($isi_berita,0,strrpos($isi," "));
                            $tanggal = tgl_indo($dbx->tanggal);
                            $user_cr = $this->model_users->user_kuliner($dbx->username);
                ?>
                <!-- Single Blog Post Area -->
                <div class="col-12 col-md-3 col-lg-3">
                    <div class="single-blog-post mb-100">
                        <div class="post-thumbnail mb-30">
                            <a href="<?php echo site_url('Berita/detail/'.$dbx->judul_seo) ?>"><img src="<?php echo base_url().'/asset/foto_content/'.$dbx->gambar ?>" alt=""></a>
                        </div>
                        <div class="post-content">
                            <a href="<?php echo site_url('Berita/detail/'.$dbx->judul_seo) ?>" class="post-title">
                                <h5><?php echo $dbx->judul ?></h5>
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
        </div>
    </section>
    <!-- ##### Blog Area End ##### -->