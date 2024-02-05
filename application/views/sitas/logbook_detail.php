<?php
//verif pejabat
$get_nm = $this->db->query("select id_pegawai from struktur_organisasi where id_pegawai = '$bio->id_pegawai'")->row();
if(!empty($get_nm->id_pegawai)){
$get_spt = $this->db->query("select * from spt where tanggal_input like '%$waktu%' and pj_ttd = '$get_nm->id_pejabat'");
//$get_bs = $this->db->query("select * from sijuara_buat_surat where tanggal_input like '%$waktu%' and pj_ttd = '$get_nm->id_pejabat'");
$get_sm = $this->db->query("select * from surat_masuk where tanggal_input like '%$waktu%'");
$get_lspt = $this->db->query("select * from lap_spt where tanggal_input like '%$waktu%' and pj_ttd = '$get_nm->id_pejabat'");
}
?>
<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Logbook <?= $bio->nama ?> Periode <?= tgl_indoo($waktu) ?></h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <ul>
        <?php
        if(!empty($get_nm->id_pegawai)){
            if($get_spt->num_rows() > 0){
            echo "<li><h5>Melakukan Verifikasi ".$get_spt->num_rows()." Surat Perintah Tugas</h5></li>";
            ?>
                    <table class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>  
                        <th>Menimbang</th>
                        <th>Untuk</th>
                        <th>Tanggal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $noksp = 1;
                      foreach($get_spt->result() as $gsp) { 
                      ?>
                      <tr>
                        <td><?= $noksp ?></td>
                        <td><?= $gsp->menimbang ?></td>
                        <td><?= $gsp->untuk ?></td>
                        <td><?= tgl_indo($gsp->tanggal) ?></td>
                      </tr>
                      <?php $noksp++; } ?>
                      </tbody>
                    </table>
                    <?php
            }
           
            if($get_lspt->num_rows() > 0){
            echo "<li><h5>Melakukan Verifikasi ".$get_lspt->num_rows()." Laporan Perjalanan Dinas</h5></li>";
            ?>
                    <table class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>  
                        <th>Kegiatan</th>
                        <th>Lokasi</th>
                        <th>Tanggal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $noklsp = 1;
                      foreach($get_lspt->result() as $gls) { 
                          $tglsp = substr($gls->tanggal_input,0,10);
                      ?>
                      <tr>
                        <td><?= $noklsp ?></td>
                        <td><?= $gls->tolak_ukur_kegiatan ?></td>
                        <td><?= $gls->lokasi ?></td>
                        <td><?= tgl_indo($tglsp) ?></td>
                      </tr>
                      <?php $noklsp++; } ?>
                      </tbody>
                    </table>
                    <?php
            }
            
            if($get_nm->id_pejabat==1){
                if($get_sm->num_rows() > 0){
                echo "<li><h5>Melakukan Disposisi ".$get_sm->num_rows()." Surat Masuk</h5></li>";
                ?>
                    <table class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>  
                        <th>Asal</th>
                        <th>Perihal</th>
                        <th>Tanggal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $noksm = 1;
                      foreach($get_sm->result() as $gsm) { 
                      ?>
                      <tr>
                        <td><?= $noksm ?></td>
                        <td><?= $gsm->asal_surat ?></td>
                        <td><?= $gsm->perihal ?></td>
                        <td><?= tgl_indo($gsm->tanggal) ?></td>
                      </tr>
                      <?php $noksm++; } ?>
                      </tbody>
                    </table>
                    <?php
                }
            }
        }
        
        // pelaku spt
        $bio_pj = $this->db->query("select a.* from pegawai a 
                                    inner join user b on a.id_pegawai=b.id_pegawai
                                    where b.username = '$username'
                                    ")->row();
        $plk_spt = $this->db->query("select a.*, b.menimbang, b.untuk, b.lama_hari, b.tanggal from anggota_spt a 
                                     inner join spt b on a.id_spt=b.id_spt 
                                     inner join peserta_spt c on a.id_pegawai=c.id_pegawai
                                     where c.nama like '%$bio_pj->nama%' and b.tanggal like '%$waktu%'");
        if($plk_spt->num_rows() > 0){
           echo "<li><h5>Melakukan ".$plk_spt->num_rows()." Perjalanan Dinas</h5></li>"; 
            ?>
                    <table class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>  
                        <th>Dasar</th>
                        <th>Untuk</th>
                        <th>Lama Hari</th>
                        <th>Tanggal Jalan</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $nospt = 1;
                      foreach($plk_spt->result() as $pspt) { 
                      ?>
                      <tr>
                        <td><?= $nospt ?></td>
                        <td><?= $pspt->menimbang ?></td>
                        <td><?= $pspt->untuk ?></td>
                        <td><?= $pspt->lama_hari ?></td>
                        <td><?= tgl_indo($pspt->tanggal) ?></td>
                      </tr>
                      <?php $nospt++; } ?>
                      </tbody>
                    </table>
                    <?php
        }
        
        // lap perjalanan dinas
        $user_lspt = $this->db->query("select * from lap_spt where user = '$username' and tanggal_input like '%$waktu%'");
        if($user_lspt->num_rows() > 0){
            echo "<li><h5>Membuat ".$user_lspt->num_rows()." Laporan Perjalanan Dinas</h5></li>"; 
             ?>
                    <table class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>  
                        <th>Kegiatan</th>
                        <th>Lokasi</th>
                        <th>Gambar</th>
                        <th>Tanggal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $nolsp = 1;
                      foreach($user_lspt->result() as $uls) { 
                          $tgl = substr($uls->tanggal_input,0,10);
                          $pc_dok = explode(",",$uls->gbr_dok);
                      ?>
                      <tr>
                        <td><?= $nolsp ?></td>
                        <td><?= $uls->tolak_ukur_kegiatan ?></td>
                        <td><?= $uls->lokasi ?></td>
                        <td>
                            <?php
                            foreach($pc_dok as $dok){
                            ?>
                            <img style="height:100px;width:auto" src="<?= base_url() ?>asset/file_lainnya/lap_spt/<?= $dok ?>">
                            <?php
                            }
                            ?>
                        </td>
                        <td><?= tgl_indo($tgl) ?></td>
                      </tr>
                      <?php $nolsp++; } ?>
                      </tbody>
                    </table>
                    <?php
        }
        
        // administrasi 
        $adm_sm = $this->db->query("select * from surat_masuk where user = '$username' and tanggal like '%$waktu%'");
        if($adm_sm->num_rows() > 0){
            echo "<li><h5>Membuat ".$adm_sm->num_rows()." Surat Masuk</h5></li>";
            ?>
                    <table class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>  
                        <th>No Surat</th>
                        <th>Asal</th>
                        <th>Perihal</th>
                        <th>Tanggal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $nosm = 1;
                      foreach($adm_sm->result() as $asm) { 
                      ?>
                      <tr>
                        <td><?= $nosm ?></td>
                        <td><?= $asm->no_surat_masuk ?></td>
                        <td><?= $asm->asal_surat ?></td>
                        <td><?= $asm->perihal ?></td>
                        <td><?= tgl_indo($asm->tanggal) ?></td>
                      </tr>
                      <?php $nosm++; } ?>
                      </tbody>
                    </table>
                    <?php
        }
        $adm_sk = $this->db->query("select * from surat_keluar where user = '$username' and tanggal_input like '%$waktu%'");
        if($adm_sk->num_rows() > 0){
            echo "<li><h5>Membuat ".$adm_sk->num_rows()." surat keluar serta nomor surat</h5></li>"; 
            ?>
                    <table class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>  
                        <th>Tujuan</th>
                        <th>Perihal</th>
                        <th>No Surat</th>
                        <th>Tanggal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $nosk = 1;
                      foreach($adm_sk->result() as $ask) { 
                      ?>
                      <tr>
                        <td><?= $nosk ?></td>
                        <td><?= $ask->tujuan_surat ?></td>
                        <td><?= $ask->perihal ?></td>
                        <td><?= $ask->no_surat_keluar ?></td>
                        <td><?= tgl_indo($ask->tanggal) ?></td>
                      </tr>
                      <?php $nosk++; } ?>
                      </tbody>
                    </table>
                    <?php
        }
        $adm_spt = $this->db->query("select * from spt where user = '$username' and tanggal_input like '%$waktu%'");
        if($adm_spt->num_rows() > 0){
            echo "<li><h5>Membuat ".$adm_spt->num_rows()." Surat Perintah Tugas</h5></li>";
            ?>
                    <table class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>  
                        <th>Menimbang</th>
                        <th>Untuk</th>
                        <th>Tanggal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $noasp = 1;
                      foreach($adm_spt->result() as $asp) { 
                      ?>
                      <tr>
                        <td><?= $noasp ?></td>
                        <td><?= $asp->menimbang ?></td>
                        <td><?= $asp->untuk ?></td>
                        <td><?= tgl_indo($asp->tanggal) ?></td>
                      </tr>
                      <?php $noasp++; } ?>
                      </tbody>
                    </table>
                    <?php
            
        }
        
        // kunjungan tamu
        $get_tamu = $this->db->query("select * from buku_tamu where no_hp2 = '$bio_pj->no_hp' and waktu like '%$waktu%'");
        if($get_tamu->num_rows() > 0){
            echo "<li><h5>Menerima ".$get_tamu->num_rows()." Kunjungan Tamu</h5></li>";
            ?>
                    <table class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>  
                        <th>Nama Tamu</th>
                        <th>Asal Instansi</th>
                        <th>Maksud/Tujuan</th>
                        <th>Kesan/Pesan</th>
                        <th>Tanggal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $notm = 1;
                      foreach($get_tamu->result() as $gtm) { 
                          $tgl_tm = substr($gtm->waktu,0,10);
                      ?>
                      <tr>
                        <td><?= $notm ?></td>
                        <td><?= $gtm->nama ?></td>
                        <td><?= $gtm->asal_instansi ?></td>
                        <td><?= $gtm->maksud_tujuan ?></td>
                        <td><?= $gtm->pesan_kesan ?></td>
                        <td><?= tgl_indo($tgl_tm) ?></td>
                      </tr>
                      <?php $notm++; } ?>
                      </tbody>
                    </table>
                    <?php
        }
        ?>
    </ul>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card --> 