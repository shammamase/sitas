            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $komp ?></h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>admin/tambah_plugin/<?php echo $uri3 ?>'>Tambahkan <?php echo $komp ?></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Page</th>
                        <?php 
                            foreach ($proper->result() as $pro) {
                              if ($pro->id_komp==4 AND $pro->properti=="gambar") {
                                 $propert = "Audio";
                              } else {
                                $propert = $pro->properti;
                              }
                        ?><th><?php echo $propert ?></th><?php
                            }
                         ?>
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $qw_plug = $this->db->query("SELECT a.*, b.*, c.* FROM cltr_plugin a LEFT JOIN cltr_properti b ON a.id_properti=b.id_properti LEFT JOIN cltr_komp c ON b.id_komp=c.id_komp WHERE c.id_komp =  '$id_komp'");
                          $jm_plug = $qw_plug->num_rows();
                          $tr = $proper->num_rows();
                          $dt_id = array();
                          $dt_ps = array();
                          $dt_hl = array();
                          $dt_pl = array();
                          $dt_pr = array();
                          $dt_km = array();
                          $dp = 1;
                          foreach ($qw_plug->result() as $plg) {
                            $dt_id[$dp] = $plg->id_plugin;
                            $dt_ps[$dp] = $plg->id_post;
                            $dt_hl[$dp] = $plg->id_halaman;
                            $dt_pl[$dp] = $plg->plugin;
                            $dt_pr[$dp] = $plg->tipe;
                            $dt_km[$dp] = $plg->komp;
                            $dp++;
                          }
                          $no = 0;
                          for($p=0; $p<$jm_plug; $p+=$tr){
                            $no++;
                          ?>
                          <tr>
                            <td><?php echo $no ?></td>
                            <td>
                              <?php 
                                if ($dt_ps[$p+1]!=0) {
                                  $qw_post = $this->model_berita->berita_row($dt_ps[$p+1]);
                                  echo $qw_post->judul;
                                }
                                if ($dt_hl[$p+1]!=0) {
                                  $qw_hal = $this->model_halaman->halamanstatis_edit($dt_hl[$p+1])->row();
                                  echo $qw_hal->judul;
                                }
                              ?>
                            </td>
                            <?php 
                              for($pp=1; $pp<=$tr; $pp++){
                              ?>
                                <td>
                                  <?php 
                                    if ($dt_pr[$pp+$p]=="file") {
                                      if ($dt_km[$pp+$p]=="Audio") {
                                  ?>
                                  <a href="<?php echo base_url() ?>asset/file_lainnya/<?php echo $dt_pl[$pp+$p] ?>" target="_blank"><?php echo $dt_pl[$pp+$p] ?></a>
                                  <?php
                                      } else {
                                  ?>
                                  <a href="<?php echo base_url() ?>asset/file_lainnya/<?php echo $dt_pl[$pp+$p] ?>" target="_blank"><img src="<?php echo base_url() ?>asset/file_lainnya/<?php echo $dt_pl[$pp+$p] ?>" width="150" height="100"></a>
                                  <?php
                                      }
                                    } else {
                                      echo $dt_pl[$pp+$p];
                                    }
                                  ?>
                                </td>
                              <?php 
                              }
                             ?>
                             <td>
                             <center>
                                <!--<a class='btn btn-success btn-xs' title='Edit Data' href="<?php echo base_url() ?>admin/edit_plugin/<?php echo $uri3 ?>/<?php $ta = ""; for($pps=1; $pps<=$tr; $pps++){ $ta.= $dt_id[$pps+$p]."-"; } $ta = substr($ta,0,strlen($ta)-1); echo $ta ?>"><span class='glyphicon glyphicon-edit'></span></a>-->
                                <a class='btn btn-danger btn-xs' title='Delete Data' href="<?php echo base_url() ?>admin/delete_plugin/<?php echo $uri3 ?>/<?php $tas = ""; for($ppr=1; $ppr<=$tr; $ppr++){ $tas.= $dt_id[$ppr+$p]."-"; } $tas = substr($tas,0,strlen($tas)-1); echo $tas ?>" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')"><span class='glyphicon glyphicon-remove'></span></a>
                              </center>
                            </td>
                          </tr>
                          <?php
                          }
                       ?>
                   </tbody>
                </table>
              </div>