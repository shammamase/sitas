<?php 
$jml_verif_surat = count($verif_surat);
$jml_verif_cuti = count($verif_cuti);
$jml_verif_surat1 = count($verif_surat1);
$jml_verif_cuti1 = count($verif_cuti1);
$jml_verif_lap_perjadin = count($verif_lap_perjadin);
$jml_disposisi_surat = count($disposisi_surat);
$jml_tamu = count($tamu);
$jml_surat_masuk = count($surat_masuk);
$jml_surat_keluar = count($surat_keluar);
?>
<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Logbook <?= $bio->nama ?> Periode <?= tgl_indoo($waktu) ?></h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <?php if($jml_disposisi_surat > 0){ ?>
    <span class="badge badge-success" style="font-size:14px">Melakukan Disposisi <?= $jml_disposisi_surat ?> Surat Masuk</span>
    <br><br>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>  
                    <th>Perihal</th>
                    <th>Asal Surat</th>
                    <th>Disposisi</th>
                    <th>Diteruskan</th>
                    <th>Isi Disposisi</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no_sm = 1;foreach($disposisi_surat as $ds){ ?>
                <tr>
                    <td><?= $no_sm ?></td>
                    <td><?= $ds->perihal ?></td>
                    <td><?= $ds->asal_surat ?></td>
                    <td><?= $ds->disposisi ?></td>
                    <td><?= $ds->diteruskan ?></td>
                    <td><?= $ds->isi_disposisi ?></td>
                    <td><?= tgl_indoo($ds->tanggal_masuk) ?></td>
                </tr>
                <?php $no_sm++; } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
    <?php if($jml_verif_surat > 0){ ?>
    <span class="badge badge-success" style="font-size:14px">Melakukan Verifikasi <?= $jml_verif_surat ?> Surat Keluar</span>
    <br><br>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>  
                    <th>Nomor</th>
                    <th>Tujuan Surat</th>
                    <th>Perihal</th>
                    <th>Tanggal</th>
                    <th>Sifat</th>
                </tr>
            </thead>
            <tbody>
                <?php $no_vs = 1;foreach($verif_surat as $vs){ $pc_tgl = explode("-",$vs->tanggal)?>
                <tr>
                    <td><?= $no_vs ?></td>
                    <td>B-<?= $vs->no_surat_keluar ?>/<?= $vs->kode_sub_arsip ?>/H.4.2/<?= $pc_tgl[1] ?>/<?= $pc_tgl[0] ?></td>
                    <td><?= $vs->tujuan_surat ?></td>
                    <td><?= $vs->perihal ?></td>
                    <td><?= tgl_indoo($vs->tanggal) ?></td>
                    <td><?= $vs->sifat ?></td>
                </tr>
                <?php $no_vs++; } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
    <?php if($jml_verif_cuti > 0){ ?>
    <span class="badge badge-success" style="font-size:14px">Melakukan Verifikasi <?= $jml_verif_cuti ?> Pengajuan Cuti</span>
    <br><br>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>  
                    <th>Pemohon</th>
                    <th>Jenis Cuti</th>
                    <th>Alasan</th>
                    <th>Tanggal</th>
                    <th>Lama Cuti</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no_vc = 1;foreach($verif_cuti as $vc){ ?>
                <tr>
                    <td><?= $no_vc ?></td>
                    <td><?= $vc->nama ?></td>
                    <td><?= $vc->jenis_cuti ?></td>
                    <td><?= $vc->alasan_cuti ?></td>
                    <td><?= tgl_indoo($vc->tgl_mulai) ?></td>
                    <td><?= $vc->lama_cuti ?> Hari</td>
                    <td><?= $vc->verif ?></td>
                </tr>
                <?php $no_vc++; } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
    <?php if($jml_verif_surat1){ ?>
    <span class="badge badge-success" style="font-size:14px">Melakukan Verifikasi Awal <?= $jml_verif_surat1 ?> Surat Keluar</span>
    <br><br>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>  
                    <th>Nomor</th>
                    <th>Tujuan Surat</th>
                    <th>Perihal</th>
                    <th>Tanggal</th>
                    <th>Sifat</th>
                </tr>
            </thead>
            <tbody>
                <?php $no_vs1 = 1;foreach($verif_surat1 as $vs1){ $pc_tgl1 = explode("-",$vs1->tanggal)?>
                <tr>
                    <td><?= $no_vs1 ?></td>
                    <td>B-<?= $vs1->no_surat_keluar ?>/<?= $vs1->kode_sub_arsip ?>/H.4.2/<?= $pc_tgl1[1] ?>/<?= $pc_tgl1[0] ?></td>
                    <td><?= $vs1->tujuan_surat ?></td>
                    <td><?= $vs1->perihal ?></td>
                    <td><?= tgl_indoo($vs1->tanggal) ?></td>
                    <td><?= $vs1->sifat ?></td>
                </tr>
                <?php $no_vs1++; } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
    <?php if($jml_verif_cuti1){ ?>
    <span class="badge badge-success" style="font-size:14px">Melakukan Verifikasi <?= $jml_verif_cuti1 ?> Pengajuan Cuti Sebagai Atasan Langsung</span>
    <br><br>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>  
                    <th>Pemohon</th>
                    <th>Jenis Cuti</th>
                    <th>Alasan</th>
                    <th>Tanggal</th>
                    <th>Lama Cuti</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no_vc1 = 1;foreach($verif_cuti1 as $vc1){ ?>
                <tr>
                    <td><?= $no_vc1 ?></td>
                    <td><?= $vc1->nama ?></td>
                    <td><?= $vc1->jenis_cuti ?></td>
                    <td><?= $vc1->alasan_cuti ?></td>
                    <td><?= tgl_indoo($vc1->tgl_mulai) ?></td>
                    <td><?= $vc1->lama_cuti ?> Hari</td>
                    <td><?= $vc1->verif ?></td>
                </tr>
                <?php $no_vc1++; } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
    <?php if($jml_verif_lap_perjadin){ ?>
    <span class="badge badge-success" style="font-size:14px">Melakukan Verifikasi <?= $jml_verif_lap_perjadin ?> Laporan Perjalanan Dinas</span>
    <br><br>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>  
                    <th>Perihal</th>
                    <th>Pegawai</th>
                    <th>DIPA</th>
                    <th>Yang membuat</th>
                </tr>
            </thead>
            <tbody>
                <?php $no_lp = 1;foreach($verif_lap_perjadin as $vlp){ ?>
                <tr>
                    <td><?= $no_lp ?></td>
                    <td><?= $vlp->untuk ?></td>
                    <td>
                        <?php 
                            $list_pegawai = $this->model_sitas->listDataBy("b.nama",
                                            "anggota_spt a inner join peserta_spt b on a.id_pegawai=b.id_pegawai",
                                            "a.id_spt = $vlp->id_spt","a.id_anggota asc"); 
                            foreach($list_pegawai as $lpg){
                                echo konversi_nama_peg($lpg->nama).".<br>";
                            }
                        ?>
                    </td>
                    <td>
                        <?php 
                            if($vlp->is_dipa == 1){
                                $dipa = "BPSI TAS";
                            } else {
                                $dipa = "-";
                            }
                            echo $dipa;
                        ?>
                    </td>
                    <td>
                        <?php 
                            $get_yg_buat = $this->model_sitas->get_user_by($vlp->user);
                            echo konversi_nama_peg($get_yg_buat->nama); 
                        ?>
                    </td>
                </tr>
                <?php $no_lp++; } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
    <?php if($jml_tamu){ ?>
    <span class="badge badge-success" style="font-size:14px">Menerima <?= $jml_tamu ?> Kunjungan Tamu</span>
    <br><br>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>  
                    <th>Nama</th>
                    <th>Asal Instansi</th>
                    <th>Alamat</th>
                    <th>Tujuan</th>
                    <th>Tanggal</th>
                    <th>Foto Tamu</th>
                </tr>
            </thead>
            <tbody>
                <?php $no_tm = 1;foreach($tamu as $tm){ ?>
                <tr>
                    <td><?= $no_tm ?></td>
                    <td><?= $tm->nama ?></td>
                    <td><?= $tm->asal_instansi ?></td>
                    <td><?= $tm->alamat ?></td>
                    <td><?= $tm->maksud_tujuan ?></td>
                    <td><?= tgl_indoo(substr($tm->waktu,0,11))  ?></td>
                    <td><img style="height:100px;width:auto" src="<?= base_url()."asset/foto_tamu/".$tm->foto_tamu ?>.jpg"></td>
                </tr>
                <?php $no_tm++; } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
    <?php if($jml_surat_masuk > 0){ ?>
    <span class="badge badge-success" style="font-size:14px">Membuat <?= $jml_surat_masuk ?> Surat Masuk</span>
    <br><br>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>  
                    <th>Perihal</th>
                    <th>Asal Surat</th>
                    <th>No Agenda</th>
                    <th>No Surat</th>
                    <th>Sifat</th>
                    <th>Tanggal Reg.</th>
                </tr>
            </thead>
            <tbody>
                <?php $no_sm1 = 1;foreach($surat_masuk as $smk){ ?>
                <tr>
                    <td><?= $no_sm1 ?></td>
                    <td><?= $smk->perihal ?></td>
                    <td><?= $smk->asal_surat ?></td>
                    <td><?= $smk->no_agenda ?>/<?= $smk->kode_sub_arsip ?></td>
                    <td><?= $smk->no_surat_masuk ?></td>
                    <td><?= $smk->sifat ?></td>
                    <td><?= tgl_indoo($smk->tanggal_masuk) ?></td>
                </tr>
                <?php $no_sm1++; } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
    <?php if($jml_surat_keluar > 0){ ?>
    <span class="badge badge-success" style="font-size:14px">Membuat <?= $jml_surat_keluar ?> Surat Keluar</span>
    <br><br>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>  
                    <th>Nomor</th>
                    <th>Tujuan Surat</th>
                    <th>Perihal</th>
                    <th>Tanggal</th>
                    <th>Sifat</th>
                </tr>
            </thead>
            <tbody>
                <?php $no_sk = 1;foreach($surat_keluar as $skl){ $pc_tgl = explode("-",$skl->tanggal)?>
                <tr>
                    <td><?= $no_sk ?></td>
                    <td>B-<?= $skl->no_surat_keluar ?>/<?= $skl->kode_sub_arsip ?>/H.4.2/<?= $pc_tgl[1] ?>/<?= $pc_tgl[0] ?></td>
                    <td><?= $skl->tujuan_surat ?></td>
                    <td><?= $skl->perihal ?></td>
                    <td><?= tgl_indoo($skl->tanggal) ?></td>
                    <td><?= $skl->sifat ?></td>
                </tr>
                <?php $no_sk++; } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
  </div>
</div>