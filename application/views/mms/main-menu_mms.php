<!-- Preloader -->
<div class="preloader d-flex align-items-center justify-content-center">
    <div class="preloader-circle"></div>
    <div class="preloader-img">
        <img src="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/img/core-img/kementa2.png" alt="">
    </div>
</div>

<!-- ##### Header Area Start ##### -->
<header class="header-area">

  <!-- ***** Top Header Area ***** -->
  <div style="background-color:#ffffff" class="top-header-area">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="top-header-content d-flex align-items-center justify-content-between">
              <!-- Top Header Content -->
              <div class="top-header-meta">
              <?php 
                  $km1 = 14;
                  $topheader = $this->db->query("select * from cltr_menu where id_kat_menu = $km1");
                  foreach ($topheader->result() as $thd) {
              ?>
              <a href="<?php echo $thd->url ?>" title="<?php echo $thd->nama_menu ?>"><i class="<?php echo $thd->icon ?>" aria-hidden="true"></i> <span style="color:green"><?php echo $thd->nama_menu ?></span></a>
              <?php
                  }
               ?>
              </div>

              <!-- Top Header Content -->
              <div class="top-header-meta d-flex">
                <?php 
                  $km2 = 1;
                  $topheader2 = $this->db->query("select * from cltr_menu where id_kat_menu = $km2");
                  foreach ($topheader2->result() as $thd2) {
                ?>
                <div class="login">
                    <a href="<?php echo $thd2->url ?>" target="_blank"><i class="<?php echo $thd2->icon ?>" aria-hidden="true"></i></a>
                </div>
                <?php
                  }
                 ?>
                 <div id="google_translate_element"></div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Navbar Area ***** -->
  <div class="alazea-main-menu">
    <div class="classy-nav-container breakpoint-off">
      <div class="container">
          <!-- Menu -->
          <nav class="classy-navbar justify-content-between" id="alazeaNav">

              <!-- Nav Brand -->
              <?php 
                $lg = $this->db->query("select logo from cltr_identitas where id_identitas = 1")->row();
               ?>
              <a href="<?php echo site_url('Utama_cltr') ?>" class="nav-brand"><img src="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/img/core-img/<?php echo $lg->logo ?>" alt=""></a>

              <!-- Navbar Toggler -->
              <div class="classy-navbar-toggler">
                  <span class="navbarToggler"><span></span><span></span><span></span></span>
              </div>

              <!-- Menu -->
              <div class="classy-menu">

                  <!-- Close Button -->
                  <div class="classycloseIcon">
                      <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                  </div>

                  <!-- Navbar Start -->
                  <div class="classynav">
                      <ul>
                          <li><a href="<?php echo site_url('Utama_cltr') ?>">Beranda</a></li>
                          <?php 
                              $qw_menux = $this->db->query("SELECT a.utama, a.sekunder, b.* FROM cltr_menu a INNER JOIN halamanstatis b ON a.utama=b.id_halaman WHERE a.id_kat_menu = 2")->result();
                              foreach ($qw_menux as $qm) {
                                  if (empty($qm->sekunder)) {
                          ?>
                          <li><a href="<?php echo site_url('page/hal/'.$qm->page_seo) ?>"><?php echo $qm->judul ?></a></li>
                          <?php 
                                } else {
                          ?>
                          <li><a href="#"><?php echo $qm->judul ?></a>
                            <ul class="dropdown">
                              <?php 
                                $sub_mn = $this->db->query("SELECT * FROM halamanstatis WHERE id_halaman IN ($qm->sekunder)")->result();
                                foreach ($sub_mn as $sm) {
                                    if(strlen($sm->judul)>=26){
                                        $lg = "line-height: 1.5; margin-top:7px ;margin-bottom:10px";
                                    } else {
                                        $lg = "";
                                    }
                                $sub_mn2 = $this->db->query("SELECT * FROM cltr_menu2 WHERE id_kat_menu = 2 AND level = 3 AND menu1 = '$sm->id_halaman'");
                                $cek_jml_sm = $sub_mn2->num_rows();
                                $sb_mn = $sub_mn2->row();
                                if ($cek_jml_sm>0) {
                              ?>
                              <li><a href=""><?php echo $sm->judul ?></a>
                                <ul class="dropdown">
                                  <?php 
                                          $sub_mn22 = $this->db->query("SELECT * FROM halamanstatis WHERE id_halaman IN ($sb_mn->menu2)")->result();
                                          foreach ($sub_mn22 as $sm2) {
                                              if(strlen($sm2->judul)>=26){
                                                    $lg2 = "line-height: 1.2; margin-top:5px ;margin-bottom:10px";
                                                } else {
                                                    $lg2 = "";
                                                }
                                      ?>
                                      <li><a style="<?php echo $lg2 ?>" href="<?php echo site_url('page/hal/'.$sm2->page_seo) ?>"><?php echo $sm2->judul ?></a></li>
                                      <?php
                                          }
                                      ?>
                                </ul>
                              </li>
                              <?php
                                } else {
                              ?>
                              <li><a style="<?php echo $lg ?>" href="<?php echo site_url('page/hal/'.$sm->page_seo) ?>"><?php echo $sm->judul ?></a></li>
                              <?php
                                }
                              }
                               ?>
                            </ul>
                          </li>
                          <?php
                                }
                          }

                         // menu halaman statis

                          $qw_menuh = $this->db->query("SELECT * FROM cltr_menu WHERE id_kat_menu = 2 AND utama IS NULL")->result();
                          foreach ($qw_menuh as $qmh) {
                        ?>   
                                <li><a href="<?php echo $qmh->url ?>"><?php echo $qmh->nama_menu ?></a></li>
                        <?php                                
                            }
                         ?>
                      </ul>

                      <!-- Search Icon -->
                      <div id="searchIcon">
                          <i class="fa fa-search" aria-hidden="true"></i>
                      </div>

                  </div>
                  <!-- Navbar End -->
              </div>
          </nav>

          <!-- Search Form -->
          <div class="search-form">
              <form action="<?php echo site_url('berita/cari') ?>" method="post">
                  <input type="search" name="cari" id="search" placeholder="Type keywords &amp; press enter...">
                  <button type="submit" name="submit" class="d-none"></button>
              </form>
              <!-- Close Icon -->
              <div class="closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
          </div>

      </div>
    </div>
  </div>
</header>
<!-- ##### Header Area End ##### -->