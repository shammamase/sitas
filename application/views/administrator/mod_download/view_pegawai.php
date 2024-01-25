            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Perjanjian Kinerja Individu</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_pegawai'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama Pegawai</th>
                        <th>Jabatan</th>
                        <th>Atasan Langsung</th>
                        <th>File</th>
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $tgl_Posting = tgl_indo($row['tgl_posting']);
                    echo "<tr><td>$no</td>
                              <td>$row[nama_pegawai]</td>
                              <td>$row[jabatan]</td>
                              <td>$row[atasan_langsung]</td>";
                              if(trim($row['nama_file'])=='') {
                                echo "<td><a title='$row[nama_file]' target='_BLANK' href='$row[gdrive]'>Download File</a></td>";
                              }else{
                                echo "<td><a title='$row[nama_file]' target='_BLANK' href='".base_url()."pegawai/file/$row[nama_file]'>Download File</a></td>";
                              }
                              
                              echo "<td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."administrator/edit_pegawai/$row[id_pegawai]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_pegawai/$row[id_pegawai]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>