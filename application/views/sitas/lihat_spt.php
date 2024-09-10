<style>
    @media only screen and (max-width: 600px){
        p{
        font-family:Arial;
        font-size:9pt;
        }
        
        ul,ol{
            font-family:Arial;
            font-size:9pt;
            margin-left:-20px;
        }

        .no_srt{
            margin-top:-20px;
        }
        
        .dipa{
            margin-top:-15px;
            font-size:9pt;
        }
        .tblx tr td {
        border-collapse: collapse;
        border-width: 1px;
        border-color: black;
        border-style: solid;
        font-size:7pt;
        font-family:Arial;
        }
    }
    
    @media only screen and (min-width: 600px){
        p{
        font-family:Arial;
        font-size:9pt;
        }
        
        ul,ol{
            font-family:Arial;
            font-size:9pt;
            margin-left:-15px;
        }
        
        .no_srt{
            margin-top:-20px;
        }
        
        .dipa{
            margin-top:-20px;
            font-size:9pt;
        }
        .tblx tr td {
        border-collapse: collapse;
        border-width: 1px;
        border-color: black;
        border-style: solid;
        font-size:7pt;
        font-family:Arial;
        }
    }
    
    @media only screen and (min-width: 768px){
        p{
        font-family:Arial;
        font-size:12pt;
        }
        
        ul,ol{
            font-family:Arial;
            font-size:12pt;
            margin-left:-15px;
        } 
        
        .no_srt{
            margin-top:-20px;
        }
        
        .dipa{
            margin-top:-15px;
            font-size:12pt;
        }
        .tblx tr td {
        border-collapse: collapse;
        border-width: 1px;
        border-color: black;
        border-style: solid;
        font-size:9pt;
        font-family:Arial;
        }
    }
    
    @media only screen and (min-width: 992px){
        p{
        font-family:Arial;
        font-size:12pt;
        }
        
        ul,ol{
            font-family:Arial;
            font-size:12pt;
            margin-left:-15px;
        } 
        
        .no_srt{
            margin-top:-20px;
        }
        
        .dipa{
            margin-top:-15px;
            font-size:12pt;
        }
        .tblx tr td {
        border-collapse: collapse;
        border-width: 1px;
        border-color: black;
        border-style: solid;
        font-size:12pt;
        font-family:Arial;
        }
    }
    
    @media only screen and (min-width: 1200px){
        p{
        font-family:Arial;
        font-size:12pt;
        }
        
        ul,ol{
            font-family:Arial;
            font-size:12pt;
            margin-left:-15px;
        } 
        
        .no_srt{
            margin-top:-20px;
        }
        
        .dipa{
            margin-top:-15px;
            font-size:12pt;
        }
        .tblx tr td {
        border-collapse: collapse;
        border-width: 1px;
        border-color: black;
        border-style: solid;
        font-size:12pt;
        font-family:Arial;
        }
    }
    
</style>
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
        $pejabat_ttd = "<p style='line-height:1.2'>An. Kepala Pusat Standardisasi<br>Instrumen Perkebunan,</p>";
    } else {
        $pejabat_ttd = "<p>".$kabalai->struktur."</p>";
    }
    $tgl_in = $spt->tanggal_input;
    $pc_tgl_in = explode("-",$tgl_in); 
    $bln = $pc_tgl_in[1];
    $thn = $pc_tgl_in[0];
    $no_sub = "TU.040";
    $arr_dasar = clir_ul_li($spt->dasar);
    
    /*
    if($spt->is_dipa=="1"){
        $dipa = "<ul class='dipa'><li>DIPA BPSI TAS Tahun ".$thn." Nomor:018.09.2.237572/".$thn.", Tanggal 30 November 2023</li></ul>";
    } else {
        $dipa = "";
    }
    */
?>
<img style="width:100%" src="<?= base_url() ?>asset/kop_surat1.png">
<div class="row">
    <div class="col-md-12 col-12"><p  style="text-align:center"><b><u>SURAT TUGAS</u></b></p></div>
    <div class="col-md-12 col-12 no_srt"><p  style="text-align:center"><b>Nomor : -/<?= $no_sub ?>/H.4.2/<?= $bln ?>/<?= $thn ?></b></p></div>
    
    <div class="col-md-3 col-3"><p style="text-align:left">Menimbang</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-8 col-8"><ol type="a" style="text-align:justify"><li><?= $spt->menimbang ?></li></ol></div>
    
    <div class="col-md-3 col-3"><p style="text-align:left">Dasar</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-8 col-8">
        <ol type="a" style="text-align:justify">
        <?php
        foreach($arr_dasar as $ads){
        ?>
        <li><?= $ads ?></li>
        <?php
        }  
        ?>
        </ol>
    </div>
    
    <div class="col-md-12 col-12"><p  style="text-align:center">Memberi Tugas</p></div>

    <div class="col-md-12 col-12"><p style="text-align:left">Kepada</p></div> 
    <div style="margin-bottom:20px" class="col-md-12 col-12">
        <table style="width:100%" class="tblx">
            <tr>
                <td style="text-align:center"><b>No</b></td>
                <td style="text-align:center"><b>Nama</b></td>
                <td style="text-align:center"><b>Pangkat/<br>Gol Ruang</b></td>
                <td style="text-align:center"><b>NIP</b></td>
                <td style="text-align:center"><b>Jabatan</b></td>
                <td style="text-align:center"><b>Unit Kerja</b></td>
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
                <td style="padding:5px"><?= $nox ?></td>
                <td style="padding:5px"><?= konversi_nama_peg($pg->nama) ?></td>
                <td style="padding:5px"><?= wordwrap(ucwords(strtolower($pangkat_gol)),10,"<br /> \n") ?></td>
                <td style="padding:5px;text-align:center"><?= $nip ?></td>
                <td style="padding:5px;text-align:center"><?= ucwords(strtolower($jabatan)) ?></td>
                <td style="padding:5px;text-align:justify"><?= wordwrap($pg->uk,35,"<br />\n") ?></td>
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
    </div>
    <div class="col-md-3 col-3"><p style="text-align:left">Untuk</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-8 col-8"><p style="text-align:justify"><?= $spt->untuk ?>, pada Tanggal <?= $val_tgl ?></p></div>
    
    <div class="col-md-6 col-6" style="background:#ffffff"></div>
    <div class="col-md-6 col-6"><p>Malang, <?= tgl_indoo($tgl_in) ?></p></div>
    
    <div class="col-md-6 col-6" style="background:#ffffff"></div>
    <div class="col-md-6 col-6 no_srt"><p><?= $kabalai->for_ttd ?></p></div>
    
    <div class="col-md-6 col-6" style="background:#ffffff"></div>
    <div class="col-md-6 col-6 no_srt"><?= $pejabat_ttd ?></div>
    <!--
    <div class="col-md-8 col-8" style="background:#ffffff"></div>
    <div class="col-md-1 col-1"><p style="text-align:right"><img src="<?= base_url().$kabalai->ttd ?>"></p></div>
    <div class="col-md-3 col-3" style="background:#ffffff"></div>
    -->
    
    <div class="col-md-6 col-6" style="background:#ffffff"></div>
    <div class="col-md-6 col-6"><p><b><?= $kabalai->nama ?></b></p></div>
    
    <div class="col-md-6 col-6" style="background:#ffffff"></div>
    <div class="col-md-6 col-6 no_srt"><p>NIP. <?= $kabalai->nip ?></p></div>
</div>