<?php 
    header("Content-type: application/vnd-ms-excel");
    header("Content-disposition: attachment; filename=Laporan_Monev.xls");
    $get_pj = $this->db->query("select b.nama from sijuara_pj a inner join t_biodata b on a.id_bio = b.id_bio where a.id_pj = '$keg->id_pj'")->row();
?>

            <h3 style="font-weight:bold;text-align:center">REKAPITULASI LAPORAN BULANAN MONEV</h3>
            <table style="width:100%">
                <tr>
                    <td colspan="2">Judul Kegiatan</td>
                    <td>:</td>
                    <td><?= $keg->subkomp ?></td>
                </tr>
                <tr>
                    <td colspan="2">Anggaran</td>
                    <td>:</td>
                    <td>Rp. <?= number_format($keg->jumlah_biaya) ?></td>
                </tr>
                <tr>
                    <td colspan="2">Penanggung Jawab</td>
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
                                
                                if(!empty($get_mv)){
                                    $capaian = explode("#",$get_mv->capaian);
                                    $kendala = explode("#",$get_mv->kendala);
                                    $solusi = explode("#",$get_mv->solusi);
                                    $real_keu = $get_mv->real_keu;
                                    $realisasi = $get_mv->realisasi;
                                } else {
                                    $capaian = ["-"];
                                    $kendala = ["-"];
                                    $solusi = ["-"];
                                    $real_keu = "-";
                                    $realisasi = "-";
                                }
                            ?>
                            <tr>
                                <td style="width:3%"><?= $nor ?></td>
                                <td style="width:17%"><?= tgl_indoo($blnx) ?></td>
                                <td style="width:20%">
                                    <?php
                                        foreach($capaian as $cap){
                                            echo $cap."<br>";
                                        }
                                    ?>
                                </td>
                                <td style="width:20%">
                                    <?php
                                        foreach($kendala as $ken){
                                            echo $ken."<br>";
                                        }
                                    ?>
                                </td>
                                <td style="width:20%">
                                    <?php
                                        foreach($solusi as $sol){
                                            echo $sol."<br>";
                                        }
                                    ?>
                                </td>
                                <td style="width:10%"><?= $real_keu ?></td>
                                <td style="width:10%"><?= $realisasi ?></td>
                            </tr>
                            <?php
                            $nor++;
                            }
                        ?>
                    </tbody>
                </table>