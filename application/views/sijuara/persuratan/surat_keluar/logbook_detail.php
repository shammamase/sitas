<?php
//verif pejabat
$get_nm = $this->db->query("select id_pejabat from sijuara_pejabat where id_bio = '$bio->id_bio'")->row();
if(!empty($get_nm->id_pejabat)){
$get_spt = $this->db->query("select * from sijuara_spt where tanggal_input like '%$waktu%' and pj_ttd = '$get_nm->id_pejabat'");
$get_bs = $this->db->query("select * from sijuara_buat_surat where tanggal_input like '%$waktu%' and pj_ttd = '$get_nm->id_pejabat'");
$get_sm = $this->db->query("select * from sijuara_surat_masuk where tanggal_input like '%$waktu%'");
$get_lspt = $this->db->query("select * from sijuara_lap_spt where tanggal_input like '%$waktu%' and pj_ttd = '$get_nm->id_pejabat'");
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
        if(!empty($get_nm->id_pejabat)){
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
            
            if($get_bs->num_rows() > 0){
            echo "<li><h5>Melakukan Verifikasi ".$get_bs->num_rows()." Pembuatan Surat</h5></li>";
            ?>
                    <table class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>  
                        <th>Hal</th>
                        <th>Kepada</th>
                        <th>Tanggal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $nokbs = 1;
                      foreach($get_bs->result() as $gbs) { 
                      ?>
                      <tr>
                        <td><?= $nokbs ?></td>
                        <td><?= $gbs->hal ?></td>
                        <td><?= $gbs->kepada ?></td>
                        <td><?= tgl_indo($gbs->tanggal) ?></td>
                      </tr>
                      <?php $nokbs++; } ?>
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
        
        // sijuara
            $get_idu = $this->db->query("select id_user from sijuara_user where username='$username'")->row();
            $get_sk = $this->db->query("select * from sijuara_level where id_user = '$get_idu->id_user'")->result();
            foreach($get_sk as $gs){
                if($gs->id_stakeholder==1){
                    // kabalai
                    $get_spj1 = $this->db->query("select a.*,b.subdetil,c.kd_detil,c.detil from sijuara_simpan_pengajuan a 
                                                inner join sijuara_subdetil b on a.id_subdetil=b.id_subdetil 
                                                inner join sijuara_detil c on b.id_detil=c.id_detil 
                                                where a.tanggal_ajukan like '%$waktu%' and a.ttd_kabalai = '$username'");
                    if($get_spj1->num_rows() > 0){
                    echo "<li><h5>Melakukan Verifikasi ".$get_spj1->num_rows()." Form Pengajuan Anggaran Sebagai Kepala Balai</h5></li>";
                     ?>
                    <table class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>  
                        <th>Akun</th>
                        <th>Detil</th>
                        <th>Sub Detil</th>
                        <th>Keperluan</th>
                        <th>Tanggal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $no1 = 1;
                      foreach($get_spj1->result() as $g1) { 
                      ?>
                      <tr>
                        <td><?= $no1 ?></td>
                        <td><?= $g1->kd_detil ?></td>
                        <td><?= $g1->detil ?></td>
                        <td><?= $g1->subdetil ?></td>
                        <td><?= $g1->keperluan ?></td>
                        <td><?= tgl_indo($g1->tanggal) ?></td>
                      </tr>
                      <?php $no1++; } ?>
                      </tbody>
                    </table>
                    <?php
                    }
                } else if($gs->id_stakeholder==2){
                    // program
                    $get_spj2 = $this->db->query("select a.*,b.subdetil,c.kd_detil,c.detil from sijuara_simpan_pengajuan a 
                                                inner join sijuara_subdetil b on a.id_subdetil=b.id_subdetil 
                                                inner join sijuara_detil c on b.id_detil=c.id_detil 
                                                where a.tanggal_ajukan like '%$waktu%' and a.ttd_program = '$username'");
                    if($get_spj2->num_rows() > 0){
                    echo "<li><h5>Melakukan Verifikasi ".$get_spj2->num_rows()." Form Pengajuan Anggaran Sebagai Sub Koordinator Program</h5></li>";
                     ?>
                    <table class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>  
                        <th>Akun</th>
                        <th>Detil</th>
                        <th>Sub Detil</th>
                        <th>Keperluan</th>
                        <th>Tanggal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $no2 = 1;
                      foreach($get_spj2->result() as $g2) { 
                      ?>
                      <tr>
                        <td><?= $no2 ?></td>
                        <td><?= $g2->kd_detil ?></td>
                        <td><?= $g2->detil ?></td>
                        <td><?= $g2->subdetil ?></td>
                        <td><?= $g2->keperluan ?></td>
                        <td><?= tgl_indo($g2->tanggal) ?></td>
                      </tr>
                      <?php $no2++; } ?>
                      </tbody>
                    </table>
                    <?php
                    }
                } else if($gs->id_stakeholder==3){
                    //ppk
                    $get_spj3 = $this->db->query("select a.*,b.subdetil,c.kd_detil,c.detil from sijuara_simpan_pengajuan a 
                                                inner join sijuara_subdetil b on a.id_subdetil=b.id_subdetil 
                                                inner join sijuara_detil c on b.id_detil=c.id_detil 
                                                where a.tanggal_ajukan like '%$waktu%' and a.ttd_ppk = '$username'");
                    if($get_spj3->num_rows() > 0){
                    echo "<li><h5>Melakukan Verifikasi ".$get_spj3->num_rows()." Form Pengajuan Anggaran Sebagai PPK</h5></li>";
                     ?>
                    <table class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>  
                        <th>Akun</th>
                        <th>Detil</th>
                        <th>Sub Detil</th>
                        <th>Keperluan</th>
                        <th>Tanggal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $no3 = 1;
                      foreach($get_spj3->result() as $g3) { 
                      ?>
                      <tr>
                        <td><?= $no3 ?></td>
                        <td><?= $g3->kd_detil ?></td>
                        <td><?= $g3->detil ?></td>
                        <td><?= $g3->subdetil ?></td>
                        <td><?= $g3->keperluan ?></td>
                        <td><?= tgl_indo($g3->tanggal) ?></td>
                      </tr>
                      <?php $no3++; } ?>
                      </tbody>
                    </table>
                    <?php
                    }
                } else if($gs->id_stakeholder==6){
                    // pj kegiatan
                    $get_spj4 = $this->db->query("select a.*,b.subdetil,c.kd_detil,c.detil from sijuara_simpan_pengajuan a 
                                                inner join sijuara_subdetil b on a.id_subdetil=b.id_subdetil 
                                                inner join sijuara_detil c on b.id_detil=c.id_detil 
                                                where a.tanggal_ajukan like '%$waktu%' and a.ttd_pj = '$username'");
                    if($get_spj4->num_rows() > 0){
                    echo "<li><h5>Melakukan Verifikasi ".$get_spj4->num_rows()." Form Pengajuan Anggaran Sebagai Penanggung Jawab Kegiatan</h5></li>";
                    ?>
                    <table class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>  
                        <th>Akun</th>
                        <th>Detil</th>
                        <th>Sub Detil</th>
                        <th>Keperluan</th>
                        <th>Tanggal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $no4 = 1;
                      foreach($get_spj4->result() as $g4) { 
                      ?>
                      <tr>
                        <td><?= $no4 ?></td>
                        <td><?= $g4->kd_detil ?></td>
                        <td><?= $g4->detil ?></td>
                        <td><?= $g4->subdetil ?></td>
                        <td><?= $g4->keperluan ?></td>
                        <td><?= tgl_indo($g4->tanggal) ?></td>
                      </tr>
                      <?php $no4++; } ?>
                      </tbody>
                    </table>
                    <?php
                    }
                } else if($gs->id_stakeholder==7){
                    // pumk
                    $get_spj5 = $this->db->query("select a.*,b.subdetil,c.kd_detil,c.detil from sijuara_simpan_pengajuan a 
                                                inner join sijuara_subdetil b on a.id_subdetil=b.id_subdetil 
                                                inner join sijuara_detil c on b.id_detil=c.id_detil 
                                                where a.tanggal_ajukan like '%$waktu%' and a.username = '$username'");
                    if($get_spj5->num_rows() > 0){
                    echo "<li><h5>Membuat ".$get_spj5->num_rows()." Form Rincian Pengajuan Anggaran</h5></li>";
                     ?>
                    <table class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>  
                        <th>Akun</th>
                        <th>Detil</th>
                        <th>Sub Detil</th>
                        <th>Keperluan</th>
                        <th>Tanggal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $no5 = 1;
                      foreach($get_spj5->result() as $g5) { 
                      ?>
                      <tr>
                        <td><?= $no5 ?></td>
                        <td><?= $g5->kd_detil ?></td>
                        <td><?= $g5->detil ?></td>
                        <td><?= $g5->subdetil ?></td>
                        <td><?= $g5->keperluan ?></td>
                        <td><?= tgl_indo($g5->tanggal) ?></td>
                      </tr>
                      <?php $no5++; } ?>
                      </tbody>
                    </table>
                    <?php
                    }
                }
            }
            
        // pelaku spt
        $bio_pj = $this->db->query("select a.* from t_biodata a 
                                    inner join sijuara_pj b on a.id_bio=b.id_bio 
                                    inner join sijuara_user c on b.id_pj=c.id_pj
                                    where c.username = '$username'
                                    ")->row();
        $plk_spt = $this->db->query("select a.*, b.menimbang, b.untuk, b.lama_hari, b.tanggal from sijuara_pelaku_spt a 
                                     inner join sijuara_spt b on a.id_spt=b.id_spt 
                                     inner join ms_peg c on a.id_peg=c.id_peg
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
        
        //buat surat
        $user_bs = $this->db->query("select * from sijuara_buat_surat where user = '$username' and tanggal like '%$waktu%'");
        if($user_bs->num_rows() > 0){
            echo "<li><h5>Membuat ".$user_bs->num_rows()." Surat/Balasan Surat Masuk</h5></li>"; 
             ?>
                    <table class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>  
                        <th>Hal</th>
                        <th>Untuk</th>
                        <th>Tanggal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $nobs = 1;
                      foreach($user_bs->result() as $ubs) { 
                      ?>
                      <tr>
                        <td><?= $nobs ?></td>
                        <td><?= $ubs->hal ?></td>
                        <td><?= $ubs->kepada ?></td>
                        <td><?= tgl_indo($ubs->tanggal) ?></td>
                      </tr>
                      <?php $nobs++; } ?>
                      </tbody>
                    </table>
                    <?php
        }
        
        // lap perjalanan dinas
        $user_lspt = $this->db->query("select * from sijuara_lap_spt where user = '$username' and tanggal_input like '%$waktu%'");
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
        $adm_sm = $this->db->query("select * from sijuara_surat_masuk where user = '$username' and tanggal like '%$waktu%'");
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
        $adm_sk = $this->db->query("select * from sijuara_surat_keluar where user = '$username' and tanggal_input like '%$waktu%'");
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
        $adm_spt = $this->db->query("select * from sijuara_spt where user = '$username' and tanggal_input like '%$waktu%'");
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
        $get_tamu = $this->db->query("select * from cltr_buku_tamu where no_hp2 = '$bio_pj->no_hp' and waktu like '%$waktu%'");
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
        
        //publikasi
        $cltr_page = $this->db->query("select * from cltr_page");
        foreach($cltr_page->result() as $clp){
            $qw_pub = $this->db->query("select a.* from cltr_post a 
                                        inner join cltr_page b on a.id_page = b.id_page
                                        inner join users c on a.username = c.username
                                        where a.id_page = '$clp->id_page' and c.user = '$username' and tanggal like '%$waktu%'");
            if($qw_pub->num_rows() > 0){
                echo "<li><h5>Membuat ".$qw_pub->num_rows()." Post ".$clp->page." di Website BPTP Gorontalo</h5></li>";
                ?>
                    <table class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>  
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Gambar</th>
                        <th>Link</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $nopub = 1;
                      foreach($qw_pub->result() as $qp) { 
                      ?>
                      <tr>
                        <td><?= $nopub ?></td>
                        <td><?= $qp->judul ?></td>
                        <td><?= tgl_indo($qp->tanggal) ?></td>
                        <td>
                            <img style="height:150px;width:auto" src="<?= base_url() ?>asset/foto_content/<?= $qp->gambar ?>">
                        </td>
                        <td><a href="<?= base_url() ?>berita/detail/<?= $qp->judul_seo ?>" target="_blank"> <?= base_url() ?>berita/detail/<?= $qp->judul_seo ?> </a></td>
                      </tr>
                      <?php $nopub++; } ?>
                      </tbody>
                    </table>
                    <?php
            }
        }
        ?>
    </ul>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card --> 