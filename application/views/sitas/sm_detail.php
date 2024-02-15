<style>
    @media only screen and (max-width: 600px){
        iframe{
            height:300px;
            width:100%;
        }
        
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
        iframe{
            height:300px;
            width:100%;
        }
        
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
        iframe{
            height:400px;
            width:100%;
        }
        
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
    }
    
    @media only screen and (min-width: 992px){
        iframe{
            height:400px;
            width:100%;
        }
        
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
    }
    
    @media only screen and (min-width: 1200px){
        iframe{
            height:500px;
            width:100%;
        }
        
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
    }
    
</style>

<div class="card card-success">
<div class="card-header">
    <h3 class="card-title">Surat Masuk</h3>
</div>
<div class="card-body">

<div class="row">
    <div class="col-md-3 col-3"><p>Asal Surat</p></div>
    <div class="col-md-9 col-9"><p>: <?= $sm->asal_surat ?></p></div>
    <div class="col-md-3 col-3 no_srt"><p>Perihal Surat</p></div>
    <div class="col-md-9 col-9 no_srt"><p>: <?= $sm->perihal ?></p></div>
    <div class="col-md-3 col-3 no_srt"><p>Tanggal Surat</p></div>
    <div class="col-md-9 col-9 no_srt"><p>: <?= tgl_indoo($sm->tanggal) ?></p></div>
    <div class="col-md-3 col-3 no_srt"><p>Tanggal Masuk Surat</p></div>
    <div class="col-md-9 col-9 no_srt"><p>: <?= tgl_indoo($sm->tanggal_masuk) ?></p></div>
    <div class="col-md-3 col-3 no_srt"><p>Nomor Surat</p></div>
    <div class="col-md-9 col-9 no_srt"><p>: <?= $sm->no_surat_masuk ?></p></div>
    <div class="col-md-3 col-3 no_srt"><p>Disposisi</p></div>
    <div class="col-md-9 col-9 no_srt"><p>: <?= $sm->disposisi ?></p></div>
    <div class="col-md-3 col-3 no_srt">&nbsp;</div>
    <div class="col-md-9 col-9 no_srt"><p>: <?= $sm->isi_disposisi ?></p></div>
    <div class="col-md-3 col-3 no_srt"><p>Catatan</p></div>
    <div class="col-md-9 col-9 no_srt"><p>: <?= $sm->catatan ?></p></div>
    <!--
    <div class="col-md-12 col-12" style="margin-bottom:10px">
        <a target="_blank" class="btn btn-success" href="">Buat SPT</a>
        <a class="btn btn-info" href="">Balas Surat</a>
    </div>
    -->
    <div class="col-md-12 col-12">
        <iframe src="<?= base_url() ?>asset/surat_masuk/<?= $sm->file_pdf ?>"></iframe>
    </div>
    <div class="col-md-12 col-12">
        <iframe src="<?= base_url() ?>primer/file_disposisi/<?= $sm->id_surat_masuk ?>"></iframe>
    </div>
</div>

</div>
<div class="card-footer">
    
</div>
</div>