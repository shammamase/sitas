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
                            <table style="width:100%;color:white" class="table table-dark table-bordered">
                                <thead>
                                  <tr>
                                    <th style="width:5%">No</th>
                                    <th style="width:55%">Agenda</th>
                                     <th style="width:30%">Lokasi</th>
                                    <th style="width:10%">Waktu</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $noa = 1;
                                    foreach($data_agenda as $da){
                                ?>
                                  <tr>
                                    <td><?php echo $noa ?></td>
                                    <td><?php echo $da->agenda ?></td>
                                    <td><?php echo $da->lokasi ?></td>
                                    <td><?php echo tgl_indo($da->waktu) ?></td>
                                  </tr>
                                <?php
                                $noa++;
                                    }
                                ?>
                                </tbody>
                              </table>
                              <p><a style="color:green" href="<?= base_url() ?>asset/file_lainnya/agenda_2021.pdf"><i class="fa fa-file-pdf-o" style="font-size:20px;color:green"></i> Daftar Agenda 2021 </a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Blog Content Area End ##### -->