        <?php $users = $this->model_users->users_edit_sijuara($this->session->username)->row_array(); ?>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
        
            <a href="<?php echo site_url('sijuara/home') ?>" class="brand-link">
              <img src="<?php echo base_url(); ?>asset/lte31/dist/img/AdminLTELogo.png" alt="Sijuara Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
              <span class="brand-text font-weight-light">SIMANTEP</span>
            </a>
        
            <!-- Sidebar -->
            <div class="sidebar">
              <!-- Sidebar user panel (optional) -->
              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                  <img src="<?php echo base_url(); ?>/asset/admin/dist/img/users.gif" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                  <a href="#" class="d-block"><?php echo $users['nama']; ?></a>
                </div>
              </div>
        
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>sijuara/homex" class="nav-link">
                      <i class="fa fa-home"></i>
                      <p>
                        Menu Utama
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>sijuara/home" class="nav-link">
                      <i class="fas fa-tachometer-alt"></i>
                      <p>
                        Dashboard
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>sijuara/hpsx" class="nav-link">
                      <i class="fas fa-list"></i>
                      <p>
                        HPS
                      </p>
                    </a>
                  </li>
                  <?php
                        $qw_lev = $this->db->query("select b.id_stakholder,b.stakholder from sijuara_level a inner join sijuara_stakholder b on a.id_stakeholder=b.id_stakholder where a.id_user = '$users[id_user]' order by a.id_stakeholder desc");
                        foreach($qw_lev->result() as $lev){
                            if($lev->id_stakholder=='7'){
                                $awal = "";
                                $controller = "sijuara/kegiatan_pumk";
                                $nm = "Kegiatan";
                                 $viw = "";
                            } else if ($lev->id_stakholder=='6') {
                                $awal = "PJ";
                                $controller = "sijuara/kegiatan";
                                $nm = "Kegiatan";
                                 $viw = "";
                            } else if ($lev->id_stakholder=='8'){
                                $awal = "";
                                $controller = "#";
                                $nm = "Adm";
                                $viw = "none";
                            } else {
                                $awal = "Verif";
                                $controller = "sijuara/konfirmasi_kegiatan/$lev->id_stakholder";
                                $nm = $lev->stakholder;
                                $viw = "";
                            }
                    ?>
                    <li style="display:<?= $viw ?>" class="nav-item">
                        <a href="<?php echo base_url(); ?><?php echo $controller ?>" class="nav-link">
                          <i class="fa fa-list"></i>
                          <p>
                            <?php echo $awal." ".$nm ?>
                          </p>
                        </a>
                     </li>
                    <?php
                        }
                    ?>
                  <?php
                  $sd = $this->session->username;
                  $lev = $this->db->query("select username from sijuara_user where username = '$sd'")->row();
                  ?>
                  <?php if($lev->username=="samsuar"){ ?>
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>sijuara/pegawai" class="nav-link">
                      <i class="fa fa-list"></i>
                      <p>
                        Pegawai
                      </p>
                    </a>
                 </li>
                 <?php } ?>
                 <?php if($lev->username=="yusufantu"){ ?>
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>sijuara/monitor_pengajuan" class="nav-link">
                      <i class="fa fa-list"></i>
                      <p>
                        Monitor Pengajuan
                      </p>
                    </a>
                 </li>
                 <?php } ?>
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>sijuara/ganti_password" class="nav-link">
                      <i class="fa fa-key"></i>
                      <p>
                        Ganti Password
                      </p>
                    </a>
                 </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>sijuara/logout" class="nav-link">
                      <i class="fa fa-power-off"></i>
                      <p>
                        Logout
                      </p>
                    </a>
                  </li>
                </ul>
              </nav>
              <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
         </aside>