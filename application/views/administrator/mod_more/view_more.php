            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Semua Link</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>admin/tambah_more'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Website</th>
                        <th>URL</th>
                        <th style='width:50px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result() as $row){
                      if (!empty($row->utama)) {
                                                        $nm_menu = $this->db->query("SELECT * FROM cltr_page WHERE id_page = '$row->utama'")->row();
                                                        $urlx = site_url('berita/index/'.$nm_menu->page_seo);
                                                        $menux = $nm_menu->nm_menu;
                                                    } else {
                                                        $urlx = $row->url;
                                                        $menux = $row->nama_website;
                                                    }    
                    echo "<tr><td>$no</td>
                              <td>$menux</td>
                              <td>$urlx</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."admin/edit_more/$row->id_more'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."admin/delete_more/$row->id_more' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>