<!-- ##### Portfolio Area Start ##### -->
    <section class="alazea-portfolio-area section-padding-100-0">
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
        </div>

        <div class="container-fluid">
            

            <div class="row alazea-portfolio">
                
                <?php 
                 $dbax = $this->db->query($dbase)->result();
                        foreach ($dbax as $dbx) {
                            $isi_berita = strip_tags($dbx->isi_berita); 
                            $isi = substr($isi_berita,0,130); 
                            $isi = substr($isi_berita,0,strrpos($isi," "));
                ?>
                <!-- Single Portfolio Area -->
                <div class="col-6 col-sm-6 col-lg-3 single_portfolio_item design home-design wow fadeInUp" data-wow-delay="100ms">
                    <!-- Portfolio Thumbnail -->
                    <div class="portfolio-thumbnail bg-img" style="background-image: url(<?php echo base_url(); ?>/asset/foto_content/<?php echo $dbx->thumbnail ?>);"></div>
                    <!-- Portfolio Hover Text -->
                    <div class="portfolio-hover-overlay">
                        <a href="<?php echo base_url(); ?>asset/foto_content/<?php echo $dbx->thumbnail ?>" class="portfolio-img d-flex align-items-center justify-content-center" title="<?php echo $dbx->judul ?>">
                            <div class="port-hover-text">
                                <h3><?php echo $dbx->judul ?></h3>
                                <h5><?php echo $isi ?></h5>
                            </div>
                        </a>
                    </div>
                </div>
                <?php            
                        }
                ?>
            
            </div>
        </div>
    </section>
    <!-- ##### Portfolio Area End ##### -->