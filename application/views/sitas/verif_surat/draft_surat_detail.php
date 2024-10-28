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
    $tgl_in = $spt->tanggal;
    $pc_tgl_in = explode("-",$tgl_in); 
    $bln = $pc_tgl_in[1];
    $thn = $pc_tgl_in[0];
    $no_sub = $this->model_sitas->get_sub_arsip($spt->id_sub_arsip);
    if($spt->lampiran == 0){
        $lamp = "-";
    } else {
        $lamp = $spt->lampiran." berkas";
    }
?>
<div class="card card-success">
<div class="card-header">
    <h3 class="card-title">Surat</h3>
</div>
<div class="card-body">
<div class="row">
    <div class="col-md-3 col-3"><p style="text-align:left">Nomor</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:left">:</p></div> 
    <div class="col-md-5 col-5 geser_kiri"><p style="text-align:left"> /<?= $no_sub->kode_sub_arsip ?>/H.4.2/<?= $bln ?>/<?= $thn ?></p></div>
    <div class="col-md-3 col-3"><p style="text-align:right"><?= tgl_indo($spt->tanggal) ?></p></div>
    
    <div class="col-md-3 col-3 no_srt"><p style="text-align:left">Lampiran</p></div> 
    <div class="col-md-1 col-1 no_srt"><p style="text-align:left">:</p></div> 
    <div class="col-md-8 col-8 no_srt geser_kiri"><p><?= $lamp ?></p></div>
    
    <div class="col-md-3 col-3 no_srt"><p style="text-align:left">Hal</p></div> 
    <div class="col-md-1 col-1 no_srt"><p style="text-align:left">:</p></div> 
    <div class="col-md-8 col-8 no_srt geser_kiri"><p><?= $spt->perihal ?></p></div>
    
    <div class="col-md-12 col-12"><p style="text-align:left">Yth.<?= $spt->tujuan_surat ?></p></div> 
    
    <div class="col-md-12 col-12 no_srt"><p style="text-align:left;"><?= $spt->lokasi_tujuan_surat ?></p></div> 
        
    <div class="col-md-12 col-12"><?= $spt->isi_surat ?></div> 
    
    <div class="col-md-6 col-6" style="background:#ffffff"></div>
    <div class="col-md-6 col-6"><p>Malang, <?= tgl_indoo($tgl_in) ?></p></div>
    
    <div class="col-md-6 col-6" style="background:#ffffff"></div>
    <div class="col-md-6 col-6 no_srt"><p><?= $kabalai->for_ttd ?></p></div>
    
    <div class="col-md-6 col-6" style="background:#ffffff"></div>
    <div class="col-md-6 col-6 no_srt"><p><?= $kabalai->struktur ?></p></div>
    <!--
    <div class="col-md-8 col-8" style="background:#ffffff"></div>
    <div class="col-md-1 col-1"><p style="text-align:right"><img src="<?= base_url().$kabalai->ttd ?>"></p></div>
    <div class="col-md-3 col-3" style="background:#ffffff"></div>
    -->
    
    <div class="col-md-6 col-6" style="background:#ffffff"></div>
    <div class="col-md-6 col-6"><p><b><?= $kabalai->nama ?></b></p></div>
    
    <div class="col-md-6 col-6" style="background:#ffffff"></div>
    <div class="col-md-6 col-6 no_srt"><p>NIP. <?= $kabalai->nip ?></p></div>
    
    <div class="col-md-12 col-12">
        <?php
            if(!empty($spt->tembusan)){
                $tmb = "<b>Tembusan :</b>";
            } else {
                $tmb = "";
            }
            echo $tmb;
        ?>
    </div> 
    
    <div class="col-md-12 col-12">
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
    </div> 
</div>
</div>
<div class="card-footer">
    <?php 
        if($spt->user == NULL){
            $konseptor = "";
        } else {
            $konseptor = ucwords(strtolower($this->model_sitas->get_user_by($spt->user)->nama));
        }
         
    ?>
    <b>Konseptor</b> : <i><?= $konseptor ?></i>
</div>
</div>
<a class="btn btn-success" data-target="#setuju" data-toggle="modal">Setuju</a>
<button class="btn btn-danger" data-target="#tolak" data-toggle="modal">Tolak</button>
<br><br>
<?php if ($cek_data_lamp){ ?>
    <?php $no_lamp = 1; foreach($lampiran as $lp) { ?>
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Lampiran <?= $no_lamp ?></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-12"><?= $lp->deskripsi ?></div>
                </div>
            </div>
        <div>
    <?php $no_lamp++; } ?>
<?php } ?>
<?php if ($file_lampiran != ""){ ?>
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">File Lampiran</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-12">
                    <iframe style="height:600px;width:100%" src="<?= base_url() ?>asset/lampiran/<?= $file_lampiran ?>"></iframe>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="modal fade" id="setuju" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Keterangan :</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="" method="post" action="<?= base_url() ?>sekunder/setuju_surat_awal">
              <input type="hidden" name="id_buat_surat" value="<?= $spt->id_surat_keluar ?>">
              <div class="form-group">
                  <textarea class="form-control" name="keterangan"></textarea>
              </div>
              <button type="submit" name="submit" class="btn btn-danger">Setuju</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<div class="modal fade" id="tolak" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tolak :</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="" method="post" action="<?= base_url() ?>sekunder/tolak_surat_awal">
              <input type="hidden" name="id_buat_surat" value="<?= $spt->id_surat_keluar ?>">
              <div class="form-group">
                  <textarea class="form-control" name="alasan_tolak" required></textarea>
              </div>
              <button type="submit" name="submit" class="btn btn-danger">Tolak</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>