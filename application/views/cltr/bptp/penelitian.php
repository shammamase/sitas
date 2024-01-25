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
            $id_penelitian = 1;
            $arr_penelitian = array(
                "https://bptpgorontalo-ppid.pertanian.go.id/doc/180/1. RPTP 2021 - Kajian Bujana dan Bujarin.pdf",
                "https://bptpgorontalo-ppid.pertanian.go.id/doc/180/2. RPTP 2021 - Kajian Formula Pakan.pdf",
                "https://bptpgorontalo-ppid.pertanian.go.id/doc/180/4. RPTP 2021 - Kajian Largona.pdf",
                "https://bptpgorontalo-ppid.pertanian.go.id/doc/180/13. RPTP 2021 - SDG.pdf"
                );
            foreach($arr_penelitian as $value){
                $judul = substr($value,50);
        ?>
        <button style="margin-bottom:10px" type="button" class="btn btn-success btn-block" data-toggle="collapse" data-target="#keg<?php echo $id_penelitian ?>"><?php echo $judul ?></button>
        <div id="keg<?php echo $id_penelitian ?>" class="collapse">
            <iframe height="800px" width="100%" src="<?php echo $value ?>"></iframe>
        </div>
        <?php
        $id_penelitian++;
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