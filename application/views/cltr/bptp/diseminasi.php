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
            $arr_dis = array(
                    "http://bptpgorontalo-ppid.pertanian.go.id/doc/180/6. RDHP 2021 - Pameran, Publikasi dan Mobile Diseminasi.pdf",
                    "http://bptpgorontalo-ppid.pertanian.go.id/doc/180/8. RDHP 2021 - Pendampingan inovasi dan pengembangan kawasan.pdf",
                    "http://bptpgorontalo-ppid.pertanian.go.id/doc/180/9. RDHP 2021 - Pemetaan SDP.pdf",
                    "http://bptpgorontalo-ppid.pertanian.go.id/doc/180/10. RDHP 2021 - Pengembangan ayam KUB Inti Plasma.pdf",
                    "http://bptpgorontalo-ppid.pertanian.go.id/doc/180/11. RDHP 2021 - Pengembangan ayam KUB RTM.docx",
                    "http://bptpgorontalo-ppid.pertanian.go.id/doc/180/14. RDHP 2021 - Penerapan Inotek untuk Peningkatan IP.pdf",
                    "http://bptpgorontalo-ppid.pertanian.go.id/doc/180/15. RDHP 2021 - Akselerasi diseminasi melalui cafe inovasi.pdf",
                    "http://bptpgorontalo-ppid.pertanian.go.id/doc/180/17. RDHP 2021 - Kaji Terap.pdf",
                    "http://bptpgorontalo-ppid.pertanian.go.id/doc/180/19. RDHP 2021 - Produksi benih padi 5 ton.pdf",
                    "http://bptpgorontalo-ppid.pertanian.go.id/doc/180/20. RDHP 2021 - Produksi benih Biofortifikasi Nutrizink 5 ton.pdf",
                    "http://bptpgorontalo-ppid.pertanian.go.id/doc/180/21. RDHP 2021 - Produksi benih jagung hibrida 4 ton.pdf"
                );
            $id_dis = 1;
            foreach($arr_dis as $dis){
                $jdl_dis = substr($dis,50);
        ?>
        <button style="margin-bottom:10px" type="button" class="btn btn-success btn-block" data-toggle="collapse" data-target="#dis<?php echo $id_dis ?>"><?php echo $jdl_dis ?></button>
        <div id="dis<?php echo $id_dis ?>" class="collapse">
            <iframe width="100%" height="800px" src="<?php echo $dis ?>"></iframe>
        </div>
        <?php
        $id_dis++;
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