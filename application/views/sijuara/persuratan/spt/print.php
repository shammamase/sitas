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
            }
            $tgl_in = substr($spt->tanggal_input,0,10);
            $pc_tgl_in = explode("-",$tgl_in); 
            $bln = $pc_tgl_in[1];
            $thn = $pc_tgl_in[0];
            $no_sub = $this->model_more->get_sub_arsip($spt->id_arsip)->row();
            if(!empty($no_surat)){
                $no_srt = $no_surat->no_surat_keluar;
            } else {
                $no_srt = " - ";
            }
            
            if($spt->is_dipa=="1"){
                $dipa = "<ul class='dipa'><li>DIPA BPTP Gorontalo ".$thn."</li></ul>";
            } else {
                $dipa = "";
            }
        ?>
		<div><img style="width:100%" src="<?php echo base_url().'asset/kop_iso.jpg' ?>"></div>
		<!--<div><img style="position:absolute;top:300px;left:200px" src="<?php echo base_url().'asset/file_lainnya/cap_bptp.png' ?>"></div>-->
		<p style="text-align:center;margin-top:0px"><b>SURAT TUGAS</b></p>
		<p style="text-align:center;margin-top:-10px">Nomor : <?= $no_srt ?>/<?= $no_sub->kode_sub_arsip ?>/H.10.29/<?= $bln ?>/<?= $thn ?></p>
		<table style="margin-left:5%;margin-top:10px;width:60%" border="0">
          <tr>
              <td style="width:40%;vertical-align:top">Menimbang</td>
              <td style="width:10%;vertical-align:top;text-align:right">:</td>
              <td style="width:90%;text-align:justify;vertical-align:top"><?= $spt->menimbang ?></td>
          </tr>
          <tr>
              <td style="vertical-align:top">Dasar</td>
              <td style="vertical-align:top;text-align:right">:</td>
              <td style="text-align:justify;vertical-align:top"><?= $spt->dasar.$dipa ?></td>
          </tr>
        </table>
        
        <p style="text-align:center;margin-top:0px"><b>MEMBERI TUGAS</b></p>
        <table style="margin-left:5%;margin-top:10px;width:60%" border="0">
          <tr>
              <td style="width:40%;vertical-align:top">Kepada</td>
              <td style="width:10%;vertical-align:top;text-align:right">:</td>
              <td style="width:90%;text-align:justify;vertical-align:top">
                <ol style="text-align:justify">
                    <?php
                        foreach($peg as $pg){
                            $tgl_plk = $pg->tanggal;
                    ?>
                    <li><?= $pg->nama ?></li>
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
                </ol>
              </td>
          </tr>
          <tr>
              <td style="vertical-align:top">Untuk</td>
              <td style="vertical-align:top;text-align:right">:</td>
              <td style="text-align:justify;vertical-align:top">
                  <ol style="text-align:justify">
                    <!--mengatur jarak ul ol <li style="padding-bottom:5px;line-height:1.2"><?= $spt->untuk ?>, pada Tanggal <?= $val_tgl ?></li>-->
                    <li><?= $spt->untuk ?>, pada Tanggal <?= $val_tgl ?></li>
                    <li>Setelah melakukan perjalanan dinas agar menyerahkan laporan perjalanan dinas</li>
                    <li>Agar melaksanakan tugas dengan penuh rasa tanggung jawab</li>
                </ol>
              </td>
          </tr>
        </table>
        
        <table style="margin-left:30%;margin-top:10px;width:60%" border="0">
          <tr>
              <td style="width:50%;vertical-align:top">&nbsp;</td>
              <td style="width:50%;text-align:justify;vertical-align:top">Gorontalo, <?= tgl_indoo($tgl_in) ?></td>
          </tr>
          
          <tr>
              <td style="vertical-align:top">&nbsp;</td>
              <td style="text-align:justify;vertical-align:top"><?= $kabalai->for_ttd ?></td>
          </tr>
          <tr>
              <td style="vertical-align:top">&nbsp;</td>
              <td style="text-align:justify;vertical-align:top"><?= $kabalai->jabatan ?></td>
          </tr>
          <tr>
              <td style="vertical-align:top;text-align:center">
                  <img style="height:80px; width:auto" src="<?= base_url() ?>asset/file_lainnya/qr_code_spt/<?= $spt->id_spt ?>.png">
              </td>
              <td style="text-align:justify;vertical-align:top"><img src="<?= base_url().$kabalai->ttd ?>"></td>
              
          </tr>
          <tr>
              <td style="vertical-align:top">&nbsp;</td>
              <td style="text-align:justify;vertical-align:top"><b><?= $kabalai->nama ?></b></td>
          </tr>
          <tr>
              <td style="vertical-align:top">&nbsp;</td>
              <td style="text-align:justify;vertical-align:top">NIP. <?= $kabalai->nip ?></td>
          </tr>
          
        </table>
        <!--<img class="capx" src="<?= base_url() ?>asset/file_lainnya/cap_bptp_jp.jpg">-->
        <!--<img style="position:absolute;opacity:0.1;top:600px;left:390px;height:200px;width:auto;" src="<?= base_url() ?>asset/file_lainnya/cap_bptp_jp.jpg">-->
     	</body>
	</html>