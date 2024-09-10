<html> 
<style>
     p{
        font-family:'Bookman Old Style',serif;
        font-size:12pt;
        }

        table,tr,td{
        font-family:'Bookman Old Style',serif;
        font-size:12pt;
        border-collapse:collapse;
        /*
        padding-left:3px;
        padding-right:1px;
        border-collapse:collapse;
        padding:3px;
        border:1px solid black;
        */
        }
        
        ul,ol{
            font-family:'Bookman Old Style',serif;
            font-size:12pt;
            margin-left:-15px;
        } 
        
        .no_srt{
            margin-top:-20px;
        }
        
        .dipa{
            margin-top:-15px;
            font-size:11pt;
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
        .tblx tr td {
        border-collapse: collapse;
        border-width: 1px;
        border-color: black;
        border-style: solid;
        font-family:Arial;
        font-size:11pt;
        padding-left:5px;
        padding-right:5px;
        }
</style>
	<body>
	   <?php
	        if($spt->id_verif!=0){
                $kabalai = $this->model_sitas->rowDataBy("b.struktur,b.for_ttd,c.nama,c.nip",
                                "pejabat_verifikator a inner join struktur_organisasi b on a.id_pegawai=b.id_pegawai inner join pegawai c on b.id_pegawai=c.id_pegawai",
                                "b.id_pegawai = $spt->id_verif")->row();
            } else {
                $kabalai = $this->model_sitas->rowDataBy("b.struktur,b.for_ttd,c.nama,c.nip",
                                "pejabat_verifikator a inner join struktur_organisasi b on a.id_pegawai=b.id_pegawai inner join pegawai c on b.id_pegawai=c.id_pegawai",
                                "a.level = 'akhir'")->row();
            }
            $pimpinan = $this->model_sitas->rowDataBy("id_pegawai","struktur_organisasi","struktur='Kepala Balai'")->row();
            $cek_pim = $this->model_sitas->rowDataBy("id_pegawai","anggota_spt","id_spt = $spt->id_spt and id_pegawai = $pimpinan->id_pegawai")->num_rows();
            if($cek_pim > 0){
                $pejabat_ttd = "An. Kepala Pusat Standardisasi<br>Instrumen Perkebunan,";
            } else {
                $pejabat_ttd = $kabalai->struktur;
            }
            $tgl_in = $spt->tanggal_input;
            $pc_tgl_in = explode("-",$tgl_in); 
            $bln = $pc_tgl_in[1];
            $thn = $pc_tgl_in[0];
            $no_sub = "TU.040";
            $arr_dasar = clir_ul_li($spt->dasar);
        ?>
		<div><img style="width:100%" src="<?php echo base_url().'asset/kop_surat1.png' ?>"></div>
		<!--<div><img style="position:absolute;top:300px;left:200px" src="<?php echo base_url().'asset/file_lainnya/cap_bptp.png' ?>"></div>-->
		<p style="text-align:center;margin-top:0px"><b>SURAT TUGAS</b></p>
		<p style="text-align:center;margin-top:-10px"><b>Nomor : B-<?= $sk->no_surat_keluar ?>/<?= $no_sub ?>/H.4.2/<?= $bln ?>/<?= $thn ?></b></p>
		<table style="margin-left:3%;margin-top:10px;width:95%" border="0">
          <tr>
              <td style="width:25%;vertical-align:top">Menimbang</td>
              <td style="width:5%;vertical-align:top;text-align:right">:</td>
              <td style="width:70%;text-align:justify;vertical-align:top"><ol type="a" style="text-align:justify"><li><?= $spt->menimbang ?></li></ol></td>
          </tr>
          <tr>
              <td style="vertical-align:top">Dasar</td>
              <td style="vertical-align:top;text-align:right">:</td>
              <td style="text-align:justify;vertical-align:top">
                    <ol type="a" style="text-align:justify">
                    <?php
                    foreach($arr_dasar as $ads){
                    ?>
                    <li><?= $ads ?></li>
                    <?php
                    }  
                    ?>
                    </ol>
              </td>
          </tr>
        </table>
        
        <p style="text-align:center;margin-top:10px">Memberi Tugas</p>
        <table style="margin-left:3%;margin-top:10px;margin-bottom:10px;width:95%" border="0">
          <tr>
              <td colspan="3" style="width:100%;vertical-align:top">Kepada</td>
          </tr>
        </table>
        <table style="margin-left:3%;width:95%" class="tblx">
            <tr>
                <td style="text-align:center;width:3%"><b>No</b></td>
                <td style="text-align:center;width:27%"><b>Nama</b></td>
                <td style="text-align:center;width:10%"><b>Pangkat/<br>Gol Ruang</b></td>
                <td style="text-align:center;width:15%"><b>NIP</b></td>
                <td style="text-align:center;width:15%"><b>Jabatan</b></td>
                <td style="text-align:center;width:30%"><b>Unit Kerja</b></td>
            </tr>
            <?php
                $nox = 1;
                foreach($peg as $pg){
                    $tgl_plk = $pg->tanggal_spt;
                    if($pg->is_internal == 1){
                        $get_pg = $this->model_sitas->rowDataBy("pangkat,gol,nip,jabatan","pegawai","id_pegawai=$pg->id_pegawai")->row();
                        $pangkat_gol = $get_pg->pangkat."/".$get_pg->gol;
                        $nip = $get_pg->nip;
                        $jabatan = $get_pg->jabatan;
                    } else {
                        $pangkat_gol = $pg->pangkat."/".$pg->gol;
                        $nip = $pg->nip;
                        $jabatan = $pg->jabatan;
                    }
            ?>
            <tr>
                <td style="text-align:center"><?= $nox ?></td>
                <td><?= konversi_nama_peg($pg->nama) ?></td>
                <td><?= ucwords($pangkat_gol) ?></td>
                <td><?= br_str($nip) ?></td>
                <td><?= ucwords(strtolower($jabatan)) ?></td>
                <td><?= $pg->uk ?></td>
            </tr>
            <?php
                $nox++;
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
        </table>
        <table style="margin-left:3%;margin-top:10px;width:95%" border="0">
          <tr>
              <td style="width:25%;vertical-align:top">Untuk</td>
              <td style="width:5%;vertical-align:top;text-align:right">:</td>
              <td style="width:70%;text-align:justify;vertical-align:top">
                <?= $spt->untuk ?>, pada Tanggal <?= $val_tgl ?>
              </td>
          </tr>
        </table>
        
        <table style="margin-left:3%;margin-top:30px;width:95%" border="0">
          <tr>
              <td style="width:60%;vertical-align:top">&nbsp;</td>
              <td style="width:40%;text-align:justify;vertical-align:top">Malang, <?= tgl_indoo($tgl_in) ?></td>
          </tr>
          <?php if($kabalai->for_ttd!=""){ ?>
          <tr>
              <td style="vertical-align:top">&nbsp;</td>
              <td style="text-align:justify;vertical-align:top"><?= $kabalai->for_ttd ?></td>
          </tr>
          <?php } ?>
          <tr>
              <td style="vertical-align:top">&nbsp;</td>
              <td style="text-align:justify;vertical-align:top"><?= $pejabat_ttd ?></td>
          </tr>
          <tr>
              <td style="vertical-align:top;text-align:center">
                <?php if($sk->id_verif != 0){ ?>  
                <img style="height:80px; width:auto" src="<?= base_url() ?>asset/qr_code/surat_keluar_<?= $spt->id_surat_keluar ?>.png">
                <?php } else { ?>
                    <img style="height:80px; width:auto" src="<?= base_url() ?>asset/no_ttd.jpg">
                <?php } ?>
              </td>
              <td style="text-align:justify;vertical-align:top"><!--ttd --></td>
              
          </tr>
          <tr>
              <td style="vertical-align:top">&nbsp;</td>
              <td style="text-align:justify;vertical-align:top"><b><?= konversi_nama_peg($kabalai->nama) ?></b></td>
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