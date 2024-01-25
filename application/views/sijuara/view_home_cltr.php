<?php
// pj
$user1 = $this->session->username;
$get_usr = $this->db->query("select id_user,id_pj from sijuara_user where username = '$user1'")->row();
$get_lv = $this->db->query("select * from sijuara_level where id_user = '$get_usr->id_user'")->row();
$get_lv_a = $this->db->query("select * from sijuara_level where id_user = '$get_usr->id_user' and id_stakeholder in (1,2,3)")->row();
if($get_lv->id_stakeholder == '7'){
    $get_pg = $this->db->query("select sum(a.jumlah_biaya) as jlh from sijuara_subkomp a 
                                inner join sijuara_pumk b on a.id_subkomp=b.id_subkomp 
                                inner join sijuara_user c on b.id_pj=c.id_pj
                                where a.blokir != 1 and c.id_pj = '$get_usr->id_pj'")->row();
    $get_rl = $this->db->query("select sum(a.pengajuan_ini) as jlx_detil
                                from sijuara_simpan_pengajuan a
                                inner join sijuara_detil b on a.id_detil=b.id_detil
                                inner join sijuara_subkomp c on b.id_subkomp=c.id_subkomp
                                where a.username = '$user1' and a.status='cair'")->row();
    $persentase_pj = ($get_rl->jlx_detil / $get_pg->jlh) * 100;
    $url = "kegiatan_pumk";
} else {
    $get_pg = $this->db->query("select sum(jumlah_biaya) as jlh from sijuara_subkomp where blokir != 1 and id_pj = '$get_usr->id_pj'")->row();
    $get_rl = $this->db->query("select sum(a.pengajuan_ini) as jlx_detil
                                from sijuara_simpan_pengajuan a
                                inner join sijuara_detil b on a.id_detil=b.id_detil
                                inner join sijuara_subkomp c on b.id_subkomp=c.id_subkomp
                                where c.id_pj = '$get_usr->id_pj' and a.status='cair'")->row();
    $persentase_pj = ($get_rl->jlx_detil / $get_pg->jlh) * 100;
    $url = "kegiatan";
}

// all
$get_pgg = $this->db->query("select sum(jumlah_biaya) as jlh from sijuara_subkomp where blokir != 1")->row();
$get_rll = $this->db->query("select sum(pengajuan_ini) as jlx_detil from sijuara_simpan_pengajuan")->row();
$persentase_all = ($get_rll->jlx_detil / $get_pgg->jlh) * 100;

// akses persentase semua kegiatan
if($get_lv_a){
    $url_a = base_url()."sijuara/kegiatan_all";
} else {
    $url_a = "#";
}

?>
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= number_format($persentase_pj,1) ?><sup style="font-size: 20px">%</sup></h3>

                <p>Persentase Realisasi PJ Kegiatan</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url() ?>sijuara/<?= $url ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= number_format($persentase_all,1) ?><sup style="font-size: 20px">%</sup></h3>

                <p>Persentase Realisasi Semua Kegiatan</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?= $url_a ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            

            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary">
              <div class="card-header">
                <h3 class="card-title">List Antrian Pengajuan</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table style="width:100%;margin-top:20px" class='table table-bordered'>
                  <thead>
                    <tr>
                      <th style="width:2%; text-align:center; font-size:14px;">No</th>
                      <th style="width:28%; text-align:center; font-size:14px;">Kegiatan</th>
                      <th style="width:30%; text-align:center; font-size:14px;">Pengajuan</th>
                      <th style="width:20%; text-align:center; font-size:14px;">Tanggal</th>
                      <th style="width:20%; text-align:center; font-size:14px;">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      //$bulan = date('Y-m');
                      $bulan = date('Y');
                      $noa = 1;
                      $antri = $this->db->query("select distinct kode_tr from sijuara_simpan_pengajuan where tanggal_ajukan like '%$bulan%'")->result();
                      //$antri = $this->model_polling->antrian_pengajuan()->result();
                      foreach($antri as $an){
                          $subkomp = $this->db->query("select sum(a.pengajuan_ini) as jmlx,a.tanggal,a.status,d.subkomp
                                from sijuara_simpan_pengajuan a
                                inner join sijuara_subdetil b on a.id_subdetil = b.id_subdetil
                                inner join sijuara_detil c on b.id_detil = c.id_detil
                                inner join sijuara_subkomp d on c.id_subkomp = d.id_subkomp
                                where a.tanggal like '%$bulan%' and a.kode_tr = '$an->kode_tr'
                                order by a.id_pengajuan asc")->row();
                          if($subkomp->status == "cair"){
                              $bgt = "bg-success";
                              $sts = "Disetujui";
                          } else {
                              $bgt = "";
                              $sts = "Proses";
                          }
                      ?>
                      <tr class="<?php echo $bgt ?>">
                          <td><?php echo $noa ?></td>
                          <td><?php echo $subkomp->subkomp ?></td>
                          <td>Rp. <?php echo number_format($subkomp->jmlx) ?></td>
                          <td> <?php echo tgl_indoo($subkomp->tanggal) ?></td>
                          <td>Pengajuan <?php echo $sts ?></td>
                      </tr>
                      <?php
                      $noa++;
                      }
                      ?>
                  </tbody>
              </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                
              </div>
              <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->
          </section>
          <!-- /.Left col -->
          
    </section>
            