<style>
    @media only screen and (max-width: 600px){
        p{
        font-family:Arial;
        font-size:9pt;
        }
        
        ol{
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
    }
    
    @media only screen and (min-width: 600px){
        p{
        font-family:Arial;
        font-size:9pt;
        }
        
        ol{
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
    }
    
    @media only screen and (min-width: 768px){
        p{
        font-family:Arial;
        font-size:12pt;
        }
        
        ol{
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
    }
    
    @media only screen and (min-width: 992px){
        p{
        font-family:Arial;
        font-size:12pt;
        }
        
        ol{
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
    }
    
    @media only screen and (min-width: 1200px){
        p{
        font-family:Arial;
        font-size:12pt;
        }
        
        ol{
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
    }
    
</style>
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
<img class="img-fluid" style="width:100%" src="<?= base_url() ?>asset/kop_surat1.png">
<div class="row">
    <div class="col-md-12 col-12"><p  style="text-align:center"><b><u>LAPORAN PERJALANAN DINAS</u></b></p></div>
    <div class="col-md-12 col-12 no_srt"><p  style="text-align:center">SPT NO. <?= $no_srt ?>/TU.040/H.4.2/<?= $bln ?>/<?= $thn ?></p></div>
    
    <div class="col-md-4 col-4"><p style="text-align:left">1. Nama</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div>
    <div class="col-md-7 col-7">
        <ol>
        <?php
                foreach($peg as $pg){
                    $tgl_plk = $pg->tanggal_spt;
            ?>
                <li><?= konversi_nama_peg($pg->nama) ?></li>
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
    </div>
    
    <div class="col-md-4 col-4"><p style="text-align:left">2. Tujuan</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-7 col-7"><p style="text-align:justify"><?= $lap_spt->lokasi ?></p></div>
    <!--
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-3 col-3"><p style="text-align:left">3. Judul Tolak Ukur Kegiatan</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-6 col-6"><?= $lap_spt->tolak_ukur_kegiatan ?></div>
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    -->
    <div class="col-md-4 col-4"><p style="text-align:left">3. Lama Perjalanan</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-7 col-7"><p style="text-align:justify"><?= $spt->lama_hari ?> Hari, Tanggal <?= $val_tgl ?></p></div>
    
    <div class="col-md-4 col-4"><p style="text-align:left">4. Transportasi</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-7 col-7"><p style="text-align:justify"><?= $lap_spt->transportasi ?></p></div>
    
    <div class="col-md-4 col-4"><p style="text-align:left">5. Untuk</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-7 col-7"><p style="text-align:justify"><?= $spt->untuk ?></p></div>
    
    <div class="col-md-4 col-4"><p style="text-align:left">6. Uraian Perjadin</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-7 col-7" style="background:#ffffff"></div>
    
    <div class="col-md-12 col-12"><?= stripslashes($lap_spt->uraian) ?></div>
    
    <div class="col-md-12 col-12"><b>Dokumentasi</b></div>
    
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-10 col-10">
        <div class="row">
            <?php 
                $pc_nf = explode(",",$lap_spt->gbr_dok);
                foreach($pc_nf as $value){
          ?>
          <div style="margin-bottom:10px" class="col-6 col-lg-6 col-md-6"><img class="img-fluid" src="<?= base_url() ?>asset/lap_spt/<?= $value ?>"></div>
          <?php
                }
          ?>
        </div>
    </div>
    
    <div class="col-md-7 col-7" style="background:#ffffff"></div>
    <div class="col-md-5 col-5"><p>Malang, <?= tgl_indoo($tgl_in) ?></p></div>
    
    <div class="col-md-7 col-7 no_srt"><p>Yang Membuat</p></div>
    <div class="col-md-5 col-5 no_srt"><p><?= $kabalai->for_ttd ?></p></div>
    
    <div class="col-md-7 col-7 no_srt" style="background:#ffffff"></div>
    <div class="col-md-5 col-5 no_srt"><p><?= $kabalai->struktur ?></p></div>
    
    <!--
    <div class="col-md-8 col-8" style="background:#ffffff"></div>
    <div class="col-md-1 col-1"><p style="text-align:right"><img src="<?= base_url().$kabalai->ttd ?>"></p></div>
    <div class="col-md-3 col-3" style="background:#ffffff"></div>
    -->
    <div class="col-md-12 col-12" style="background:#ffffff">&nbsp;</div>
    <div class="col-md-7 col-7 no_srt"><p><b><?= konversi_nama_peg($user->nama) ?></b></p></div>
    <div class="col-md-5 col-5 no_srt"><p><b><?= konversi_nama_peg($kabalai->nama) ?></b></p></div>
    
    <div class="col-md-7 col-7 no_srt"><p><?= $user->nip ?></p></div>
    <div class="col-md-5 col-5 no_srt"><p><?= $kabalai->nip ?></p></div>
    
    <!--
    <div class="col-md-8 col-8" style="background:#ffffff"></div>
    <div class="col-md-4 col-4"><p><b><?= $kabalai->nama ?></b></p></div>
    
    <div class="col-md-8 col-8" style="background:#ffffff"></div>
    <div class="col-md-4 col-4 no_srt"><p>NIP. <?= $kabalai->nip ?></p></div>
    -->
</div>