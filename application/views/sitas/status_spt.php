<?php 
if($id_pegawai_login == $id_pj){
    $warna_td = "bg-warning";
} else {
    $warna_td = "";
}

if($id_pegawai_login == $id_pa->id_pegawai){
    $warna_td_pa = "bg-warning";
} else {
    $warna_td_pa = "";
}

if($id_pegawai_login == $id_ppk->id_pegawai){
    $warna_td_ppk = "bg-warning";
} else {
    $warna_td_ppk = "";
}
?>
<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Status SPT</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table class="mt-1">
        <tr>
            <td style="vertical-align:top">Anggaran Kegiatan</td>
            <td style="vertical-align:top">:</td>
            <td style="vertical-align:top"><b><?= $pos->subkomp ?></b></td>
        </tr>
        <tr>
            <td style="vertical-align:top">Kode POS</td>
            <td style="vertical-align:top">:</td>
            <td style="vertical-align:top">
                <b><?= $pos->kd_ro.".".$pos->kd_komponen.".".$pos->kd_subkomp.".".$pos->kd_detil ?></b>
            </td>
        </tr>
    </table>
    <table id="example2" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:2%">No</th>
        <th style="width:8%">No SPPD</th>
        <th style="width:35%">Nama</th>
        <th style="width:20%">NIP</th>
        <th style="width:20%">Jabatan</th>
        <th style="width:15%">Gol</th>
      </tr>
      </thead>
      <tbody>
      <?php $no_sppd = $spt->no_sppd; $no = 1;foreach($pegawai_spt as $peg){ ?>
      <tr>
        <td><?= $no ?></td>
        <td><?= $no_sppd ?></td>
        <td><?= $peg->nama ?></td>
        <td><?= $peg->nip ?></td>
        <td><?= $peg->jabatan ?></td>
        <td><?= $peg->gol ?></td>
      </tr>
      <?php 
        $no++;
        if($spt->no_sppd != 0){
            $no_sppd++;
        } 
        } 
       ?>
      </tbody>
    </table>
    <div class="mt-3 table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tempat Berangkat</th>
                    <th>Tanggal Berangkat</th>
                    <th>Tanggal Kembali</th>
                    <th>Lama Perjalanan</th>
                    <th>Tempat Tujuan</th>
                    <th>Transport</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $spt->ket_berangkat ?></td>
                    <td><?= tgl_indoo($spt->tanggal) ?></td>
                    <td><?= sd_tgl2($spt->tanggal,$spt->lama_hari) ?></td>
                    <td><?= $spt->lama_hari ?> HK</td>
                    <td><?= $spt->ket_wilayah ?></td>
                    <td><?= $spt->transportasi ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <table class="mt-1">
        <tr>
            <td style="vertical-align:top">Maksud Perjalanan : </td>
            <td style="vertical-align:top">
                <b><i><?= $spt->untuk.", ".$spt->ket_wilayah." ".sd_tgl($spt->tanggal,$spt->lama_hari) ?></i></b>
            </td>
        </tr>
    </table>
    <div class="mt-3 table-responsive">
        <table class="table table-bordered table-striped">
            <tr>
                <td colspan="5">Disetujui oleh :</td>
            </tr>
            <tr>
                <td class="<?= $warna_td ?>">PJ Kegiatan</td>
                <td class="<?= $warna_td_pa ?>">Pengendali Anggaran</td>
                <td class="<?= $warna_td_ppk ?>">PPK</td>
                <td>Kasubag Tata Usaha</td>
                <td>Kepala Balai</td>
            </tr>
            <tr>
                <td style="text-align:center">
                    <?php
                    if($spt->verif_pj == 1){
                        echo "<i style='color:#28A745;font-size:35px' class='fa fa-check'></i>";
                    } else if($spt->verif_pj == 2) {
                        echo "<i style='color:#ff0000;font-size:35px' class='fa fa-times'></i>";
                    } else {
                        echo "";
                    }
                    ?>
                </td>
                <td style="text-align:center">
                    <?php
                    if($spt->status_verif_pa == 1){
                        echo "<i style='color:#28A745;font-size:35px' class='fa fa-check'></i>";
                    } else if($spt->status_verif_pa == 2) {
                        echo "<i style='color:#ff0000;font-size:35px' class='fa fa-times'></i>";
                    } else {
                        echo "";
                    }
                    ?>
                </td>
                <td style="text-align:center">
                    <?php
                    if($spt->status_verif_ppk == 1){
                        echo "<i style='color:#28A745;font-size:35px' class='fa fa-check'></i>";
                    } else if($spt->status_verif_ppk == 2) {
                        echo "<i style='color:#ff0000;font-size:35px' class='fa fa-times'></i>";
                    } else {
                        echo "";
                    }
                    ?>
                </td>
                <td style="text-align:center">
                    <?php
                        if($spt->id_surat_keluar == NULL OR $spt->id_surat_keluar == 0){
                            $kety  = "";
                            echo "";
                        } else {
                           $surat_keluar = $this->model_sitas->rowDataBy("id_verif1,keterangan,alasan_tolak",
                                            "surat_keluar","id_surat_keluar=$spt->id_surat_keluar")->row();
                            if($surat_keluar->alasan_tolak == ""){
                                if($surat_keluar->id_verif1 != 0){
                                    $kety  = $surat_keluar->keterangan;
                                    echo "<i style='color:#28A745;font-size:35px' class='fa fa-check'></i>";
                                } else {
                                    $kety  = "";
                                    echo "";
                                }
                            } else {
                                $kety  = $surat_keluar->alasan_tolak;
                                echo "<i style='color:#ff0000;font-size:35px' class='fa fa-times'></i>";
                            }
                        }
                    ?>
                </td>
                <td style="text-align:center">
                    <?php
                        if($spt->id_surat_keluar == NULL OR $spt->id_surat_keluar == 0){
                           $ketx  = "";
                           echo "";
                        } else {
                           $surat_keluar2 = $this->model_sitas->rowDataBy("id_verif,keterangan,alasan_tolak",
                                            "surat_keluar","id_surat_keluar=$spt->id_surat_keluar")->row();
                            if($surat_keluar2->alasan_tolak == ""){
                                if($surat_keluar2->id_verif != 0){
                                    $ketx  = $surat_keluar2->keterangan;
                                    echo "<i style='color:#28A745;font-size:35px' class='fa fa-check'></i>";
                                } else {
                                    $ketx  = "";
                                    echo "";
                                }
                            } else {
                                $ketx  = $surat_keluar2->alasan_tolak;
                                echo "<i style='color:#ff0000;font-size:35px' class='fa fa-times'></i>";
                            }
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td><?= $spt->keterangan ?></td>
                <td><?= $spt->keterangan_pa ?></td>
                <td><?= $spt->keterangan_ppk ?></td>
                <td><?= $kety ?></td>
                <td><?= $ketx ?></td>
            </tr>
        </table>
    </div>
    <?php 
        if(in_array($id_pegawai_login, $arr_disetujui)){ 
                if($id_pegawai_login == $id_pj){
                    if($total_verif == 0){
                    ?>
                    <table class="mt-1">
                        <tr>
                            <td><button data-toggle="modal" data-target="#setuju_spt" class="btn btn-success btn-block">Setuju</button></td>
                            <td><button data-toggle="modal" data-target="#tolak_spt" class="btn btn-danger btn-block">Tolak</button></td>
                        </tr>
                    </table>
                    <?php
                    }
                }
                if($id_pegawai_login == $id_pa->id_pegawai){
                    if($total_verif == 1){
                    ?>
                    <table class="mt-1">
                        <tr>
                            <td><button data-toggle="modal" data-target="#setuju_spt" class="btn btn-success btn-block">Setuju</button></td>
                            <td><button data-toggle="modal" data-target="#tolak_spt" class="btn btn-danger btn-block">Tolak</button></td>
                        </tr>
                    </table>
                    <?php
                    }
                }
                if($id_pegawai_login == $id_ppk->id_pegawai){
                    if($total_verif == 2){
                    ?>
                    <table class="mt-1">
                        <tr>
                            <td><button data-toggle="modal" data-target="#setuju_spt" class="btn btn-success btn-block">Setuju</button></td>
                            <td><button data-toggle="modal" data-target="#tolak_spt" class="btn btn-danger btn-block">Tolak</button></td>
                        </tr>
                    </table>
                    <?php
                    }
                }
        } else {
            if($total_verif <= 2){
            ?>
                <a href="<?= site_url('sekunder/send_info_spt/').$uri3.'/'.$uri4 ?>" class="btn btn-primary">Kirim Ke Verifikator</a>
                <?php
            }
        }
        if($total_verif == 3){
        ?>
        <a target="_blank" href="<?= site_url('preview/pengajuan_spt/').$uri3.'/'.$uri4 ?>" class="btn btn-danger btn-block">Download Pengajuan SPT</a>
        <?php
        }  
    ?>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
<?php if(in_array($id_pegawai_login, $arr_disetujui)){ ?>
    <div class="modal fade" id="setuju_spt" tabindex="-1"  role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Apakah anda setuju dengan pengajuan SPT ini ?</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?= site_url('sekunder/setuju_status_spt') ?>">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" name="keterangan"></textarea>
                            </div>
                            <input type="hidden" name="verifikator" value="<?= $id_pegawai_login ?>">
                            <input type="hidden" name="id_spt" value="<?= $uri3 ?>">
                            <input type="hidden" name="kd_spt" value="<?= $uri4 ?>">
                            <button type="submit" class="btn btn-success btn-block">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tolak_spt" tabindex="-1"  role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Apakah anda ingin menolak pengajuan SPT ini ?</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?= site_url('sekunder/tolak_status_spt') ?>">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" name="keterangan" required></textarea>
                            </div>
                            <input type="hidden" name="verifikator" value="<?= $id_pegawai_login ?>">
                            <input type="hidden" name="id_spt" value="<?= $uri3 ?>">
                            <input type="hidden" name="kd_spt" value="<?= $uri4 ?>">
                            <button type="submit" class="btn btn-danger btn-block">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>