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
	        if($spt->pj_ttd==0){
                $id_pjs = $this->db->query("select * from sijuara_pejabat_ttd where id_pjs = 1")->row();
                $kabalai = $this->model_more->get_pj_ttd($id_pjs->id_pejabat)->row();
            } else {
                $kabalai = $this->model_more->get_pj_ttd($spt->pj_ttd)->row();
                //$kabalai = $this->model_more->get_pj_ttd(1)->row();
            }
            $tgl_in = substr($lap_spt->tanggal_input,0,10);
            $pc_tgl_in = explode("-",$tgl_in); 
            $bln = $pc_tgl_in[1];
            $thn = $pc_tgl_in[0];
            $no_sub = $this->model_more->get_sub_arsip($spt->id_arsip)->row();
            if(!empty($no_surat)){
                $no_srt = $no_surat->no_surat_keluar;
            } else {
                $no_srt = " - ";
            }
        ?>
		<div><img style="width:100%" src="<?php echo base_url().'asset/kop_iso.jpg' ?>"></div>
		<p style="text-align:center;margin-top:0px"><b><u>LAPORAN PERJALANAN DINAS</u></b></p>
		<p style="text-align:center;margin-top:-10px">SPT NO. <?= $no_srt ?>/<?= $no_sub->kode_sub_arsip ?>/H.10.29/<?= $bln ?>/<?= $thn ?></p>
		<table style="margin-left:10%;margin-top:10px;width:80%" border="0">
          <tr>
              <td style="width:40%;vertical-align:top">1. Nama Yang Ditugaskan</td>
              <td style="width:5%;vertical-align:top;text-align:right">:</td>
              <td style="width:55%;text-align:justify;vertical-align:top">
                  <?php
                    foreach($peg as $pg){
                        $tgl_plk = $pg->tanggal;
                        ?>
                            <?= $pg->nama ?><br>
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
          <tr>
              <td style="width:40%;vertical-align:top">3. Judul Tolak Ukur Kegiatan</td>
              <td style="width:5%;vertical-align:top;text-align:right">:</td>
              <td style="width:55%;text-align:justify;vertical-align:top"><?= $lap_spt->tolak_ukur_kegiatan ?></td>
          </tr>
          <tr>
              <td style="width:40%;vertical-align:top">4. Lama Perjalanan Dinas</td>
              <td style="width:5%;vertical-align:top;text-align:right">:</td>
              <td style="width:55%;text-align:justify;vertical-align:top"><?= $spt->lama_hari ?> Hari, Tanggal <?= $val_tgl ?></td>
          </tr>
          <tr>
              <td style="width:40%;vertical-align:top">5. Transportasi</td>
              <td style="width:5%;vertical-align:top;text-align:right">:</td>
              <td style="width:55%;text-align:justify;vertical-align:top"><?= $lap_spt->transportasi ?></td>
          </tr>
          <tr>
              <td style="width:40%;vertical-align:top">6. Maksud Perjalanan Dinas</td>
              <td style="width:5%;vertical-align:top;text-align:right">:</td>
              <td style="width:55%;text-align:justify;vertical-align:top"><?= $spt->untuk ?></td>
          </tr>
          <tr>
              <td style="width:40%;vertical-align:top">7. Uraian Perjalanan Dinas</td>
              <td style="width:5%;vertical-align:top;text-align:right">:</td>
              <td style="width:55%;text-align:justify;vertical-align:top">&nbsp;</td>
          </tr>
        </table>
        <div style="margin-left:10%;margin-right:10%"><?= stripslashes($lap_spt->uraian) ?></div>
        
        <table style="margin-left:10%;margin-top:10px;width:80%" border="0">
          <tr>
              <td style="width:55%;vertical-align:top">Yang Membuat</td>
              <td style="width:45%;text-align:justify;vertical-align:top">Gorontalo, <?= tgl_indoo($tgl_in) ?></td>
          </tr>
          <tr>
              <td style="width:55%;vertical-align:top">&nbsp;</td>
              <td style="width:45%;text-align:justify;vertical-align:top"><?= $kabalai->for_ttd ?></td>
          </tr>
          <tr>
              <td style="width:55%;vertical-align:top">&nbsp;</td>
              <td style="width:45%;text-align:justify;vertical-align:top"><?= $kabalai->jabatan ?></td>
          </tr>
          <tr>
              <td style="width:55%;text-align:justify;vertical-align:top"><img style="height:80px;width:auto" src="<?= base_url().$user->ttd ?>"></td>
              <td style="width:45%;text-align:justify;vertical-align:top"><img style="height:80px;width:auto" src="<?= base_url().$kabalai->ttd ?>"></td>
          </tr>
          <tr>
              <td style="width:55%;text-align:justify;vertical-align:top"><b><?= $user->nama ?></b></td>
              <td style="width:45%;text-align:justify;vertical-align:top"><b><?= $kabalai->nama ?></b></td>
          </tr>
          <tr>
              <td style="width:55%text-align:justify;vertical-align:top">NIP. <?= $user->nip ?></td>
              <td style="width:45%text-align:justify;vertical-align:top">NIP. <?= $kabalai->nip ?></td>
          </tr>
          <tr>
              <td colspan="2" style="width:100%;vertical-align:top;text-align:center">
                  <img style="height:80px; width:auto" src="<?= base_url() ?>asset/file_lainnya/qr_code_lap_spt/<?= $spt->id_spt ?>.png">
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
            <img style="margin-top:2px;margin-left:2px;height:270px; width:auto" src="<?= base_url() ?>asset/file_lainnya/lap_spt/<?= $gbr_dok ?>">
            <?php
            }
        }
        ?>
     	</body>
	</html>