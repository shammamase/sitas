<div class="breadcrumb-area">
    <!-- Top Breadcrumb Area -->
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(<?php echo base_url() ?>template/<?php echo template_cltr() ?>/assets/img/bg-img/24_2.jpg);">
        <h2><?php echo $title ?></h2>
    </div>
</div>
<br>
<section class="blog-content-area section-padding-0-100">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Blog Posts Area -->
            <div class="col-12 col-md-12 col-lg-12">
                <div class="blog-posts-area">

                    <!-- Post Details Area -->
                    <div class="single-post-details-area">
                        <div class="post-content">
                         <div class="row">
                            <?php foreach($dt as $dtt){ ?>
                            <div style="margin-top:10px" class="col-12 col-md-4 col-lg-4 col-xl-4">
                                <a href="<?php echo base_url() ?>bptp/info_teknologi/<?php echo $dtt->id_teknologi ?>/<?php echo $dtt->id_tek ?>">
                                <div class="card">
                                  <div class="card-body text-center">
                                     <img class="img-fluid" style="width:auto;height:150px" src="<?php echo base_url() ?>asset/foto_content/<?php echo $dtt->img_jenis_teknologi ?>">
                                     <br>
                                    <p class="card-text"><b><?php echo $dtt->jenis_teknologi ?></b></p>
                                  </div>
                                </div>
                                </a>
                            </div>
                            <?php } ?>
                          </div>
                          <br>
                          
                         <!--
                         <div class="row">
                            <div class="col-6">
                                <a href="<?php echo base_url() ?>bptp/tanamanpangan_section/varietas">
                                <div class="card bg-success">
                                  <div class="card-body text-center">
                                     <img class="img-fluid" src="<?php echo base_url() ?>asset/android/varietas_padi.png">
                                    <b><p class="card-text text-white">Varietas</p></b>
                                  </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="<?php echo base_url() ?>bptp/tanamanpangan_section/budidaya">
                                <div class="card bg-success">
                                  <div class="card-body text-center">
                                    <img class="img-fluid" src="<?php echo base_url() ?>asset/android/budidaya.png">
                                    <b><p class="card-text text-white">Budidaya</p></b>
                                  </div>
                                </div>
                                </a>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="col-6">
                                <a href="<?php echo base_url() ?>bptp/tanamanpangan_section/hitungpupuk">
                                <div class="card bg-success">
                                  <div class="card-body text-center">
                                     <img class="img-fluid" src="<?php echo base_url() ?>asset/android/hitungpupuk.png">
                                    <b><p class="card-text text-white">Hitung Pupuk</p></b>
                                  </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="<?php echo base_url() ?>bptp/tanamanpangan_section/analisis">
                                <div class="card bg-success">
                                  <div class="card-body text-center">
                                     <img class="img-fluid" src="<?php echo base_url() ?>asset/android/analisis.png">
                                    <b><p class="card-text text-white">Analisis Usaha Tani</p></b>
                                  </div>
                                </div>
                                </a>
                            </div>
                          </div>
                          -->
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Blog Content Area End ##### -->
