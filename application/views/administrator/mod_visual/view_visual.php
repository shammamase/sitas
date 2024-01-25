            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Semua Visual</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>admin/tambah_visual'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Judul Konten</th>
                        <th>Kategori</th>
                        <th>Dibaca</th>
                        <th>Tgl Posting</th>
                        <th style='width:50px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $tgl_posting = tgl_indo($row['tanggal']);
                    if ($row['id_kat_visual']=='0'){
                      $kategori = '<i style="color:red">Pending</i>';
                    }else{
                      $kategori = $row['nama_kat_visual'];
                    }
                    echo "<tr><td>$no</td>
                              <td>$row[judul]</td>
                              <td>$kategori</td>
                              <td>$row[dibaca] Kali</td>
                              <td>$tgl_posting</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."admin/edit_visual/$row[id_visual]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."admin/delete_visual/$row[id_visual]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>