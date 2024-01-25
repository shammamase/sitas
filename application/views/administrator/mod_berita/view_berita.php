            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Semua Berita</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>admin/tambah_berita'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Judul Berita</th>
                        <th>Kategori</th>
                        <th>Dibaca</th>
                        <th>Tgl Posting</th>
                        <th style='width:100px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $tgl_posting = tgl_indo($row['tanggal']);
                    if ($row['id_page']=='0'){
                      $kategori = '<i style="color:red">Pending</i>';
                    }else{
                      $kategori = $row['page'];
                    }
                    
                    if($row['acc']==1){
                        $pub = "Published";
                    } else {
                        $pub = "Unpublish";
                    }
                    
                    echo "<tr><td>$no</td>
                              <td>$row[judul] - <b>$row[username]</b></td>
                              <td>$kategori</td>
                              <td>$row[dibaca] Kali</td>
                              <td>$tgl_posting - $pub</td>
                              <td><center>
                                <a class='btn btn-warning btn-xs' title='Unpublish' href='".base_url()."admin/off_berita/$row[id_post]' onclick=\"return confirm('Apa anda yakin untuk menonaktifkan berita ini?')\"><span class='glyphicon glyphicon-off'></span></a>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."admin/edit_berita/$row[id_post]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Hapus Data' href='".base_url()."admin/delete_berita/$row[id_post]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>