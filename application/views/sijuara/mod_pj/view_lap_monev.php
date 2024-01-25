<?php 
    $get_pj = $this->db->query("select b.nama from sijuara_pj a inner join t_biodata b on a.id_bio = b.id_bio where a.id_pj = '$keg->id_pj'")->row();
?>
<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-body">
            <h3 style="font-weight:bold;text-align:center">REKAPITULASI LAPORAN BULANAN MONEV</h3>
            <table style="width:100%">
                <tr>
                    <td style="40%">Judul Kegiatan</td>
                    <td style="3%">:</td>
                    <td style="57%"><?= $keg->subkomp ?></td>
                </tr>
                <tr>
                    <td>Anggaran</td>
                    <td>:</td>
                    <td>Rp. <?= number_format($keg->jumlah_biaya) ?></td>
                </tr>
                <tr>
                    <td>Penanggung Jawab</td>
                    <td>:</td>
                    <td><?= $get_pj->nama ?></td>
                </tr>
            </table>
            
            <table class="table table-bordered">
                     <thead>
                        <tr>
                            <th style="vertical-align:middle;text-align:center" rowspan="2">No</th>
                            <th style="vertical-align:middle;text-align:center" rowspan="2">Bulan</th>
                            <th style="vertical-align:middle;text-align:center" rowspan="2">Capaian Kegiatan Lapangan</th>
                            <th style="vertical-align:middle;text-align:center" rowspan="2">Kendala</th>
                            <th style="vertical-align:middle;text-align:center" rowspan="2">Solusi</th>
                            <th style="vertical-align:middle;text-align:center" colspan="2">Realisasi(%)</th>
                            <th style="vertical-align:middle;text-align:center" rowspan="2">Evaluasi penyelesaian kendala bulan sebelumnya</th>
                        </tr>
                        <tr>
                            <th style="text-align:center">Keuangan</th>
                            <th style="text-align:center">Fisik</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $arr_bln = array("01","02","03","04","05","06","07","08","09","10","11","12");
                            $nor = 1;
                            $thn = date('Y');
                            
                            foreach($arr_bln as $abl){
                                $blnx = $thn."-".$abl;
                                $get_mv = $this->db->query("select * from sijuara_monev where id_subkomp = '$uris' and lap_bln = '$blnx'")->row();
                                
                                $get_kg = $this->db->query("select b.gbr_dok
                                                            from sijuara_spt a 
                                                            inner join sijuara_lap_spt b on a.id_spt = b.id_spt
                                                            where b.tolak_ukur_kegiatan = '$keg->subkomp' and a.tanggal like '%$blnx%'")->result();
                                
                                if(!empty($get_mv)){
                                    $capaian = explode("#",$get_mv->capaian);
                                    $kendala = explode("#",$get_mv->kendala);
                                    $solusi = explode("#",$get_mv->solusi);
                                    $real_keu = $get_mv->real_keu;
                                    $realisasi = $get_mv->realisasi;
                                    $editx = "<a href='".base_url()."sijuara/isi_eval_pj/$uris/$get_mv->id_monev' class='btn btn-success'>Evaluasi</a>";
                                } else {
                                    $capaian = ["-"];
                                    $kendala = ["-"];
                                    $solusi = ["-"];
                                    $real_keu = "-";
                                    $realisasi = "-";
                                    $editx = "";
                                }
                            ?>
                            <tr>
                                <td><?= $nor ?></td>
                                <td><?= tgl_indoo($blnx) ?></td>
                                <td>
                                    <?php
                                    foreach($capaian as $cap){
                                            echo $cap."<br>";
                                        }
                                        
                                    if($capaian!="-"){
                                        
                                        if(!empty($get_kg)){
                                           foreach($get_kg as $gk){
                                               $pc_gbr = explode(",",$gk->gbr_dok);
                                                foreach($pc_gbr as $pcg){
                                                ?>
                                                <img src="<?= base_url() ?>/asset/file_lainnya/lap_spt/<?= $pcg ?>" style="height:200px;width:auto">
                                                <?php
                                                }
                                            }
                                        }
                                        
                                        if(!empty($get_mv->eviden)){
                                            $pc_ev = explode(",",$get_mv->eviden);
                                            foreach($pc_ev as $pcv){
                                            ?>
                                            <img src="<?= base_url() ?>/asset/file_lainnya/lap_spt/<?= $pcv ?>" style="height:200px;width:auto">
                                            <?php   
                                            }
                                        }
                                        
                                    }
                                        
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        foreach($kendala as $ken){
                                            echo $ken."<br>";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        foreach($solusi as $sol){
                                            echo $sol."<br>";
                                        }
                                    ?>
                                </td>
                                <td><?= $real_keu ?></td>
                                <td><?= $realisasi ?></td>
                                <td><?= $editx ?></td>
                            </tr>
                            <?php
                            $nor++;
                            }
                        ?>
                    </tbody>
                </table>
                <br>
                <a href="<?= base_url() ?>sijuara/lap_monev_xl/<?= $uris ?>" target="_blank" class="btn btn-success btn-block"><i class="fa fa-file-excel"></i> <b>Export Excel</b></a>
        </div>
    </div>
</div>