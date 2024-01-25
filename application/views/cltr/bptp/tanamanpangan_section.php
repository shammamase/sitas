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
                            <?php
                            $no_lim = 1;
                            $list_img = explode(",",$dt->list_img);
                            foreach($list_img as $lim){
                                if($no_lim==1){
                                    $detail = "Varietas";
                                } else if($no_lim==2){
                                    $detail = "Budidaya";
                                } else if($no_lim==3){
                                    if($uri3==5){
                                        $detail = "Formulasi Pakan";
                                    } else {
                                        $detail = "Hitung Pupuk";
                                    }
                                } else {
                                    $detail = "Analisis Usaha Tani";
                                }
                                
                                if(str_word_count($detail)>2){
                                    $fonts = "14px";
                                } else {
                                    $fonts = "15px";
                                }
                            ?>
                            <div style="margin-top:10px" class="col-6">
                                <a href="<?php echo base_url() ?>bptp/detail_infotek/<?php echo strtolower($dt->jenis_teknologi) ?>/<?php echo seo_title($detail) ?>">
                                <div class="card bg-success">
                                  <div class="card-body text-center">
                                     <img class="img-fluid" width="250" height="250" src="<?php echo base_url() ?>asset/android/<?php echo $lim ?>">
                                    <b><p style="font-size:<?php echo $fonts ?>" class="card-text text-white"><?php echo $detail ?></p></b>
                                  </div>
                                </div>
                                </a>
                            </div>
                            <?php
                            $no_lim++;
                            }
                            ?>
                        </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Blog Content Area End ##### -->
