        <?php $users = $this->model_users->users_edit($this->session->username)->row_array(); ?>
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url(); ?>/asset/admin/dist/img/users.gif" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $users['nama_lengkap']; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header" style='color:#fff; text-transform:uppercase; border-bottom:2px solid #00c0ef'>MENU PENGGUNA</li>
            <li><a href="<?php echo base_url(); ?>admin/home"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <?php
                if ($this->session->level == 'admin'){
                    $main = $this->model_menu->mainmenu_admin_cltr();
                    foreach ($main->result_array() as $row) {
                      if ($this->model_menu->submenu_admin_cltr($row['id_main'])->num_rows() == 0){
                        echo "<li><a href='".base_url()."$row[link]'><i class='fa fa-reorder'></i> <span>$row[nama_menu]</span></a></li>";
                      }else{
                        echo "<li class='treeview'>
                                <a href='".base_url()."$row[link]'><i class='fa fa-reorder'></i> <span>$row[nama_menu]</span><i class='fa fa-angle-left pull-right'></i></a>
                                <ul class='treeview-menu'>";
                                    $sub = $this->model_menu->submenu_admin_cltr($row['id_main']);
                                    foreach ($sub->result_array() as $rows){
                                      echo "<li><a href='".base_url()."$rows[link_sub]'><i class='fa fa-circle-o'></i> $rows[nama_sub]</a></li>";
                                    }
                                echo "</ul>
                              </li>";
                      }
                    }
                }else{
                ?>
                <li><a href="<?php echo base_url(); ?>admin/berita/"><i class="fa fa-reorder"></i> <span>Post Berita</span></a></li>
                <?php
                }
            ?>
            <li><a href="<?php echo base_url(); ?>admin/edit_manajemenuser/<?php echo $this->session->username; ?>"><i class="fa fa-user"></i> <span>Edit Profile</span></a></li>
            <li><a href="<?php echo base_url(); ?>admin/logout"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>
          </ul>
        </section>