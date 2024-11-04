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
    <div class="col-md-7 col-2"></div> 
    <div class="col-md-1 col-2">Nomor</div>
    <div class="col-md-1 col-1">:</div> 
    <div class="col-md-3 col-7">B-001/KD.00/H.4.2/<?= $bln ?>/<?= $thn ?></div>
    <div class="col-md-7 col-2"></div> 
    <div class="col-md-1 col-2">Tanggal</div>
    <div class="col-md-1 col-1">:</div>
    <div class="col-md-3 col-7"><?= tgl_indoo(date('Y-m-d')) ?></div>
     
        
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
</div>