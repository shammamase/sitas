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
                <?php 
                    foreach($res as $rs){
                ?>
                <a href="<?= site_url() ?>bptp/detail_monev/<?= $rs->id_subkomp ?>" class="btn btn-outline-success btn-block btn-lg"><?= $rs->subkomp ?></a>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</section>
<!-- ##### Blog Content Area End ##### -->
