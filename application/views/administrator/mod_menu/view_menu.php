            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Menu</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>admin/tambah_menu'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                      <tr>
                        <th style="width:3%">No</th>
                        <th style="width:10%">Kategori</th>
                        <th style="width:10%">Utama</th>
                        <th style="width:25%">Sekunder</th>
                        <th style="width:20%">Nama Menu</th>
                        <th style="width:2%">Icon</th>
                        <th style="width:12%">Url</th>
                        <th style="width:13%">Img</th>
                        <th style="width:5%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                      $pc_sc = explode(",", $row['sekunder']);
                      $jpc = count($pc_sc);
                    ?>  
                    <tr><td><?php echo $no ?></td>
                              <td><?php echo $row['kat_menu'] ?></td>
                              <td><?php echo $row['judul'] ?></td>
                              <td>
                              <?php 
                                for($d=0; $d<$jpc; $d++){
                                  $nm_sk = $this->model_halaman->page_edit2($pc_sc[$d])->row();
                                  if (empty($nm_sk)) {
                                  echo " ";
                                  } else {
                                ?>
                                <a href="#" class="edit-rec"  data-id="<?php echo $nm_sk->id_halaman."-".$row['id_kat_menu'] ?>">- <?php echo $nm_sk->judul ?></a><br>
                                <?php
                                }
                                }
                              ?>
                              </td>
                              <td><?php echo $row['nama_menu'] ?> </td>
                              <td><i class="<?php echo $row['icon'] ?>"></i></td>
                              <td><?php echo $row['url'] ?></td>
                              <td><img src="<?php echo base_url()."asset/foto_menu/".$row['gambar'] ?>" alt="" width="100px" height="auto"></td>
                              <td><center>
                                <a class="btn btn-success btn-xs" title="Edit Data" href="<?php echo base_url('admin/edit_menu/'.$row['id_menu']) ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                <a class="btn btn-danger btn-xs" title="Delete Data" href="<?php echo base_url('admin/delete_menu/'.$row['id_menu']) ?>" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')"><span class="glyphicon glyphicon-remove"></span></a>
                              </center></td>
                          </tr>
                    <?php
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>

                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Buat Menu</h4>
                            </div>
                            <div class="modal-body">
                            Klik sekali lagi pada menu yang di pilih !!!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

              <script>
                $(function(){
                  $(document).on('click','.edit-rec',function(e){
                    e.preventDefault();
                    $("#myModal").modal('show');
                    $.post('<?php echo site_url('admin/lihat_menu') ?>',
                      {idxy:$(this).attr('data-id')},
                      function(html){
                        $(".modal-body").html(html);
                      });
                  });
                });
              </script>