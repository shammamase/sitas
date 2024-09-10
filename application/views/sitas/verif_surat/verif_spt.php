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
   $tgl_in = $spt->tanggal_input;
   $pc_tgl_in = explode("-",$tgl_in); 
   $bln = $pc_tgl_in[1];
   $thn = $pc_tgl_in[0];
   $no_sub = "TU.040";
   $arr_dasar = clir_ul_li($spt->dasar);
?>
<div class="card card-success">
<div class="card-header">
    <h3 class="card-title">Surat Perintah Tugas</h3>
</div>
<div class="card-body">
<div class="row">
<div class="col-md-12 col-12"><p  style="text-align:center"><b><u>SURAT TUGAS</u></b></p></div>
    <div class="col-md-12 col-12 no_srt"><p  style="text-align:center"><b>Nomor : -/<?= $no_sub ?>/H.4.2/<?= $bln ?>/<?= $thn ?></b></p></div>
    
    <div class="col-md-3 col-3"><p style="text-align:left">Menimbang</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-8 col-8"><p style="text-align:left"><ol type="a"><li><?= $spt->menimbang ?></li></ol></div>
    
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
                <td><?= $nox ?></td>
                <td><?= $pg->nama ?></td>
                <td><?= wordwrap($pangkat_gol,10,"<br /> \n") ?></td>
                <td><?= $nip ?></td>
                <td><?= $jabatan ?></td>
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
    </div>
    <div class="col-md-3 col-3"><p style="text-align:left">Untuk</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:right">:</p></div> 
    <div class="col-md-8 col-8"><p style="text-align:justify"><?= $spt->untuk ?>, pada Tanggal <?= $val_tgl ?></p></div>
    
    <div class="col-md-6 col-6" style="background:#ffffff"></div>
    <div class="col-md-6 col-6"><p>Malang, <?= tgl_indoo($tgl_in) ?></p></div>
    
    <div class="col-md-6 col-6" style="background:#ffffff"></div>
    <div class="col-md-6 col-6 no_srt"><p><?= $kabalai->for_ttd ?></p></div>
    
    <div class="col-md-6 col-6" style="background:#ffffff"></div>
    <div class="col-md-6 col-6 no_srt"><p><?= $kabalai->struktur ?></p></div>
    
    <div class="col-md-6 col-6" style="background:#ffffff"></div>
    <div class="col-md-6 col-6"><p><b><?= $kabalai->nama ?></b></p></div>
    
    <div class="col-md-6 col-6" style="background:#ffffff"></div>
    <div class="col-md-6 col-6 no_srt"><p>NIP. <?= $kabalai->nip ?></p></div>
</div>
</div>
<div class="card-footer">
    <a class="btn btn-success" data-target="#setuju" data-toggle="modal">Setuju</a>
    <button class="btn btn-danger" data-target="#tolak" data-toggle="modal">Tolak</button>
</div>
</div>

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
          <form class="" method="post" action="<?= base_url() ?>primer/setuju_surat">
              <input type="hidden" name="id_buat_surat" value="<?= $spt->id_surat_keluar ?>">
              <input type="hidden" name="id_spt" value="<?= $spt->id_spt ?>">
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
          <form class="" method="post" action="<?= base_url() ?>primer/tolak_surat">
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