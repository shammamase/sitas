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
    if($spt->pj_ttd==0){
        $id_pjs = $this->db->query("select * from sijuara_pejabat_ttd where id_pjs = 1")->row();
        $kabalai = $this->model_more->get_pj_ttd($id_pjs->id_pejabat)->row();
    } else {
        $kabalai = $this->model_more->get_pj_ttd($spt->pj_ttd)->row();
    }
    $tgl_in = substr($spt->tanggal,0,10);
    $pc_tgl_in = explode("-",$tgl_in); 
    $bln = $pc_tgl_in[1];
    $thn = $pc_tgl_in[0];
    $no_sub = $this->model_more->get_id_sub_arsip($spt->id_arsip)->row();
    if(!empty($no_surat)){
        $no_srt = $no_surat->no_surat_keluar;
    } else {
        $no_srt = " - ";
    }
    
?>
<img class="img-fluid" src="<?= base_url() ?>asset/kop_iso.jpg">
<!--<img style="margin-left:40px" class="img-fluid" src="<?= base_url() ?>asset/kop_bpsip.png">-->
<div class="row">
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-1 col-1"><p style="text-align:left">Nomor</p></div> 
    <div class="col-md-1 col-1"><p style="text-align:left">:</p></div> 
    <div class="col-md-4 col-4 geser_kiri"><p style="text-align:left"><?= $no_srt ?>/<?= $no_sub->kode_sub_arsip ?>/H.10.29/<?= $bln ?>/<?= $thn ?></p></div>
    <div class="col-md-4 col-4"><p style="text-align:right"><?= tgl_indoo($spt->tanggal) ?></p></div>
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    
    <div class="col-md-1 col-1 no_srt" style="background:#ffffff"></div>
    <div class="col-md-1 col-1 no_srt"><p style="text-align:left">Lampiran</p></div> 
    <div class="col-md-1 col-1 no_srt"><p style="text-align:left">:</p></div> 
    <div class="col-md-8 col-8 no_srt geser_kiri"><p><?= $spt->lampiran ?></p></div>
    <div class="col-md-1 col-1 no_srt" style="background:#ffffff"></div>
    
    <div class="col-md-1 col-1 no_srt" style="background:#ffffff"></div>
    <div class="col-md-1 col-1 no_srt"><p style="text-align:left">Hal</p></div> 
    <div class="col-md-1 col-1 no_srt"><p style="text-align:left">:</p></div> 
    <div class="col-md-8 col-8 no_srt geser_kiri"><p><?= $spt->hal ?></p></div>
    <div class="col-md-1 col-1 no_srt" style="background:#ffffff"></div>
    
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-3 col-3"><p style="text-align:left">Yth.</p></div> 
    <div class="col-md-8 col-8" style="background:#ffffff"></div>
    
    <div class="col-md-1 col-1 no_srt" style="background:#ffffff"></div>
    <div class="col-md-7 col-7 no_srt">
        <?php 
            $pc = explode("#",$spt->kepada); 
            $jmlx = count($pc);
            if($jmlx > 1){
        ?>
        <p style="text-align:left">
            <ol style="margin-top:-10px">
            <?php 
                foreach($pc as $pcs){
            ?>
            <li><?= $pcs ?></li>
            <?php
                }
            ?>
            </ol>
        </p>
        <?php } else { ?>
        <p style="text-align:left"><?= $spt->kepada ?></p>
        <?php } ?>
    </div> 
    <div class="col-md-4 col-4 no_srt" style="background:#ffffff"></div>
    
    <div class="col-md-1 col-1 no_srt" style="background:#ffffff"></div>
    <div class="col-md-3 col-3 no_srt"><p style="text-align:left">Di</p></div> 
    <div class="col-md-8 col-8 no_srt" style="background:#ffffff"></div>
    
    <div class="col-md-1 col-1 no_srt" style="background:#ffffff"></div>
    <div class="col-md-3 col-3 no_srt"><p style="text-align:left;margin-left:20px"><?= $spt->lokasi_kepada ?></p></div> 
    <div class="col-md-8 col-8 no_srt" style="background:#ffffff"></div>
    
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-10 col-10"><?= $spt->isi_surat ?></div> 
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    
    <!--
    <div class="col-md-8 col-8" style="background:#ffffff"></div>
    <div class="col-md-4 col-4"><p>Gorontalo, <?= tgl_indoo($tgl_in) ?></p></div>
    -->
    
    <div class="col-md-8 col-8" style="background:#ffffff"></div>
    <div class="col-md-4 col-4 no_srt"><p><?= $kabalai->for_ttd ?></p></div>
    
    <div class="col-md-8 col-8" style="background:#ffffff"></div>
    <div class="col-md-4 col-4 no_srt"><p><?= $kabalai->jabatan ?></p></div>
    <!--
    <div class="col-md-8 col-8" style="background:#ffffff"></div>
    <div class="col-md-1 col-1"><p style="text-align:right"><img src="<?= base_url().$kabalai->ttd ?>"></p></div>
    <div class="col-md-3 col-3" style="background:#ffffff"></div>
    -->
    
    <div class="col-md-8 col-8" style="background:#ffffff"></div>
    <div class="col-md-4 col-4"><p><b><?= $kabalai->nama ?></b></p></div>
    
    <div class="col-md-8 col-8" style="background:#ffffff"></div>
    <div class="col-md-4 col-4 no_srt"><p>NIP. <?= $kabalai->nip ?></p></div>
    
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-10 col-10">
        <?php
            if(!empty($spt->tembusan)){
                $tmb = "<b>Tembusan :</b>";
            } else {
                $tmb = "";
            }
            echo $tmb;
        ?>
    </div> 
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
    <div class="col-md-10 col-10">
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
    <div class="col-md-1 col-1" style="background:#ffffff"></div>
</div>