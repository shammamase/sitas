    <section class="hero-area">
        <div class="hero-post-slides owl-carousel">
            
            <?php 
                $dbax = $this->db->query($dbase)->result();
                foreach ($dbax as $dbx) {
                    $isi_berita = strip_tags($dbx->isi_berita); 
                    $isi = substr($isi_berita,0,130); 
                    $isi = substr($isi_berita,0,strrpos($isi," "));
                    $tanggal = tgl_indo($dbx->tanggal);
                    $user_cr = $this->model_users->user_kuliner($dbx->username);
            ?>
            <!-- Single Hero Post -->
            <div class="item single-hero-post bg-overlay">
                <!-- Post Image -->
                
                <div class="slide-img bg-img" style="background-image: url(<?php echo base_url().'/asset/foto_content/'.$dbx->thumbnail ?>);"></div>
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <!-- Post Content -->
                            <div class="hero-slides-content text-center">
                                <h2><?php echo $dbx->judul ?></h2>
                                <p><?php echo $isi ?></p>
                                <a href="<?php echo site_url('berita/detail/'.$dbx->judul_seo) ?>"><button type="button" class="btn btn-outline-success"><b>Baca Selengkapnya</b></button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>

        </div>
    </section>
    <!-- ##### Hero Area End ##### -->