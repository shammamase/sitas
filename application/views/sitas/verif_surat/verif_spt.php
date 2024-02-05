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
    }
    
</style>
<?php
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
<div class="card card-success">
<div class="card-header">
    <h3 class="card-title">Surat Perintah Tugas</h3>
</div>
<div class="card-body">
<div class="row">
    <div class="col-md-12 col-12"><p  style="text-align:center"><b>SURAT TUGAS</b></p></div>
    <div class="col-md-12 col-12 no_srt"><p  style="text-align:center">Nomor : <?= $no_srt ?>/<?= $no_sub->kode_sub_arsip ?>/H.10.29/<?= $bln ?>/<?= $thn ?></p></div>
    
    <div class="col-md-1 col-1"></div>
    <div class="col-md-2 col-2"><p style="text-align:left">Menimbang</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-7 col-7"><p style="text-align:left"><?= $spt->menimbang ?></p></div>
    <div class="col-md-1 col-1"></div>
    
    <div class="col-md-1 col-1"></div>
    <div class="col-md-2 col-2"><p style="text-align:left">Dasar</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-7 col-7"><?= $spt->dasar.$dipa ?></div>
    <div class="col-md-1 col-1"></div>
    
    <div class="col-md-12 col-12"><p  style="text-align:center"><b>MEMBERI TUGAS</b></p></div>
    
    <div class="col-md-1 col-1"></div>
    <div class="col-md-2 col-2"><p style="text-align:left">Kepada</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-7 col-7">
        <ol>
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
        
    </div>
    
    <div class="col-md-1 col-1"></div>
    <div class="col-md-1 col-1"></div>
    <div class="col-md-2 col-2"><p style="text-align:left">Untuk</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-7 col-7">
        <ol>
            <li><?= $spt->untuk ?>, pada Tanggal <?= $val_tgl ?></li>
            <li>Setelah melakukan perjalanan dinas agar menyerahkan laporan perjalanan dinas</li>
            <li>Agar melaksanakan tugas dengan penuh rasa tanggung jawab</li>
        </ol>
        
    </div>
    
    <div class="col-md-8 col-8"></div>
    <div class="col-md-4 col-4"><p>Gorontalo, <?= tgl_indoo($tgl_in) ?></p></div>
</div>
</div>
<div class="card-footer">
    <a class="btn btn-success" href="<?= base_url() ?>sijuara/setuju_spt/<?= $spt->id_spt ?>">Setuju</a>
    <button class="btn btn-danger" data-target="#tolak" data-toggle="modal">Tolak</button>
</div>
</div>
<div class="modal fade" id="tolak" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Keterangan :</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="" method="post" action="<?= base_url() ?>sijuara/tolak_spt">
              <input type="hidden" name="id_spt" value="<?= $spt->id_spt ?>">
              <div class="form-group">
                  <textarea class="form-control" name="keterangan" required></textarea>
              </div>
              <button type="submit" name="submit" class="btn btn-danger">Tolak</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>