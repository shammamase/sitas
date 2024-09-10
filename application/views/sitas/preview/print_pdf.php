<html> 
<style>
    body {
            margin: 0; /* Menghapus margin agar gambar mendekati tepi halaman */
            padding: 0; /* Menghapus padding agar gambar mendekati tepi halaman */
        }
     table,tr,td{
        font-family:Arial;
        font-size:12pt;
        padding-left:3px;
        padding-right:1px;
        border-collapse:collapse;
        /*
        border-collapse:collapse;
        padding:3px;
        border:1px solid black;
        */
        }
        
        ul,ol{
            font-family:Arial;
            font-size:12pt;
            margin-left:-15px;
            margin-top:-15px;
        } 
        
        .no_srt{
            margin-top:-20px;
        }
        
        .dipa{
            margin-top:-15px;
            font-size:12pt;
        }
        
        p{
            text-align:justify;
            margin-top:-10px;
            line-height:1.4;
            font-size:12pt;
            font-family:Arial;
        }
        .logo {
            position: absolute;
            bottom: 0;
            left: 70px;
        }
        <?php if($spt->no_view_border==0){ ?>
        .table-bordered tr td {
        border-collapse: collapse;
        border-width: 1px;
        border-color: black;
        border-style: solid;
        }
        <?php } ?>
        .table-bordered{
            width: 40%;
            margin-top:-30px;
            margin-bottom:20px;
        }
        .table-bordered p {
            margin-top:3px;
        }
</style>
	<body>
	   <?php
            if($spt->id_verif==0){
                $id_pjs = $this->db->query("select * from pejabat_verifikator where level = 'akhir'")->row();
                $kabalai = $this->model_sitas->rowDataBy("a.struktur,a.for_ttd,b.nama,b.nip",
                                "struktur_organisasi a inner join pegawai b on a.id_pegawai=b.id_pegawai",
                                "a.id_pegawai = $id_pjs->id_pegawai")->row();
            } else {
                $kabalai = $this->model_sitas->rowDataBy("a.struktur,a.for_ttd,b.nama,b.nip",
                                "struktur_organisasi a inner join pegawai b on a.id_pegawai=b.id_pegawai",
                                "a.id_pegawai = $spt->id_verif")->row();
            }
            $tgl_in = $spt->tanggal;
            $pc_tgl_in = explode("-",$tgl_in); 
            $bln = $pc_tgl_in[1];
            $thn = $pc_tgl_in[0];
            $no_sub = $this->model_sitas->rowDataBy("*","klasifikasi_sub_arsip","id_sub_arsip = $spt->id_sub_arsip")->row();
            if(!empty($no_surat)){
                $no_srt = $no_surat;
            } else {
                $no_srt = " - ";
            }
        ?>
		<div><img style="width:100%" src="<?php echo base_url().'asset/kop_surat1.png' ?>"></div>
		<table style="margin-left:5%;margin-top:10px;width:87%" border="0">
          <tr>
              <td style="width:15%;vertical-align:top">Nomor</td>
              <td style="width:5%;vertical-align:top;text-align:left">:</td>
              <td style="width:55%;text-align:justify;vertical-align:top"><?= $sifat->kode ?>-<?= $no_srt ?>/<?= $no_sub->kode_sub_arsip ?>/H.4.2/<?= $bln ?>/<?= $thn ?></td>
              <td style="width:25%;vertical-align:top;text-align:right"><?= tgl_indoo($tgl_in) ?></td>
          </tr>
          <tr>
              <td style="vertical-align:top">Sifat</td>
              <td style="vertical-align:top;text-align:left">:</td>
              <td colspan="2" style="text-align:justify;vertical-align:top"><?= $sifat->sifat ?></td>
          </tr>
          <tr>
              <td style="vertical-align:top">Lampiran</td>
              <td style="vertical-align:top;text-align:left">:</td>
              <td colspan="2" style="text-align:justify;vertical-align:top">
              <?php 
                if($spt->lampiran > 0){
                    $vw_lamp = $spt->lampiran." berkas";
                } else {
                    $vw_lamp = "-";
                }
              ?>
              <?= $vw_lamp ?>
              </td>
          </tr>
          <tr>
              <td style="vertical-align:top">Perihal</td>
              <td style="vertical-align:top;text-align:left">:</td>
              <td colspan="2" style="text-align:justify;vertical-align:top"><?= wordwrap($spt->perihal,50,"<br />\n") ?></td>
          </tr>
        </table>
        
        <table style="margin-left:5%;margin-top:30px;width:100%" border="0">
          <tr>
              <td style="vertical-align:top">Yth.</td>
              <td>
              <?php 
                    $pc = explode("#",$spt->tujuan_surat); 
                    $jmlx = count($pc);
                    if($jmlx > 1){
                ?>
                
                    <ol style="margin-top:-10px">
                    <?php 
                        foreach($pc as $pcs){
                    ?>
                    <li><?= $pcs ?></li>
                    <?php
                        }
                    ?>
                    </ol>
                
                <?php } else { ?>
                <?= wordwrap($spt->tujuan_surat,70,"<br />\n") ?>
                <?php } ?>
              </td>
          </tr>
          <tr>
              <td colspan="2" style="vertical-align:top;"><?= $spt->lokasi_tujuan_surat ?></td>
          </tr>
        </table>
        
        <div style="margin-left:6%;margin-right:7%;margin-top:40px;padding-top:10px">
            <?= $spt->isi_surat ?>
        </div>
        <!--
        <table style="margin-left:5%;margin-top:10px;width:90%" border="0">
          <tr>
              <td colspan="3" style="width:100%;vertical-align:top;line-height:1.5"></td>
          </tr>
        </table>
        -->
        <table style="margin-left:30%;margin-top:10px;width:60%" border="0">
          <!--
          <tr>
              <td style="width:50%;vertical-align:top">&nbsp;</td>
              <td style="width:50%;text-align:justify;vertical-align:top">Gorontalo, <?= tgl_indoo($tgl_in) ?></td>
          </tr>
          -->
          <tr>
              <td style="width:40%;vertical-align:top">&nbsp;</td>
              <td style="width:60%;text-align:justify;vertical-align:top"><?= $kabalai->for_ttd ?></td>
          </tr>
          <tr>
              <td style="vertical-align:top">&nbsp;</td>
              <td style="text-align:justify;vertical-align:top"><?= $kabalai->struktur ?></td>
          </tr>
          <tr>
              <?php 
              if($kabalai->struktur == "Kepala Balai" OR $kabalai->struktur == "Kasubag Tata Usaha"){
                if($spt->waktu_verif == ""){
                    ?>
                    <td style="vertical-align:top;text-align:center">
                    <!--<img style="height:80px; width:auto;" src="<?= base_url() ?>asset/qr_code/surat_keluar_<?= $spt->id_surat_keluar ?>.png">-->
                    </td>
                    <td style="height:70px;text-align:justify;vertical-align:bottom">
                    <!--<img style="height:100px; width:auto;" src="<?= base_url().$kabalai->ttd ?>">-->
                    TTD
                    </td>
                    <?php
                } else {
                    ?>
                    <!--
                    <td style="vertical-align:top;text-align:center"></td>
                    <td style="text-align:justify;vertical-align:top">
                    <img style="height:100px; width:auto;" src="<?= base_url() ?>asset/file_lainnya/qr_code_surat/<?= $spt->id_buat_surat ?>.png">
                    <img style="margin-top:80px;height:20px; width:auto;" src="<?= base_url() ?>asset/bsre2.png">
                    <img style="margin-top:-50px;margin-left:-127px" src="<?= base_url() ?>asset/logo_kementan_tte.png">
                    </td>
                    -->
                    <td style="vertical-align:top;text-align:center">
                    <img style="height:80px; width:auto;" src="<?= base_url() ?>asset/qr_code/surat_keluar_<?= $spt->id_surat_keluar ?>.png">
                    </td>
                    <td style="height:70px;text-align:justify;vertical-align:bottom">
                    TTD
                    <!--<img style="height:100px; width:auto;" src="<?= base_url().$kabalai->ttd ?>">-->
                    </td>
                    <?php
                }
            } else {
                ?>
                <td style="vertical-align:top;text-align:center">
                <img style="height:80px; width:auto;" src="<?= base_url() ?>asset/qr_code/surat_keluar_<?= $spt->id_surat_keluar ?>.png">
                </td>
                <td style="height:70px;text-align:justify;vertical-align:bottom">
                TTD
                <!--<img style="height:100px; width:auto;" src="<?= base_url().$kabalai->ttd ?>">-->
                </td>
                <?php
            }
              ?>
          </tr>
          <tr>
              <td style="vertical-align:top">&nbsp;</td>
              <td style="text-align:justify;vertical-align:top;font-size:15px"><b><?= konversi_nama_peg($kabalai->nama) ?></b></td>
          </tr>
          <tr>
              <td style="vertical-align:top">&nbsp;</td>
              <td style="text-align:justify;vertical-align:top;padding-top:0px">NIP. <?= $kabalai->nip ?></td>
          </tr>
        </table>
        
        <table style="margin-left:5%;margin-top:70px;width:90%" border="0">
          <tr>
              <td colspan="3" style="width:100%;vertical-align:top;line-height:1.5">
                  <?php
                    if(!empty($spt->tembusan)){
                        $tmb = "<b>Tembusan :</b>";
                    } else {
                        $tmb = "";
                    }
                    echo $tmb;
                ?>
              </td>
        </tr>
        <tr>
              <td colspan="3" style="width:100%;vertical-align:top;line-height:1.5">
                  <?php if(!empty($spt->tembusan)){ ?>
        <ol>
        <?php
            $pc_tm = explode(",",$spt->tembusan);
            foreach($pc_tm as $pc_tmm){
            ?>
            <li><?= $pc_tmm ?></li>
            <?php
            }
        ?>
        </ol>
        <?php } ?>
              </td>
          </tr>
        </table>
        <?php 
        if($kabalai->struktur == "Kepala Balai" OR $kabalai->struktur == "Kasubag Tata Usaha"){ 
            if($spt->waktu_verif != ""){
        ?>
                <!--<img style="height:40px;width:auto" src="<?= base_url('asset/footer_tte3.png') ?>" alt="Gambar PNG" class="logo">-->
        <?php 
            }
        } 
        ?>
        <?php if($cek_lampiran > 0) { ?>
        <div style="page-break-after:always; clear:both"></div>
        <?php
            $no_lamp = 1;
            foreach($list_lampiran as $ls){
        ?>
        <div style="margin-left:2%;margin-right:7%;margin-top:40px;padding-top:10px">
            <?= $ls->deskripsi ?>
        </div>
        <table style="margin-left:30%;margin-top:10px;width:60%" border="0">
          <tr>
              <td style="width:40%;vertical-align:top">&nbsp;</td>
              <td style="width:60%;text-align:justify;vertical-align:top"><?= $kabalai->for_ttd ?></td>
          </tr>
          <tr>
              <td style="vertical-align:top">&nbsp;</td>
              <td style="text-align:justify;vertical-align:top"><?= $kabalai->struktur ?></td>
          </tr>
          <tr>
              <?php 
              if($kabalai->struktur == "Kepala Balai" OR $kabalai->struktur == "Kasubag Tata Usaha"){
                if($spt->waktu_verif == ""){
                    ?>
                    <td style="vertical-align:top;text-align:center">
                    &nbsp;
                    </td>
                    <td style="height:70px;text-align:justify;vertical-align:bottom">
                    TTD
                    </td>
                    <?php
                } else {
                    ?>
                    <td style="vertical-align:top;text-align:center">
                    <img style="height:80px; width:auto;" src="<?= base_url() ?>asset/qr_code/surat_keluar_<?= $spt->id_surat_keluar ?>.png">
                    </td>
                    <td style="height:70px;text-align:justify;vertical-align:bottom">
                    TTD
                    </td>
                    <?php
                }
            } else {
                ?>
                <td style="vertical-align:top;text-align:center">
                <img style="height:80px; width:auto;" src="<?= base_url() ?>asset/qr_code/surat_keluar_<?= $spt->id_surat_keluar ?>.png">
                </td>
                <td style="height:70px;text-align:justify;vertical-align:bottom">
                TTD
                </td>
                <?php
            }
              ?>
          </tr>
          <tr>
              <td style="vertical-align:top">&nbsp;</td>
              <td style="text-align:justify;vertical-align:top;font-size:15px"><b><?= konversi_nama_peg($kabalai->nama) ?></b></td>
          </tr>
          <tr>
              <td style="vertical-align:top">&nbsp;</td>
              <td style="text-align:justify;vertical-align:top;padding-top:0px">NIP. <?= $kabalai->nip ?></td>
          </tr>
        </table>
        <div style="page-break-after:always; clear:both"></div>
        <?php
            $no_lamp++;
            } 
        ?>
        <?php } ?>
     	</body>
	</html>