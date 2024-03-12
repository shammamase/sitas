<html> 
<style>
     p,table,tr,td{
        font-family:Arial;
        font-size:12pt;
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
        
        .forx{
            z-index:2;
            position:absolute;
            top:600px;
            left:430px;
            font-size:12px;
        }
        
        .capx{
            position:absolute;
            z-index:-999;
            opacity:0.1;
            top:600px;
            left:390px;
            height:200px; 
            width:auto;
        }
</style>
	<body>
    <?php
    if($no_surat->id_verif==0){
        $verif_akhir = $this->db->query("select * from pejabat_verifikator where level = 'akhir'")->row();
        $kabalai = $this->model_sitas->rowDataBy("a.struktur,a.for_ttd,b.nama,b.nip",
                        "struktur_organisasi a inner join pegawai b on a.id_pegawai=b.id_pegawai",
                        "a.id_pegawai=$verif_akhir->id_pegawai")->row();
    } else {
        $kabalai = $this->model_sitas->rowDataBy("a.struktur,a.for_ttd,b.nama,b.nip",
                        "struktur_organisasi a inner join pegawai b on a.id_pegawai=b.id_pegawai",
                        "a.id_pegawai=$no_surat->id_verif")->row();
    }
    $tgl_in = substr($lap_spt->tanggal_input,0,10);
    $pc_tgl_in = explode("-",$tgl_in); 
    $bln = $pc_tgl_in[1];
    $thn = $pc_tgl_in[0];
    if(!empty($no_surat)){
        $no_srt = $no_surat->no_surat_keluar;
    } else {
        $no_srt = " - ";
    }
?>
		<div><img style="width:100%" src="<?php echo base_url().'asset/kop_surat.png' ?>"></div>
		<p style="text-align:center;margin-top:0px"><b><u>LAPORAN PERJALANAN DINAS</u></b></p>
		<p style="text-align:center;margin-top:-10px">SPT NO. <?= $no_srt ?>/TU.040/H.4.2/<?= $bln ?>/<?= $thn ?></p>
		<table style="margin-left:10%;margin-top:10px;width:80%" border="0">
          <tr>
              <td style="width:40%;vertical-align:top">1. Nama Yang Ditugaskan</td>
              <td style="width:5%;vertical-align:top;text-align:right">:</td>
              <td style="width:55%;text-align:justify;vertical-align:top">
                  <?php
                    foreach($peg as $pg){
                        $tgl_plk = $pg->tanggal_spt;
                        ?>
                            <?= konversi_nama_peg($pg->nama) ?><br>
                        <?php
                            }
                            
                            //logika tgl s.d tgl
                            $pc_tgl_plk = explode(",",$tgl_plk);
                            $jml_tgl = count($pc_tgl_plk);
                            if($jml_tgl>1){
                                $pc1 = explode("-",$pc_tgl_plk[0]);
                                $pc2 = explode("-",end($pc_tgl_plk));
                                if($pc1[1]==$pc2[1]){
                                    $val_tgl = $pc1[2]." s.d ".tgl_indoo(end($pc_tgl_plk));
                                } else {
                                    $pc11 = explode(" ",tgl_indoo($pc_tgl_plk[0]));
                                    $val_tgl = $pc11[0]." ".$pc11[1]." s.d ".tgl_indoo(end($pc_tgl_plk));
                                }
                            } else {
                                $val_tgl = tgl_indoo($pc_tgl_plk[0]);
                            }
                            // end logika tgl s.d tgl
                        ?>
              </td>
          </tr>
          <tr>
              <td style="width:40%;vertical-align:top">2. Tempat Tujuan</td>
              <td style="width:5%;vertical-align:top;text-align:right">:</td>
              <td style="width:55%;text-align:justify;vertical-align:top"><?= $lap_spt->lokasi ?></td>
          </tr>
          <!--
          <tr>
              <td style="width:40%;vertical-align:top">3. Judul Tolak Ukur Kegiatan</td>
              <td style="width:5%;vertical-align:top;text-align:right">:</td>
              <td style="width:55%;text-align:justify;vertical-align:top"><?= $lap_spt->tolak_ukur_kegiatan ?></td>
          </tr>
          -->
          <tr>
              <td style="width:40%;vertical-align:top">3. Lama Perjalanan Dinas</td>
              <td style="width:5%;vertical-align:top;text-align:right">:</td>
              <td style="width:55%;text-align:justify;vertical-align:top"><?= $spt->lama_hari ?> Hari, Tanggal <?= $val_tgl ?></td>
          </tr>
          <tr>
              <td style="width:40%;vertical-align:top">4. Transportasi</td>
              <td style="width:5%;vertical-align:top;text-align:right">:</td>
              <td style="width:55%;text-align:justify;vertical-align:top"><?= $lap_spt->transportasi ?></td>
          </tr>
          <tr>
              <td style="width:40%;vertical-align:top">5. Maksud Perjalanan Dinas</td>
              <td style="width:5%;vertical-align:top;text-align:right">:</td>
              <td style="width:55%;text-align:justify;vertical-align:top"><?= $spt->untuk ?></td>
          </tr>
          <tr>
              <td style="width:40%;vertical-align:top">6. Uraian Perjalanan Dinas</td>
              <td style="width:5%;vertical-align:top;text-align:right">:</td>
              <td style="width:55%;text-align:justify;vertical-align:top">&nbsp;</td>
          </tr>
        </table>
        <div style="margin-left:10%;margin-right:10%"><?= stripslashes($lap_spt->uraian) ?></div>
        
        <table style="margin-left:10%;margin-top:10px;width:80%" border="0">
          <tr>
              <td style="width:55%;vertical-align:top">Yang Membuat</td>
              <td style="width:45%;text-align:justify;vertical-align:top">Malang, <?= tgl_indoo($tgl_in) ?></td>
          </tr>
          <?php if($kabalai->struktur != "Kepala Balai"){ ?>
          <tr>
              <td style="width:55%;vertical-align:top">&nbsp;</td>
              <td style="width:45%;text-align:justify;vertical-align:top"><?= $kabalai->for_ttd ?></td>
          </tr>
          <?php } ?>
          <tr>
              <td style="width:55%;vertical-align:top">&nbsp;</td>
              <td style="width:45%;text-align:justify;vertical-align:top"><?= $kabalai->struktur ?></td>
          </tr>
          <tr>
              <td style="width:55%;height:70px;text-align:justify;vertical-align:top">
                <!--<img style="height:80px;width:auto" src="">-->
              </td>
              <td style="width:45%;text-align:justify;vertical-align:top">
                <!--<img style="height:80px;width:auto" src="">-->
              </td>
          </tr>
          <tr>
              <td style="width:55%;text-align:justify;vertical-align:top"><b><?= konversi_nama_peg($user->nama) ?></b></td>
              <td style="width:45%;text-align:justify;vertical-align:top"><b><?= konversi_nama_peg($kabalai->nama) ?></b></td>
          </tr>
          <tr>
              <td style="width:55%text-align:justify;vertical-align:top">NIP. <?= $user->nip ?></td>
              <td style="width:45%text-align:justify;vertical-align:top">NIP. <?= $kabalai->nip ?></td>
          </tr>
          <tr>
              <td colspan="2" style="width:100%;vertical-align:top;text-align:center">
                  <br>
                  <img style="height:80px; width:auto" src="<?= base_url() ?>asset/qr_code/lap_spt_<?= $spt->id_spt ?>.png">
              </td>
          </tr>
        </table>
        <div style="margin-left:2px;margin-bottom:10px;font-size:20px;font-weight:bold">Dokumentasi :</div>
        <?php
        if($lap_spt->gbr_dok!=0){
            $dok = explode(",",$lap_spt->gbr_dok);
            foreach($dok as $dk){
                $gbr_dok = str_replace(" ","%20",$dk);
            ?>
            <img style="margin-top:2px;margin-left:2px;height:270px; width:auto" src="<?= base_url() ?>asset/lap_spt/<?= $gbr_dok ?>">
            <?php
            }
        }
        ?>
     	</body>
	</html>