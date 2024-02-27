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
</style>
	<body>
	   <?php
	        
            $ketua_penerima = explode(",",$spt->id_pegawai_disposisi);
            $ketua_paraf = $this->model_sitas->rowDataBy("nama","pegawai","id_pegawai = $ketua_penerima[0]")->row();
            $tgl_in = substr($spt->tanggal,0,10);
            $pc_tgl_in = explode("-",$tgl_in); 
            $bln = $pc_tgl_in[1];
            $thn = $pc_tgl_in[0];
        ?>
		<div style="border:1px solid black">
		<table style="margin-left:3%;margin-top:5px;width:90%" border="0">
          <tr><td>KEMENTERIAN PERTANIAN</td></tr>
          <tr><td>BALAI PENGUJIAN STANDAR INSTRUMEN TANAMAN PEMANIS DAN SERAT</td></tr>
          <tr><td>Jl. Raya Karangploso KM 4, Kec. Karangploso, Kab. Malang - Jawa Timur</td></tr>
        </table>
        </div>
        <div style="border:1px solid black">
		<table style="margin-left:3%;margin-top:5px;width:90%" border="0">
          <tr>
              <td colspan="2">
                  Biasa <div style="display:inline;margin-left:5px;margin-top:1px;margin-right:20px;width:30px;height:15px;border:1px solid black;background:<?php if($spt->id_sifat == 1) { echo '#fcc203'; } else { echo '#ffffff' ;} ?>"></div>
                  Rahasia <div style="display:inline;margin-left:5px;margin-top:1px;margin-right:20px;width:30px;height:15px;border:1px solid black;background:<?php if($spt->id_sifat == 2) { echo '#fcc203'; } else { echo '#ffffff' ;} ?>"></div>
                  Sangat Rahasia <div style="display:inline;margin-left:5px;margin-top:1px;margin-right:20px;width:30px;height:15px;border:1px solid black;background:<?php if($spt->id_sifat == 3) { echo '#fcc203'; } else { echo '#ffffff' ;} ?>"></div>
                  Terbatas <div style="display:inline;margin-left:5px;margin-top:1px;margin-right:20px;width:30px;height:15px;border:1px solid black;background:<?php if($spt->id_sifat == 4) { echo '#fcc203'; } else { echo '#ffffff' ;} ?>"></div>
              </td>
          </tr>
          <tr>
              <td colspan="2">
                  Penting <div style="display:inline;margin-left:5px;margin-top:1px;margin-right:20px;width:30px;height:15px;border:1px solid black;background:<?php if($spt->id_sifat == 5) { echo '#fcc203'; } else { echo '#ffffff' ;} ?>"></div>
                  Segera <div style="display:inline;margin-left:5px;margin-top:1px;margin-right:20px;width:30px;height:15px;border:1px solid black;background:<?php if($spt->id_sifat == 6) { echo '#fcc203'; } else { echo '#ffffff' ;} ?>"></div>
                  Sangat Segera <div style="display:inline;margin-left:5px;margin-top:1px;margin-right:20px;width:30px;height:15px;border:1px solid black;background:<?php if($spt->id_sifat == 7) { echo '#fcc203'; } else { echo '#ffffff' ;} ?>"></div>
              </td>
          </tr>
          <tr><td style="width:50%">Nomor Agenda : <?= $spt->no_agenda ?>/<?= $kode_arsip->kode_sub_arsip ?></td><td style="width:50%">Tanggal Diterima : <?= tgl_indoo($spt->tanggal_masuk) ?></td></tr>
          <tr><td colspan="2">Nomor Surat : <?= $spt->no_surat_masuk ?></td></tr>
          <tr><td style="width:50%">Kode : <?= $kode_arsip->kode_sub_arsip ?></td><td style="width:50%">Tanggal Surat : <?= tgl_indoo($spt->tanggal) ?></td></tr>
        </table>
        </div>
        <div style="border:1px solid black">
		<table style="margin-left:3%;margin-top:5px;width:90%" border="0">
          <tr><td>ASAL SURAT : <?= $spt->asal_surat ?></td></tr>
        </table>
        </div>
        <div style="border:1px solid black">
		<table style="margin-left:3%;margin-top:5px;width:90%" border="0">
          <tr><td>PERIHAL SURAT :</td><td><?= wordwrap($spt->perihal,60,"<br />\n") ?></td></tr>
        </table>
        </div>
        <div style="border:1px solid black">
    	<table style="margin-left:3%;margin-top:5px;width:90%" border="0">
          <tr><td colspan="4">DISPOSISI KEPADA YTH.</td></tr>
          <?php 
          $nos = 0;
          $nol = -1;
          $pc_dispo = explode(",",$spt->diteruskan);
          $pc_ket = explode(",",$spt->isi_disposisi);
          foreach($dispo as $ds){
              if(in_array($ds, $pc_dispo)){
                  $bgx = "#fcc203";
              } else {
                  $bgx = "#ffffff";
              }
              $nos++;
          ?>
          <tr>
              <td style="border:1px solid black"><?= $nos ?>. <?= $ds ?></td>
              <td><div style="height:15px;width:20px;border:1px solid black;background:<?= $bgx ?>"></div></td>
              <?php if($nos<=7) {
                  $nol++;
                  if(in_array($ket[$nol], $pc_ket)){
                        $bgw = "#fcc203";
                    } else {
                        $bgw = "#ffffff";
                    }
              ?>
              <td style="border:1px solid black"><?= $nos ?>. <?= $ket[$nol] ?></td>
              <td><div style="height:15px;width:20px;border:1px solid black;background:<?= $bgw ?>"></div></td>
              <?php
                  } 
              ?>
          </tr>
          <?php
          }
          ?>
          <tr>
               <td style="border:1px solid black"><?= $nos+1; ?>. <b><?= wordwrap($spt->disposisi,40,"<br />"); ?></b></td>
              <td><div style="height:15px;width:20px;border:1px solid black;background:<?php if($spt->disposisi!=NULL){ echo "#fcc203"; } else { echo "#ffffff";} ?>"></div></td>
          </tr>
          <tr><td colspan="2">&nbsp;</td><td colspan="2">Malang, <br> Kepala Balai</td></tr>
          <tr><td colspan="4">&nbsp;</td></tr>
          <tr><td colspan="2">&nbsp;</td><td colspan="2"><?php if($spt->id_verifikasi!=0) { echo "TTD"; } ?></td></tr>
        </table>
        </div>
        <div style="border:1px solid black">
        <table style="margin-left:3%;margin-top:5px;width:90%" border="0">
          <tr>
              <!--<td style="width:50%;text-align:center">Paraf Penerima</td>-->
              <td style="width:100%;text-align:justify">Catatan Penyelesaian</td>
          </tr>
          <tr>
              <!--<td style="height:15%;text-align:center">&nbsp;</td>-->
              <td style="text-align:justify"><b>"<?= wordwrap($spt->catatan,48,"<br />\n") ?>"</b></td>
          </tr>
          <!--
          <tr>
              <td style="width:50%;text-align:center"><b><?= $ketua_paraf->nama ?></b></td>
              <td style="width:50%;text-align:center">&nbsp;</td>
          </tr>
          -->
        </table>
        </div>
     	</body>
	</html>