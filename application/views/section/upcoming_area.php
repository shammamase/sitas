<!-- ##### About Area Start ##### -->
    <section class="about-us-area bg-gray section-padding-100-0">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-md-7 col-lg-7">
                    <!-- Section Heading -->
                    <div class="section-heading">
                        <h2><?php echo $titel_satu ?></h2>
                        <p><?php echo $titel_dua ?></p>
                    </div>
                <?php    
                    $dbax = $this->db->query($dbase)->result();
                        foreach ($dbax as $dbx) {
                        $tanggal = tgl_indo($dbx->waktu_publikasi);
                ?>
                    <div style="margin-bottom:10px;background-color:#ffffff" class="col-12">
                        <div class="single-blog-post">
                            
                            <div class="post-content">
                                <a target="_blank" href="<?php echo $dbx->url_publikasi ?>" class="post-title">
                                    <h5><?php echo $dbx->judul_publikasi ?></h5>
                                </a>
                                <div style="margin-top:-10px" class="post-meta">
                                    <a href="<?php echo $dbx->url_publikasi ?>"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $tanggal ?></a>
                                    <a href="<?php echo $dbx->url_publikasi ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $dbx->nama ?></a>
                                </div>
                                <p style="margin-top:-10px" class="post-excerpt">Tempat : <?php echo $dbx->tempat_publikasi ?> , (-) , Vol : (<?php echo $dbx->vol_publikasi ?>)</p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                    

                </div>


                <!-- batas -->
                <div class="col-12 col-lg-5">
                    <div class="alazea-benefits-area">
                        <div class="row">
                            
                            <div style="margin-top:75px;margin-bottom:10px" class="alazea-video-area bg-overlay">
                                <img src="<?php echo base_url(); ?>template/<?php echo template_cltr() ?>/assets/img/bg-img/data1.jpg" alt="">
                            </div>
                            <!--
                            <div class="alazea-video-area bg-overlay">
                                <img src="<?php echo base_url(); ?>template/<?php echo template_cltr() ?>/assets/img/bg-img/data2.jpg" alt="">
                            </div>
                            -->
                            
                            <a style="cursor:pointer" data-toggle="modal" data-target="#mutu">
                            <div style="margin-top:10px" class="alazea-video-area">
                                <img style="width:400px" src="<?php echo base_url(); ?>asset/foto_banner_cltr/iso_9001_4.jpg" alt="">
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="border-line"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### About Area End ##### -->
     <div class="modal fade" id="mutu">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
              <img src="<?php echo base_url(); ?>asset/foto_banner_cltr/iso_9001_4.jpg" alt="">
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
            
          </div>
        </div>
    </div>