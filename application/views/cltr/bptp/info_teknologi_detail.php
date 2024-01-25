<div class="breadcrumb-area">
    <!-- Top Breadcrumb Area -->
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(<?php echo base_url() ?>template/<?php echo template_cltr() ?>/assets/img/bg-img/24_2.jpg);">
        <h2><?php echo str_replace("%20"," ",$title) ?></h2>
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
                         
                         <?php
                            if($uri3=="padi"){
                                if($uris=="varietas"){
                                $url = "Varietas";
                                $get_varietas_padi = $this->db->query("select a.*,c.nama_lengkap
                                                                      from cltr_post a
                                                                      inner join cltr_page b on a.id_page=b.id_page
                                                                      inner join users c on a.username=c.username
                                                                      where b.id_page = 17");
                            ?>
                            <div id="accordion">
                                <?php
                                    $nor = 1;
                                    foreach($get_varietas_padi->result() as $gvp){
                                        if($nor==1){
                                            $sh = "show";
                                        } else {
                                            $sh = "";
                                        }
                                ?>
                                <div class="card">
                                  <div class="card-header bg-success">
                                    <a style="font-size:20px" class="card-link text-white" data-toggle="collapse" href="#collapse<?php echo $nor ?>">
                                      <?php echo $gvp->judul ?>
                                    </a>
                                  </div>
                                  <div id="collapse<?php echo $nor ?>" class="collapse <?php echo $sh ?>" data-parent="#accordion">
                                    <div class="card-body">
                                      <img class="img-fluid" src="<?php echo base_url() ?>asset/foto_content/<?php echo $gvp->gambar ?>">
                                      <?php echo $gvp->isi_berita ?>
                                      <b>Penulis : <?php echo $gvp->nama_lengkap ?></b>
                                    </div>
                                  </div>
                                </div>
                                <?php
                                $nor++;
                                    }
                                ?>
                            </div>
                            <?php
                               } else if ($uris=="budidaya") {
                                   $url = "Budidaya";
                            ?>
                            
                            <?php
                               } else if ($uris=="hitung-pupuk") {
                                   $url = "Hitung Pupuk";
                            ?>
                            
                            <?php
                               } else if ($uris=="analisis-usaha-tani") {
                                   $url = "Analisis Usaha Tani";
                            ?>
                            
                            <?php
                               }
                               
                             /* batas padi */
                             
                             } else if($uri3=="akabi"){
                                 if($uris=="varietas"){
                                $url = "Varietas";
                                $get_varietas_padi = $this->db->query("select a.*,c.nama_lengkap
                                                                      from cltr_post a
                                                                      inner join cltr_page b on a.id_page=b.id_page
                                                                      inner join users c on a.username=c.username
                                                                      where b.id_page = 18");
                            ?>
                            <div id="accordion">
                                <?php
                                    $nor = 1;
                                    foreach($get_varietas_padi->result() as $gvp){
                                        if($nor==1){
                                            $sh = "show";
                                        } else {
                                            $sh = "";
                                        }
                                ?>
                                <div class="card">
                                  <div class="card-header bg-success">
                                    <a style="font-size:20px" class="card-link text-white" data-toggle="collapse" href="#collapse<?php echo $nor ?>">
                                      <?php echo $gvp->judul ?>
                                    </a>
                                  </div>
                                  <div id="collapse<?php echo $nor ?>" class="collapse <?php echo $sh ?>" data-parent="#accordion">
                                    <div class="card-body">
                                      <img class="img-fluid" src="<?php echo base_url() ?>asset/foto_content/<?php echo $gvp->gambar ?>">
                                      <?php echo $gvp->isi_berita ?>
                                      <b>Penulis : <?php echo $gvp->nama_lengkap ?></b>
                                    </div>
                                  </div>
                                </div>
                                <?php
                                $nor++;
                                    }
                                ?>
                            </div>
                            <?php
                               } else if ($uris=="budidaya") {
                                   $url = "Budidaya";
                            ?>
                            
                            <?php
                               } else if ($uris=="hitung-pupuk") {
                                   $url = "Hitung Pupuk";
                            ?>
                            
                            <?php
                               } else if ($uris=="analisis-usaha-tani") {
                                   $url = "Analisis Usaha Tani";
                            ?>
                            
                            <?php
                               }
                            
                            /* batas akabi */  
                                 
                             } else if($uri3=="sereal"){
                                 if($uris=="varietas"){
                                $url = "Varietas";
                                $get_varietas_padi = $this->db->query("select a.*,c.nama_lengkap
                                                                      from cltr_post a
                                                                      inner join cltr_page b on a.id_page=b.id_page
                                                                      inner join users c on a.username=c.username
                                                                      where b.id_page = 26");
                            ?>
                            <div id="accordion">
                                <?php
                                    $nor = 1;
                                    foreach($get_varietas_padi->result() as $gvp){
                                        if($nor==1){
                                            $sh = "show";
                                        } else {
                                            $sh = "";
                                        }
                                ?>
                                <div class="card">
                                  <div class="card-header bg-success">
                                    <a style="font-size:20px" class="card-link text-white" data-toggle="collapse" href="#collapse<?php echo $nor ?>">
                                      <?php echo $gvp->judul ?>
                                    </a>
                                  </div>
                                  <div id="collapse<?php echo $nor ?>" class="collapse <?php echo $sh ?>" data-parent="#accordion">
                                    <div class="card-body">
                                      <img class="img-fluid" src="<?php echo base_url() ?>asset/foto_content/<?php echo $gvp->gambar ?>">
                                      <?php echo $gvp->isi_berita ?>
                                      <b>Penulis : <?php echo $gvp->nama_lengkap ?></b>
                                    </div>
                                  </div>
                                </div>
                                <?php
                                $nor++;
                                    }
                                ?>
                            </div>
                            <?php
                               } else if ($uris=="budidaya") {
                                   $url = "Budidaya";
                                   $get_varietas_padi = $this->db->query("select a.*,c.nama_lengkap
                                                                      from cltr_post a
                                                                      inner join cltr_page b on a.id_page=b.id_page
                                                                      inner join users c on a.username=c.username
                                                                      where b.id_page = 25");
                            ?>
                            <div id="accordion">
                                <?php
                                    $nor = 1;
                                    foreach($get_varietas_padi->result() as $gvp){
                                        if($nor==1){
                                            $sh = "show";
                                        } else {
                                            $sh = "";
                                        }
                                ?>
                                <div class="card">
                                  <div class="card-header bg-success">
                                    <a style="font-size:20px" class="card-link text-white" data-toggle="collapse" href="#collapse<?php echo $nor ?>">
                                      <?php echo $gvp->judul ?>
                                    </a>
                                  </div>
                                  <div id="collapse<?php echo $nor ?>" class="collapse <?php echo $sh ?>" data-parent="#accordion">
                                    <div class="card-body">
                                      <?php echo $gvp->isi_berita ?>
                                      <img class="img-fluid" src="<?php echo base_url() ?>asset/foto_content/<?php echo $gvp->gambar ?>">
                                      <br>
                                      <b>Penulis : <?php echo $gvp->nama_lengkap ?></b>
                                    </div>
                                  </div>
                                </div>
                                <?php
                                $nor++;
                                    }
                                ?>
                            </div>
                            <?php
                               } else if ($uris=="hitung-pupuk") {
                                   $url = "Hitung Pupuk";
                            ?>
                            
                            <?php
                               } else if ($uris=="analisis-usaha-tani") {
                                   $url = "Analisis Usaha Tani";
                            ?>
                            
                            <?php
                               }
                               
                             /* batas */
                             } else if($uri3=="bawang%20merah"){
                                 if($uris=="varietas"){
                                $url = "Varietas";
                                $get_varietas_padi = $this->db->query("select a.*,c.nama_lengkap
                                                                      from cltr_post a
                                                                      inner join cltr_page b on a.id_page=b.id_page
                                                                      inner join users c on a.username=c.username
                                                                      where b.id_page = 26");
                            ?>
                            <div id="accordion">
                                <?php
                                    $nor = 1;
                                    foreach($get_varietas_padi->result() as $gvp){
                                        if($nor==1){
                                            $sh = "show";
                                        } else {
                                            $sh = "";
                                        }
                                ?>
                                <div class="card">
                                  <div class="card-header bg-success">
                                    <a style="font-size:20px" class="card-link text-white" data-toggle="collapse" href="#collapse<?php echo $nor ?>">
                                      <?php echo $gvp->judul ?>
                                    </a>
                                  </div>
                                  <div id="collapse<?php echo $nor ?>" class="collapse <?php echo $sh ?>" data-parent="#accordion">
                                    <div class="card-body">
                                      <img class="img-fluid" src="<?php echo base_url() ?>asset/foto_content/<?php echo $gvp->gambar ?>">
                                      <?php echo $gvp->isi_berita ?>
                                      <b>Penulis : <?php echo $gvp->nama_lengkap ?></b>
                                    </div>
                                  </div>
                                </div>
                                <?php
                                $nor++;
                                    }
                                ?>
                            </div>
                            <?php
                               } else if ($uris=="budidaya") {
                                   $url = "Budidaya";
                                   $get_varietas_padi = $this->db->query("select a.*,c.nama_lengkap
                                                                      from cltr_post a
                                                                      inner join cltr_page b on a.id_page=b.id_page
                                                                      inner join users c on a.username=c.username
                                                                      where b.id_page = 31");
                            ?>
                            <div id="accordion">
                                <?php
                                    $nor = 1;
                                    foreach($get_varietas_padi->result() as $gvp){
                                        if($nor==1){
                                            $sh = "show";
                                        } else {
                                            $sh = "";
                                        }
                                ?>
                                <div class="card">
                                  <div class="card-header bg-success">
                                    <a style="font-size:20px" class="card-link text-white" data-toggle="collapse" href="#collapse<?php echo $nor ?>">
                                      <?php echo $gvp->judul ?>
                                    </a>
                                  </div>
                                  <div id="collapse<?php echo $nor ?>" class="collapse <?php echo $sh ?>" data-parent="#accordion">
                                    <div class="card-body">
                                      <?php echo $gvp->isi_berita ?>
                                      <img class="img-fluid" src="<?php echo base_url() ?>asset/foto_content/<?php echo $gvp->gambar ?>">
                                      <br>
                                      <b>Penulis : <?php echo $gvp->nama_lengkap ?></b>
                                    </div>
                                  </div>
                                </div>
                                <?php
                                $nor++;
                                    }
                                ?>
                            </div>
                            <?php
                               } else if ($uris=="hitung-pupuk") {
                                   $url = "Hitung Pupuk";
                            ?>
                            
                            <?php
                               } else if ($uris=="analisis-usaha-tani") {
                                   $url = "Analisis Usaha Tani";
                            ?>
                            
                            <?php
                               }
                               
                             /* batas */
                             }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Blog Content Area End ##### -->
