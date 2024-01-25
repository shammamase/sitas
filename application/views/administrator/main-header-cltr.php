<style type="text/css">
  .sekolah{
    float: left;
    background-color: transparent;
    background-image: none;
    padding: 15px 15px;
    font-family: fontAwesome;
    color:#fff;
  }

  .sekolah:hover{
    color:#fff;
  }
</style>
        <!-- Logo -->
        <a href="<?php echo site_url('admin/home') ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>LO</b>KO</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>BPTP Gorontalo</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i> Pesan Masuk
                  <span class="label label-success"><?php echo $this->model_hubungi->pesan_masuk_cltr()->num_rows(); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <?php echo $this->model_hubungi->pesan_masuk_cltr()->num_rows(); ?> new messages</li>
                  <li>
                    <ul class="menu">
                      <?php 
                        $pesan = $this->model_hubungi->pesan_baru_cltr(10);
                        foreach ($pesan->result_array() as $row) {
                          $isi_pesan = substr($row['pesan'],0,30);
                          $waktukirim = tgl_indo($row['tanggal']);
                          echo "<li>
                                  <a href='".base_url()."admin/detail_pesanmasuk/$row[id_hubungi]'>
                                    <div class='pull-left'>
                                      <img src='".base_url()."asset/admin/dist/img/users.gif' class='img-circle img-thumbnail' alt='User Image'>
                                    </div>
                                    <h4>$row[nama]<small><i class='fa fa-clock-o'></i> $waktukirim</small></h4>
                                    <p>$isi_pesan...</p>
                                  </a>
                                </li>";
                        }
                      ?>
                    </ul>
                  </li>
                  <li class="footer"><a href="<?php echo base_url() ?>/admin/pesanmasuk">See All Messages</a></li>
                </ul>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>admin/logout"><i class="glyphicon glyphicon-new-window"></i></a>
              </li>

            </ul>
          </div>
        </nav>