<div class="breadcrumb-area">
    <!-- Top Breadcrumb Area -->
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(<?php echo base_url() ?>template/<?php echo template_cltr() ?>/assets/img/bg-img/24_2.jpg);">
        <h2><?php echo $title ?></h2>
    </div>
</div>
<br>
<section class="shop-page section-padding-0-100">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Blog Posts Area -->
            <div class="col-12 col-md-12 col-lg-12">
                <div class="shop-products-area">
                    <div class="row">
                        <?php
                            foreach($res as $rs){
                        ?>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-area mb-50">
                                    <!-- Product Image -->
                                    <div style="text-align:center" class="product-img">
                                        <a target="_blank" href="https://play.google.com/store/apps/details?id=com.gorontalo.bptp_mobile"><img style="width:200px;height:200px" src="<?php echo base_url() ?>asset/foto_content/<?php echo $rs->image_url ?>" alt=""></a>
                                        <!-- Product Tag -->
                                        <div class="product-tag">
                                            <a href="#">Hot</a>
                                        </div>
                                    </div>
                                    <!-- Product Info -->
                                    <div class="product-info mt-15 text-center">
                                        <a class="btn btn-success" target="_blank" href="https://play.google.com/store/apps/details?id=com.gorontalo.bptp_mobile">
                                            <p style="color:white"><?php echo $rs->nama_produk ?></p>
                                        </a>
                                        <h6>Rp. <?php echo number_format($rs->harga_produk) ?> / <?php echo $rs->satuan ?></h6>
                                    </div>
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
