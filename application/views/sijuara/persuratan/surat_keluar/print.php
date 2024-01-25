<html> 
<style>
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
</style>
	<body>
	   <?php
	        if($spt->pj_ttd==0){
                $id_pjs = $this->db->query("select * from sijuara_pejabat_ttd where id_pjs = 1")->row();
                $kabalai = $this->model_more->get_pj_ttd($id_pjs->id_pejabat)->row();
            } else {
                $kabalai = $this->model_more->get_pj_ttd($spt->pj_ttd)->row();
            }
            $tgl_in = substr($spt->tanggal,0,10);
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
		<table style="margin-left:5%;margin-top:10px;width:87%" border="0">
          <tr>
              <td style="width:15%;vertical-align:top">Nomor</td>
              <td style="width:5%;vertical-align:top;text-align:left">:</td>
              <td style="width:55%;text-align:justify;vertical-align:top"><?= $no_srt ?>/<?= $no_sub->kode_sub_arsip ?>/H.10.29/<?= $bln ?>/<?= $thn ?></td>
              <td style="width:25%;vertical-align:top;text-align:right"><?= tgl_indoo($tgl_in) ?></td>
          </tr>
          <!--
          <tr>
              <td style="vertical-align:top">Sifat</td>
              <td style="vertical-align:top;text-align:left">:</td>
              <td colspan="2" style="text-align:justify;vertical-align:top">Segera</td>
          </tr>
          -->
          <tr>
              <td style="vertical-align:top">Lampiran</td>
              <td style="vertical-align:top;text-align:left">:</td>
              <td colspan="2" style="text-align:justify;vertical-align:top"><?= $spt->lampiran ?></td>
          </tr>
          <tr>
              <td style="vertical-align:top">Hal</td>
              <td style="vertical-align:top;text-align:left">:</td>
              <td colspan="2" style="text-align:justify;vertical-align:top"><?= wordwrap($spt->hal,50,"<br />\n") ?></td>
          </tr>
        </table>
        
        <table style="margin-left:5%;margin-top:10px;width:100%" border="0">
          <tr>
              <td style="width:70%;vertical-align:top">Yth.</td>
              <td style="width:10%;vertical-align:top;text-align:right">&nbsp;</td>
              <td style="width:20%;text-align:justify;vertical-align:top">&nbsp;</td>
          </tr>
          <tr>
              <td style="width:70%;vertical-align:top">
                  
                  <?php 
                    $pc = explode("#",$spt->kepada); 
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
                <?= $spt->kepada ?>
                <?php } ?>
               </td>
              <td style="width:10%;vertical-align:top;text-align:right">&nbsp;</td>
              <td style="width:20%;text-align:justify;vertical-align:top">&nbsp;</td>
          </tr>
          <tr>
              <td style="width:70%;vertical-align:top">Di</td>
              <td style="width:10%;vertical-align:top;text-align:right">&nbsp;</td>
              <td style="width:20%;text-align:justify;vertical-align:top">&nbsp;</td>
          </tr>
          <tr>
              <td style="width:70%;vertical-align:top;"><p style="margin-left:30px;margin-top:-10px"><?= $spt->lokasi_kepada ?></p></td>
              <td style="width:10%;vertical-align:top;text-align:right">&nbsp;</td>
              <td style="width:20%;text-align:justify;vertical-align:top">&nbsp;</td>
          </tr>
        </table>
        
        <table style="margin-left:5%;margin-top:10px;width:90%" border="0">
          <tr>
              <td colspan="3" style="width:100%;vertical-align:top;line-height:1.5"><?= $spt->isi_surat ?></td>
          </tr>
        </table>
        
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
              <td style="text-align:justify;vertical-align:top"><?= $kabalai->jabatan ?></td>
          </tr>
          <tr>
              <td style="vertical-align:top;text-align:center"><img style="height:80px; width:auto" src="<?= base_url() ?>asset/file_lainnya/qr_code_surat/<?= $spt->id_buat_surat ?>.png"></td>
              <td style="text-align:justify;vertical-align:top"><img style="height:100px; width:auto" src="<?= base_url().$kabalai->ttd ?>"></td>
          </tr>
          <tr>
              <td style="vertical-align:top">&nbsp;</td>
              <td style="text-align:justify;vertical-align:top"><b><?= $kabalai->nama ?></b></td>
          </tr>
          <tr>
              <td style="vertical-align:top">&nbsp;</td>
              <td style="text-align:justify;vertical-align:top;padding-top:0px">NIP. <?= $kabalai->nip ?></td>
          </tr>
        </table>
        
        <table style="margin-left:5%;margin-top:10px;width:90%" border="0">
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
     	</body>
	</html>