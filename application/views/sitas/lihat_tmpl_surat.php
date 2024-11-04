<style>
    @media only screen and (max-width: 600px){
        p{
        font-family:Arial;
        font-size:9pt;
        }
        ul{
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
        
        .geser_kiri{
            margin-left:-60px;
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
        
        .geser_kiri{
            margin-left:-70px;
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
        
        .geser_kiri{
            margin-left:-80px;
        }
    }
    
</style>
<?php
    $tgl_in = date('Y-m-d');
    $pc_tgl_in = explode("-",$tgl_in); 
    $bln = $pc_tgl_in[1];
    $thn = $pc_tgl_in[0];
?>
<div class="row">
    <div style="margin-bottom:10px" class="col-md-12 col-12"><img style="width:100%" src="<?php echo base_url().'asset/kop_surat1.png' ?>"></div>
    <div class="col-md-3 col-2"><p style="text-align:left">Nomor</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:left">:</p></div> 
    <div class="col-md-5 col-6 geser_kiri"><p style="text-align:left"> B-001/KD.00/H.4.2/<?= $bln ?>/<?= $thn ?></p></div>
    <div class="col-md-3 col-3"><p style="text-align:right"><?= tgl_indo(date('Y-m-d')) ?></p></div>
    
    <div class="col-md-3 col-2 no_srt"><p style="text-align:left">Sifat</p></div> 
    <div class="col-md-1 col-1 no_srt"><p style="text-align:left">:</p></div> 
    <div class="col-md-8 col-9 no_srt geser_kiri"><p>Biasa</p></div>

    <div class="col-md-3 col-2 no_srt"><p style="text-align:left">Lampiran</p></div> 
    <div class="col-md-1 col-1 no_srt"><p style="text-align:left">:</p></div> 
    <div class="col-md-8 col-9 no_srt geser_kiri"><p>1 Berkas</p></div>
    
    <div class="col-md-3 col-2 no_srt"><p style="text-align:left">Hal</p></div> 
    <div class="col-md-1 col-1 no_srt"><p style="text-align:left">:</p></div> 
    <div class="col-md-8 col-9 no_srt geser_kiri"><p>Isi Perihal</p></div>
    
    <div class="col-md-12 col-12"><p style="text-align:left">Yth. Dinas Pertanian Provinsi</p></div> 
    
    <div class="col-md-12 col-12 no_srt"><p style="text-align:left;">Kota</p></div> 
        
    <div class="col-md-12 col-12"><?= $get->isi ?></div> 
    
    <div class="col-md-8 col-7" style="background:#ffffff"></div>
    <div class="col-md-4 col-5"><p>Kota, <?= tgl_indoo(date('Y-m-d')) ?></p></div>
    
    <div class="col-md-8 col-7" style="background:#ffffff"></div>
    <div class="col-md-4 col-5 no_srt"><p></p></div>
    
    <div class="col-md-8 col-7" style="background:#ffffff"></div>
    <div class="col-md-4 col-5 no_srt"><p>Kepala Balai</p></div>
    <!--
    <div class="col-md-8 col-8" style="background:#ffffff"></div>
    <div class="col-md-1 col-1"><p style="text-align:right"><img src="<?= base_url().$kabalai->ttd ?>"></p></div>
    <div class="col-md-3 col-3" style="background:#ffffff"></div>
    -->
    
    <div class="col-md-8 col-7" style="background:#ffffff"></div>
    <div class="col-md-4 col-5"><p><b>Nama Kepala Balai</b></p></div>
    
    <div class="col-md-8 col-7" style="background:#ffffff"></div>
    <div class="col-md-4 col-5 no_srt"><p>NIP. 1234567891011</p></div>
    
    <div class="col-md-12 col-12">
        <b>Tembusan :</b>
    </div> 
    
    <div class="col-md-12 col-12">
        <ol>
            <li>Tembusan 1</li>
            <li>Tembusan 2</li>
        </ol>
    </div> 
</div>