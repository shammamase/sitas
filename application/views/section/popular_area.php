            <!-- Start popular-course Area -->
            <section class="popular-course-area">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="menu-content pb-70 col-lg-8">
                            <div class="title text-center">
                                <h1 class="mb-10"><?php echo $titel_satu ?></h1>
                                <p><?php echo $titel_dua ?></p>
                            </div>
                        </div>
                    </div>                      
                    <div class="row">
                        <div class="active-popular-carusel">
                            <?php 
                                $dbax = $this->db->query($dbase)->result();
                                foreach ($dbax as $dbx) {
                                    $isi_berita = strip_tags($dbx->isi_berita); 
                                    $isi = substr($isi_berita,0,130); 
                                    $isi = substr($isi_berita,0,strrpos($isi," "));
                                    $tanggal = tgl_indo($dbx->tanggal);
                                    $user_cr = $this->model_users->user_kuliner($dbx->username);
                            ?>
                            <div class="single-popular-carusel">
                                <div class="thumb-wrap relative">
                                    <div class="thumb relative">
                                        <div class="overlay overlay-bg"></div>  
                                        <img class="img-fluid" src="<?php echo base_url().'/asset/foto_content/'.$dbx->gambar ?>" alt="">
                                    </div>
                                    <div class="meta d-flex justify-content-between">
                                        <p><span class="lnr lnr-users"><?php echo $user_cr->nama_lengkap ?></span> <span class="lnr lnr-bubble"><?php echo $dbx->dibaca ?></span></p>
                                        <h4 style="font-size:11px"><?php echo $tanggal ?></h4>
                                    </div>                                  
                                </div>
                                <div class="details">
                                    <a href="<?php echo site_url('Berita/detail/'.$dbx->judul_seo) ?>">
                                        <h4>
                                            <?php echo $dbx->judul ?>
                                        </h4>
                                    </a>
                                    <p>
                                        <?php echo $isi ?>                                       
                                    </p>
                                </div>
                            </div>         
                            <?php
                                }
                             ?>          
                        </div>
                    </div>
                </div>  
            </section>
            <!-- End popular-course Area -->