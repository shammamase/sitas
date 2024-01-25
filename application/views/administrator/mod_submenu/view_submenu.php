            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Sub Menu</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_submenu'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Sub Menu</th>
                        <th>Menu Utama</th>
                        <th>Link Submenu</th>
                        <th>Aktif</th>
                        <th>Admin Submenu</th>
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    echo "<tr><td>$no</td>
                              <td>$row[nama_sub]</td>
                              <td>$row[nama_menu]</td>
                              <td><a target='_BLANK' href='".base_url()."$row[link_sub]'>$row[link_sub]</a></td>
                              <td>$row[aktif]</td>
                              <td>$row[adminsubmenu]</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."administrator/edit_submenu/$row[id_sub]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_submenu/$row[id_sub]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>