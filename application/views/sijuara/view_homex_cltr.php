<?php if($jml_list_x_perjadin > 0){ ?>
<?php if($thn >= 2024){ ?>
<div id="modalkuy" class="modal fade" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Info !!</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <h5>Nama-nama yang belum membuat Laporan Perjalanan Dinas</h5>
  		<div class="table-responsive">
  		<table class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No SPT</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach($list_x_perjadin as $ls){
              ?>
              <tr>
                <td><?= $no ?></td>
                <td>
                    <?php
                    if($nama == $ls->nama) {
                        echo "<h5><span class='badge badge-warning'>".$ls->nama."</span></h5>";
                    } else {
                        echo $ls->nama;
                    }
                    ?>
                </td>
                <td><?= $ls->no_lengkap ?></td>
                <td><?= tgl_indoo($ls->tanggal) ?></td>
              </tr>
              <?php 
              $no++;
              }
              ?>
            </tbody>
          </table>
          </div>
            <div class="alert alert-danger">
                <strong>Catatan!</strong> Segera buat laporan perjalanan dinas dengan batas waktu 1 Minggu terhitung dari tanggal SPT.<br>
                Jika melewati dari batas yang ditentukan maka nama tersebut <strong>tidak akan muncul</strong> pada saat pembuatan SPT untuk waktu berikutnya.
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 
<?php } 
}
?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12" style="text-align:center;margin-bottom:10px"><img style="height:200px; width:auto" src="<?= base_url() ?>asset/gambar/bsip_tas_ic.png"></div>
            
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-header bg-secondary"><b>Verifikator</b></div>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-lg-3 col-md-3 col-6">
                          <div class="small-box bg-warning">
                              <div class="inner">
                                <h3><?= $jml_v1 ?></h3>
                                <p>SPT</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-ios-paper"></i>
                              </div>
                              <!--<a href="<?= base_url() ?>sijuara/verif_spt" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>-->
                              <a href="#" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                          <div class="small-box bg-warning">
                            <div class="inner">
                              <h3><?= $jml_v2 ?></h3>
                              <p>Cuti</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-ios-list"></i>
                            </div>
                            <!--<a href="<?= base_url() ?>sijuara/verif_surat" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>-->
                            <a href="#" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                          <div class="small-box bg-warning">
                            <div class="inner">
                              <h3><?= $jml_v4 ?></h3>
                              <p>Lap. Perjalanan Dinas</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-ios-paperplane"></i>
                            </div>
                            <!--<a href="<?= base_url() ?>sijuara/verif_lap_spt" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>-->
                            <a href="#" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                          <div class="small-box bg-warning">
                            <div class="inner">
                              <h3><?= $jml_v3 ?></h3>
                              <p>Disposisi Surat</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-share"></i>
                            </div>
                            <!--<a href="<?= base_url() ?>sijuara/disposisi" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>-->
                            <a href="#" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--- dashboard -->
            
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-header bg-secondary"><b>Dashboard</b></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-6">
                              <div class="small-box bg-success">
                                <div class="inner">
                                  <h3><?= $jml_surat_masuk ?></h3>
                                  <p>Surat Masuk</p>
                                </div>
                                <div class="icon">
                                  <i class="ion ion-email-unread"></i>
                                </div>
                                <a href="<?= base_url() ?>primer/buat_surat_masuk" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
                                <!--<a href="#" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>-->
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-6">
                              <div class="small-box bg-success">
                                <div class="inner">
                                  <h3><?= $jml_surat_keluar ?></h3>

                                  <p>Surat Keluar</p>
                                </div>
                                <div class="icon">
                                  <i class="ion ion-email"></i>
                                </div>
                                <a href="<?= base_url() ?>primer/buat_surat_keluar" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
                                <!--<a href="#" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>-->
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-6">
                              <div class="small-box bg-success">
                                <div class="inner">
                                  <h3><?= $jml_spt ?></h3>

                                  <p>Surat Perintah Tugas</p>
                                </div>
                                <div class="icon">
                                  <i class="ion ion-ios-briefcase"></i>
                                </div>
                                <a href="<?= base_url() ?>primer/daftar_spt" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
                                <!--<a href="#" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>-->
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-6">
                              <div class="small-box bg-success">
                                <div class="inner">
                                  <h3><?= $jml_perjadin ?></h3>

                                  <p>Lap. Perjalanan Dinas</p>
                                </div>
                                <div class="icon">
                                  <i class="ion ion-images"></i>
                                </div>
                                <a href="<?= base_url() ?>primer/buat_lap_spt" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
                                <!--<a href="#" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>-->
                              </div>
                            </div>
                            
                            <!-- part 2 -->
                            <div class="col-lg-3 col-md-3 col-6">
                              <div class="small-box bg-success">
                                <div class="inner">
                                  <h3><?= $jml_perjadin ?></h3>

                                  <p>Cuti</p>
                                </div>
                                <div class="icon">
                                  <i class="fa fa-toggle-off"></i>
                                </div>
                                <!--<a href="<?= base_url() ?>sijuara/buat_lap_spt" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>-->
                                <a href="#" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-6">
                              <div class="small-box bg-success">
                                <div class="inner">
                                  <h3><?= $jml_drive ?></h3>

                                  <p>Drive</p>
                                </div>
                                <div class="icon">
                                  <i class="fa fa-folder"></i>
                                </div>
                                <!--<a href="<?= base_url() ?>page/drive" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>-->
                                <a href="#" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-6">
                              <div class="small-box bg-success">
                                <div class="inner">
                                  <h3><?= $jml_drive ?></h3>

                                  <p>Daftar Tamu</p>
                                </div>
                                <div class="icon">
                                  <i class="fa fa-smile"></i>
                                </div>
                                <!--<a href="<?= base_url() ?>page/drive" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>-->
                                <a href="#" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-6">
                              <!-- small box -->
                              <div class="small-box bg-success">
                                <div class="inner">
                                  <h3>12</h3>
                                  <p>Log Aktivitas</p>
                                </div>
                                <div class="icon">
                                  <i class="ion ion-clipboard"></i>
                                </div>
                                <!--<a href="<?= base_url() ?>sijuara/logbook" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>-->
                                <a href="#" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
                              </div>
                            </div>
                            
                            <!-- part 3 -->
                            
                           
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-12" style="text-align:center;margin-bottom:10px"><a href="<?= base_url() ?>primer/logout" class="btn btn-danger btn-block"><i class="fa fa-power-off"></i> Logout</a></div>
        </div>
    </div>
</section>



    
<script>
$(document).ready(function(){
	$("#modalkuy").modal('show');
});
</script>