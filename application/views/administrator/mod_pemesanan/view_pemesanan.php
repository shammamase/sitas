            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Semua Pemesanan</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>admin/tambah_pemesanan'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Tgl</th>
                        <th>Nama Produk</th>
                        <th>Harga Satuan</th>
                        <th>Pemesan</th>
                        <th>No HP</th>
                        <th>Jumlah</th>
                        <th>Sub Total</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th style='width:50px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result() as $row){
                        $tot_hg = $row->jumlah * $row->harga_produk;
                        if($row->status==0){
                            $statusx = "Proses";
                            $textcss = "color:red;font-weight:bold";
                            $vw = "";
                        } else {
                            $statusx = "Selesai";
                            $textcss = "color:green;font-weight:bold";
                            $vw = "none";
                        }
                        $no_wa = substr_replace("$row->no_hp","62",0,1);
                    echo "<tr><td>$no</td>
                              <td>$row->tgl_pesanan</td>
                              <td>$row->nama_produk</td>
                              <td>$row->harga_produk</td>
                              <td>$row->nama</td>
                              <td>$row->no_hp</td>
                              <td style='text-align:center'>$row->jumlah</td>
                              <td>$tot_hg</td>
                              <td>$row->stok</td>
                              <td style='$textcss'>$statusx</td>
                              <td><center>
                                <a style='display:$vw' class='btn btn-success btn-xs' title='Konfirmasi' href='".base_url()."admin/konfirmasi_pemesanan/$row->id_pemesanan' onclick=\"return confirm('Apa anda yakin melakukan konfirmasi ?')\"><span class='fa fa-check'></span></a>
                                <a class='btn btn-success btn-xs' title='Hubungi Via WA' target='_blank' href='https://api.whatsapp.com/send?phone=$no_wa'><span class='fa fa-whatsapp'></span></a>
                                <a style='display:$vw' class='btn btn-primary btn-xs' title='Edit Data' href='".base_url()."admin/edit_pemesanan/$row->id_pemesanan'><span class='glyphicon glyphicon-edit'></span></a>
                                <a style='display:$vw' class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."admin/delete_pemesanan/$row->id_pemesanan' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>