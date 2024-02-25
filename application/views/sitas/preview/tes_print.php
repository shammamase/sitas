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
        .table-bordered tr td {
        border-collapse: collapse;
        border-width: 1px;
        border-color: black;
        border-style: solid;
        }

        .table-bordered{
            margin-top:-30px;
            margin-bottom:20px;
        }
</style>
	<body>
	   <?php
            if($spt->id_verif==0){
                $id_pjs = $this->db->query("select * from pejabat_verifikator where level = 'akhir'")->row();
                $kabalai = $this->model_sitas->rowDataBy("a.struktur,b.nama,b.nip",
                                "struktur_organisasi a inner join pegawai b on a.id_pegawai=b.id_pegawai",
                                "a.id_pegawai = $id_pjs->id_pegawai")->row();
            } else {
                $kabalai = $this->model_sitas->rowDataBy("a.struktur,b.nama,b.nip",
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
		<div><img style="width:100%" src="<?php echo base_url().'asset/kop_surat.png' ?>"></div>
		<table style="margin-left:5%;margin-top:10px;width:87%" border="0">
          <tr>
              <td style="width:15%;vertical-align:top">Nomor</td>
              <td style="width:5%;vertical-align:top;text-align:left">:</td>
              <td style="width:55%;text-align:justify;vertical-align:top"><?= $no_srt ?>/<?= $no_sub->kode_sub_arsip ?>/H.4.2/<?= $bln ?>/<?= $thn ?></td>
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
              <td colspan="2" style="text-align:justify;vertical-align:top"><?= wordwrap($spt->perihal,50,"<br />\n") ?></td>
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
                <?= $spt->tujuan_surat ?>
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
              <td style="width:70%;vertical-align:top;"><p style="margin-left:30px;margin-top:-10px"><?= $spt->lokasi_tujuan_surat ?></p></td>
              <td style="width:10%;vertical-align:top;text-align:right">&nbsp;</td>
              <td style="width:20%;text-align:justify;vertical-align:top">&nbsp;</td>
          </tr>
        </table>
        <div style="margin-left:6%;margin-right:7%;margin-top:20px;padding-top:10px">
        <p><span style="font-family: Arial;">Sesuai dengan Peraturan Bersama Menteri Keuangan dan Kepala BPN RI Nomor 186/PMK.06/2009 dan Nomor 24 Tahun 2009 tentang Pensertifikatan Barang Milik Negara Berupa Tanah, dengan ini kami mohonkan Pengukuran Ulang dan Perubahan Nama Pemegang Hak Atas Tanah Barang Milik Negara yang baru atas nama Pemerintah Republik Indonesia cq. Kementerian Pertanian dengan daftar sertipikat, sebagai berikut:</span></p><p><span style="font-family: Arial;"><br></span></p>
        <table class="table table-bordered">
            <tbody>
                <tr><td>No.</td><td>Nama Pemegang Hak</td><td>Nomor Sertipikat</td><td>Luas (m2)</td><td>Alamat</td></tr>
                <tr><td>1.</td><td>Departemen Pertanian<br> Republik Indonesia</td><td>Hak Pakai No. 25 /<br> Kelurahan Purwantoro</td><td>353</td><td>Jl. Taman Indragiri, Blimbing,<br> Malang</td></tr>
            </tbody>
        </table><p><span style="font-family: Arial;">Demikian kami sampaikan, atas perhatian dan kerjasama yang baik,disampaikan terima kasih.</span></p><p><span style="font-family: Arial;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Malang, 13 Februari 2024</span></p><p><span style="font-family: Arial;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Kepala Balai,</span></p><p><span style="font-family: Arial;"><br></span></p><p><span style="font-family: Arial;"><br></span></p><p><span style="font-family: Arial;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Dr. Andy Wijanarko, SP., M. Si.</span></p><p><span style="font-family: Arial;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;NIP 197411152000031001</span></p><p><br></p>
        </div>
        <table style="margin-left:30%;margin-top:10px;width:60%" border="0">
          <!--
          <tr>
              <td style="width:50%;vertical-align:top">&nbsp;</td>
              <td style="width:50%;text-align:justify;vertical-align:top">Gorontalo, <?= tgl_indoo($tgl_in) ?></td>
          </tr>
          -->
          <tr>
              <td style="width:40%;vertical-align:top">&nbsp;</td>
              <td style="width:60%;text-align:justify;vertical-align:top"><?= $kabalai->struktur ?></td>
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
                    <td style="vertical-align:top;text-align:center"><!--<img style="height:80px; width:auto;" src="<?= base_url() ?>asset/file_lainnya/qr_code_surat/<?= $spt->id_buat_surat ?>.png">--></td>
                    <td style="text-align:justify;vertical-align:top">
                    <!--<img style="height:100px; width:auto;" src="<?= base_url().$kabalai->ttd ?>">-->
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
                    <td style="vertical-align:top;text-align:center"><!--<img style="height:80px; width:auto;" src="<?= base_url() ?>asset/file_lainnya/qr_code_surat/<?= $spt->id_buat_surat ?>.png">--></td>
                    <td style="text-align:justify;vertical-align:top">
                    <!--<img style="height:100px; width:auto;" src="<?= base_url().$kabalai->ttd ?>">-->
                    </td>
                    <?php
                }
            } else {
                ?>
                <td style="vertical-align:top;text-align:center">
                <!--<img style="height:80px; width:auto;" src="<?= base_url() ?>asset/file_lainnya/qr_code_surat/<?= $spt->id_buat_surat ?>.png">-->
                </td>
                <td style="text-align:justify;vertical-align:top">
                <!--<img style="height:100px; width:auto;" src="<?= base_url().$kabalai->ttd ?>">-->
                </td>
                <?php
            }
              ?>
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
        <?php 
        if($kabalai->struktur == "Kepala Balai" OR $kabalai->struktur == "Kasubag Tata Usaha"){ 
            if($spt->waktu_verif != ""){
        ?>
                <!--<img style="height:40px;width:auto" src="<?= base_url('asset/footer_tte3.png') ?>" alt="Gambar PNG" class="logo">-->
        <?php 
            }
        } 
        ?>
     	</body>
	</html>