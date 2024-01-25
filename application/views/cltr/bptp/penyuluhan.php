<div class="breadcrumb-area">
    <!-- Top Breadcrumb Area -->
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(<?php echo base_url() ?>template/<?php echo template_cltr() ?>/assets/img/bg-img/24_2.jpg);">
        <h2><?php echo $title ?></h2>
    </div>
</div>
<br>
<section class="blog-content-area section-padding-0-100">
    <div class="container">
        <?php
            $arr_suluh = array(
                    "http://bptpgorontalo-ppid.pertanian.go.id/doc/180/16. RDHP 2021 - Peningkatan Kapasitas Penyuluh Daerah.pdf",
                    "http://bptpgorontalo-ppid.pertanian.go.id/doc/180/18. RDHP 2021 - Temu tugas peneliti penyuluh.pdf"
                );
            $id_suluh = 1;
            foreach($arr_suluh as $avl){
                $jdl_sl = substr($avl,50);
        ?>
        <button style="margin-bottom:10px" type="button" class="btn btn-success btn-block" data-toggle="collapse" data-target="#sl<?php echo $id_suluh ?>"><?php echo $jdl_sl ?></button>
        <div id="sl<?php echo $id_suluh ?>" class="collapse">
            <iframe width="100%" height="800px" src="<?php echo $avl ?>"></iframe>
        </div>
        <?php
        $id_suluh++;
            }
        ?>
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
                                    <th style="width:75%">Kegiatan</th>
                                    <th style="width:10%">Waktu</th>
                                    <th style="width:10%">Dibaca</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $noa = 1;
                                    foreach($res as $da){
                                ?>
                                  <tr>
                                    <td><?php echo $noa ?></td>
                                    <td class="table-success"><a href="<?php echo base_url().'berita/detail/'.$da->judul_seo ?>"><?php echo $da->judul ?></a></td>
                                    <td><?php echo tgl_indo($da->tanggal) ?></td>
                                    <td><?php echo $da->dibaca ?> Kali</td>
                                  </tr>
                                <?php
                                $noa++;
                                    }
                                ?>
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Blog Content Area End ##### -->