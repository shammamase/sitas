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
    if($spt->pj_ttd==0){
        $id_pjs = $this->db->query("select * from sijuara_pejabat_ttd where id_pjs = 1")->row();
        $kabalai = $this->model_more->get_pj_ttd($id_pjs->id_pejabat)->row();
    } else {
        //$kabalai = $this->model_more->get_pj_ttd($spt->pj_ttd)->row();
        $kabalai = $this->model_more->get_pj_ttd(1)->row();
    }
    $tgl_in = substr($lap_spt->tanggal_input,0,10);
    $pc_tgl_in = explode("-",$tgl_in); 
    $bln = $pc_tgl_in[1];
    $thn = $pc_tgl_in[0];
    $no_sub = $this->model_more->get_sub_arsip($spt->id_arsip)->row();
    if(!empty($no_surat)){
        $no_srt = $no_surat->no_surat_keluar;
    } else {
        $no_srt = " - ";
    }
?>
<div class="card card-success">
<div class="card-header">
    <h3 class="card-title">Laporan Perjalanan Dinas</h3>
</div>
<div class="card-body">
<div class="row">
    <div class="col-md-12 col-12"><p  style="text-align:center"><b><u>LAPORAN PERJALANAN DINAS</u></b></p></div>
    <div class="col-md-12 col-12 no_srt"><p  style="text-align:center">SPT NO. <?= $no_srt ?>/<?= $no_sub->kode_sub_arsip ?>/H.10.29/<?= $bln ?>/<?= $thn ?></p></div>
    
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-3 col-3"><p style="text-align:left">1. Nama Yang Ditugaskan</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div>
    <div class="col-md-6 col-6">
        <?php
                foreach($peg as $pg){
                    $tgl_plk = $pg->tanggal;
            ?>
                <?= $pg->nama ?><br>
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
    </div>
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-3 col-3"><p style="text-align:left">2. Tempat Tujuan</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-6 col-6"><?= $lap_spt->lokasi ?></div>
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-3 col-3"><p style="text-align:left">3. Judul Tolak Ukur Kegiatan</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-6 col-6"><?= $lap_spt->tolak_ukur_kegiatan ?></div>
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-3 col-3"><p style="text-align:left">4. Lama Perjalanan Dinas</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-6 col-6"><?= $spt->lama_hari ?> Hari, Tanggal <?= $val_tgl ?></div>
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-3 col-3"><p style="text-align:left">5. Transportasi</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-6 col-6"><?= $lap_spt->transportasi ?></div>
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-3 col-3"><p style="text-align:left">6. Maksud Perjalanan Dinas</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-6 col-6"><?= $spt->untuk ?></div>
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-3 col-3"><p style="text-align:left">7. Uraian Hasil Perjalanan Dinas</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-6 col-6" style="background:#ffffff"></div>
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-10 col-10"><?= $lap_spt->uraian ?></div>
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-10 col-10"><b>Dokumentasi</b></div>
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-10 col-10">
        <div class="row">
            <?php 
                $pc_nf = explode(",",$lap_spt->gbr_dok);
                foreach($pc_nf as $value){
          ?>
          <div style="margin-bottom:10px" class="col-6 col-lg-6 col-md-6"><img style="height:320px;width:auto" class="img-responsive" src="<?= base_url() ?>asset/file_lainnya/lap_spt/<?= $value ?>"></div>
          <?php
                }
          ?>
        </div>
    </div>
    
    <div class="col-md-8 col-8" style="background:#ffffff"></div>
    <div class="col-md-4 col-4"><p>Gorontalo, <?= tgl_indoo($tgl_in) ?></p></div>
    
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-7 col-7 no_srt"><p>Yang Membuat</p></div>
    <div class="col-md-4 col-4 no_srt"><p><?= $kabalai->for_ttd ?></p></div>
    
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-7 col-7 no_srt" style="background:#ffffff"></div>
    <div class="col-md-4 col-4 no_srt"><p><?= $kabalai->jabatan ?></p></div>
    
    <!--
    <div class="col-md-8 col-8" style="background:#ffffff"></div>
    <div class="col-md-1 col-1"><p style="text-align:right"><img src="<?= base_url().$kabalai->ttd ?>"></p></div>
    <div class="col-md-3 col-3" style="background:#ffffff"></div>
    -->
    <div class="col-md-12 col-12" style="background:#ffffff">&nbsp;</div>
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-7 col-7 no_srt"><p><b><?= $user->nama ?></b></p></div>
    <div class="col-md-4 col-4 no_srt"><p><b><?= $kabalai->nama ?></b></p></div>
    
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-7 col-7 no_srt"><p><?= $user->nip ?></p></div>
    <div class="col-md-4 col-4 no_srt"><p><?= $kabalai->nip ?></p></div>
    
    <!--
    <div class="col-md-8 col-8" style="background:#ffffff"></div>
    <div class="col-md-4 col-4"><p><b><?= $kabalai->nama ?></b></p></div>
    
    <div class="col-md-8 col-8" style="background:#ffffff"></div>
    <div class="col-md-4 col-4 no_srt"><p>NIP. <?= $kabalai->nip ?></p></div>
    -->
</div>
</div>
<div class="card-footer">
    <a class="btn btn-success" href="<?= base_url() ?>sijuara/setuju_lap_spt/<?= $spt->id_spt ?>">Setuju</a>
    <button class="btn btn-danger" data-target="#tolak_lap" data-toggle="modal">Tolak</button>
</div>
</div>

<div class="modal fade" id="tolak_lap" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Keterangan :</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="" method="post" action="<?= base_url() ?>sijuara/tolak_lap_spt">
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