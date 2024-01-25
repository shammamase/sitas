<?php
    $thn = date('Y');
    //$thn = $this->session->thn_agr;
    $jml_v1 = $this->model_more->daftar_spt_kabalai()->num_rows();
    $jml_v2 = $this->model_more->daftar_surat_kabalai()->num_rows();
    $jml_v3 = $this->model_more->daftar_surat_masuk_kabalai()->num_rows();
    //$jml_v3 = 1;
    $jml_v4 = $this->model_more->daftar_lap_spt_kabalai()->num_rows();
    $jml_surat_masuk = $this->model_more->daftar_surat_masuk()->num_rows();
    $jml_surat_keluar = $this->model_more->daftar_surat_keluar()->num_rows();
    $jml_surat = $this->model_more->daftar_surat()->num_rows();
    $jml_spt = $this->model_more->daftar_spt()->num_rows();
    $jml_perjadin = $this->model_more->daftar_lap_spt2()->num_rows();
    $jml_anggaran = $this->db->query("select id_pengajuan from sijuara_simpan_pengajuan where tanggal like '%$thn%'")->num_rows();
    $jml_monev = $this->db->query("select id_monev from sijuara_monev where lap_bln like '%$thn%'")->num_rows();
?>
<!--
<div id="modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
  		<div class="row">
  		    <div class="col-6 col-lg-6 col-md-6 col-sm-6">
  		        <div class="small-box bg-primary">
                  <div class="inner">
                    <h3>2023</h3>
                  </div>
                  <div class="icon">
                    <i class="ion ion-calendar"></i>
                  </div>
                  <a href="<?= base_url() ?>sijuara/homex" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
                </div>
  		    </div>
  		    <div class="col-6 col-lg-6 col-md-6 col-sm-6">
  		        <div class="small-box bg-primary">
                  <div class="inner">
                    <h3>2022</h3>
                  </div>
                  <div class="icon">
                    <i class="ion ion-calendar"></i>
                  </div>
                  <a href="<?= base_url() ?>sijuara/homex/2022" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
                </div>
  		    </div>
  		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 
-->


<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <!-- ./col -->
          <div class="col-lg-12 col-12" style="text-align:center;margin-bottom:10px"><img style="height:200px; width:auto" src="<?= base_url() ?>asset/simantep_logo.png"></div>
          <!--<div class="col-lg-12 col-12" style="text-align:center;margin-bottom:10px"><a href="<?= base_url() ?>sijuara/homex" class="btn btn-dark btn-block"> Pilih Tahun</a></div>-->
          <div class="col-lg-3 col-md-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $jml_v1 ?></h3>
                <p>Verifikasi SPT</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-paper"></i>
              </div>
              <a href="<?= base_url() ?>sijuara/verif_spt" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $jml_v2 ?></h3>
                <p>Verifikasi Surat</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-list"></i>
              </div>
              <a href="<?= base_url() ?>sijuara/verif_surat" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $jml_v4 ?></h3>
                <p>Verifikasi Perjalanan Dinas</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-paperplane"></i>
              </div>
              <a href="<?= base_url() ?>sijuara/verif_lap_spt" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $jml_v3 ?></h3>
                <p>Disposisi Surat</p>
              </div>
              <div class="icon">
                <i class="ion ion-share"></i>
              </div>
              <a href="<?= base_url() ?>sijuara/disposisi" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          
          <div class="col-lg-3 col-md-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $jml_surat_masuk ?></h3>
                <p>Surat Masuk</p>
              </div>
              <div class="icon">
                <i class="ion ion-email-unread"></i>
              </div>
              <a href="<?= base_url() ?>sijuara/buat_surat_masuk/<?= $thn ?>" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-md-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $jml_surat_keluar ?></h3>

                <p>Surat Keluar</p>
              </div>
              <div class="icon">
                <i class="ion ion-email"></i>
              </div>
              <a href="<?= base_url() ?>sijuara/buat_surat_keluar/<?= $thn ?>" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?= $jml_surat ?></h3>

                <p>Buat Surat</p>
              </div>
              <div class="icon">
                <i class="ion ion-document-text"></i>
              </div>
              <a href="<?= base_url() ?>sijuara/buat_surat/<?= $thn ?>" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $jml_anggaran ?></h3>

                <p>Pengajuan Anggaran</p>
              </div>
              <div class="icon">
                <i class="ion ion-cash"></i>
              </div>
              <a href="<?= base_url() ?>sijuara/home" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?= $jml_spt ?></h3>

                <p>Surat Perintah Tugas</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-briefcase"></i>
              </div>
              <a href="<?= base_url() ?>sijuara/daftar_spt/<?= $thn ?>" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3><?= $jml_perjadin ?></h3>

                <p>Laporan Perjalanan Dinas</p>
              </div>
              <div class="icon">
                <i class="ion ion-images"></i>
              </div>
              <a href="<?= base_url() ?>sijuara/buat_lap_spt/<?= $thn ?>" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3><?= $jml_monev ?></h3>

                <p>Laporan Monev</p>
              </div>
              <div class="icon">
                <i class="ion ion-images"></i>
              </div>
              <a href="<?= base_url() ?>sijuara/buat_lap_monev/<?= $thn ?>" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-3 col-6">
            <!-- small box -->
            <div class="small-box">
              <div class="inner">
                <h3>12</h3>
                <p>Log Aktivitas</p>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
              <a href="<?= base_url() ?>sijuara/logbook/<?= $thn ?>" class="small-box-footer">Klik Disini <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-12 col-12" style="text-align:center;margin-bottom:10px"><a href="<?= base_url() ?>sijuara/logout" class="btn btn-danger btn-block"><i class="fa fa-power-off"></i> Logout</a></div>
        </div>
        <!-- /.row -->
    </section>
            