    <div class='col-md-12'>
    
        <div class="card card-outline card-success">
            <div class="card-header">
                <h2 class="card-title">Form Isian Monitoring Evaluasi <?php $keg = $kegiatan->row(); echo $keg->subkomp ?></h2>
        
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <div class="card-body">
                <div class='col-md-12'>
                 <?php $hr_ini = date('Y-m-d'); ?>
                 <?php
                    $data_sp = $dt_sp->row();
                    if($data_sp){
                        $nmr = $data_sp->nomor;
                        $lam = $data_sp->lampiran;
                        $perl = $data_sp->keperluan;
                        $tgll = $data_sp->tanggal;
                    } else {
                        $nmr = "-";
                        $lam = " ";
                        $perl = "-";
                        $tgll = "-";
                    }
                    
                    if($get_rl){
                        $get_rll  = $get_rl->rl;
                    } else {
                        $get_rll  = 0;
                    }
                    
                    $persen = ($get_rll / $keg->jumlah_biaya) * 100;
                 ?>
                 <form action="<?= site_url() ?>sijuara/isi_pj" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="tgl_input" value="<?= date('Y-m-d') ?>">
                  <input type="hidden" name="id_subkomp" value="<?= $uris ?>">
                  <input type="hidden" name="real_keu" value="<?= number_format($persen,2) ?>">
                  <input type="hidden" name="id_monev" value="<?= $id_monev ?>">
                  <input type="hidden" name="tipe" value="<?= $tipe ?>">
                  <input type="hidden" name="evidens" value="<?= $eviden ?>">
                  
                  <div style="margin-left:5px" class="row">
                      <?php 
                        if(!empty($eviden)){
                            $pc_nf = explode(",",$eviden);
                            foreach($pc_nf as $value){
                      ?>
                      <div style="margin-bottom:10px" class="col-6 col-lg-6 col-md-6"><img style="width:500px;height:auto" class="img-responsive" src="<?= base_url() ?>asset/file_lainnya/lap_spt/<?= $value ?>"></div>
                      <?php
                            }
                        }
                      ?>
                   </div>
                   
                  <table style="width:100%" border="0">
                      <tr>
                          <td style="width:20%">Realisasi Keuangan Saat Ini</td>
                          <td style="width:2%">:</td>
                          <td style="width:78%"><b><?= number_format($persen,2) ?> %</b></td>
                      </tr>
                      <tr>
                          <td style="width:20%">&nbsp;</td>
                          <td style="width:2%">&nbsp;</td>
                          <td style="width:78%">
                              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalku">Eviden Kegiatan</button>
                          </td>
                      </tr>
                      <tr>
                          <td style="width:20%">Laporan Bulan</td>
                          <td style="width:2%">:</td>
                          <td style="width:78%"><input type="text" name="lap_bln" class="form-control" value="<?= $lap_bln ?>"></td>
                      </tr>
                      <tr>
                          <td style="width:20%">Capaian Kegiatan Dilapangan</td>
                          <td style="width:2%">:</td>
                          <td style="width:78%"><textarea class="form-control" name="capaian" placeholder="Jika lebih dari 1 capaian pisahkan dengan simbol #"><?= $capaianx ?></textarea></td>
                      </tr>
                      <tr>
                          <td style="width:20%">Kendala</td>
                          <td style="width:2%">:</td>
                          <td style="width:78%"><textarea class="form-control" name="kendala" placeholder="Jika lebih dari 1 kendala pisahkan dengan simbol #"><?= $kendalax ?></textarea></td>
                      </tr>
                      <tr>
                          <td style="width:20%">Solusi</td>
                          <td style="width:2%">:</td>
                          <td style="width:78%"><textarea class="form-control" name="solusi" placeholder="Jika lebih dari 1 solusi pisahkan dengan simbol #"><?= $solusix ?></textarea></td>
                      </tr>
                      <!--
                      <tr>
                          <td style="width:20%">Tindakan Bulan Sebelumnya</td>
                          <td style="width:2%">:</td>
                          <td style="width:78%"><textarea class="form-control" name="tindakan_bulan_lalu"></textarea></td>
                      </tr>
                      -->
                      <tr>
                          <td style="width:20%">Realisasi Fisik</td>
                          <td style="width:2%">:</td>
                          <td style="width:78%"><input type="number" name="realisasi" class="form-control" value="<?= $realisasix ?>"></td>
                      </tr>
                      
                      <tr>
                          <td style="width:20%">Upload Eviden</td>
                          <td style="width:2%">:</td>
                          <td style="width:78%"><input type="file" name="eviden[]" class="form-control" multiple <?= $harus ?>></td>
                      </tr>
                      
                      <tr>
                          <td style="text-align:center;line-height:1.5" colspan="3">&nbsp;</td>
                      </tr>
                      <tr>
                          <td style="text-align:center;line-height:1.5" colspan="3"><button type="submit" name="submit" class="btn btn-success btn-block">Submit</button></td>
                      </tr>
                  </table>
                  </form>
                </div>
            </div>
        </div>
        
        <div class="card card-outline card-success">
            <div class="card-header">
                <h2 class="card-title">Daftar Isian Monitoring Evaluasi <?php echo $keg->subkomp ?></h2>
        
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
            </div>
            
            <div class="card-body">
                <table class="table table-bordered">
                     <thead class="thead-light">
                        <tr>
                            <th style="vertical-align:middle;text-align:center" rowspan="2">No</th>
                            <th style="vertical-align:middle;text-align:center" rowspan="2">Bulan</th>
                            <th style="vertical-align:middle;text-align:center" rowspan="2">Capaian Kegiatan Lapangan</th>
                            <th style="vertical-align:middle;text-align:center" rowspan="2">Kendala</th>
                            <th style="vertical-align:middle;text-align:center" rowspan="2">Solusi</th>
                            <th style="vertical-align:middle;text-align:center" colspan="2">Realisasi(%)</th>
                            <th style="vertical-align:middle;text-align:center" rowspan="2">Edit</th>
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
                                    $editx = "<a href='".base_url()."sijuara/isi_pj/$uris/$get_mv->id_monev' class='btn btn-success'>Edit</a>";
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
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalku">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Daftar Eviden Kegiatan <?= $keg->subkomp ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Waktu</th>
                                <th>Perihal</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $nos = 1;
                                $get_kg = $this->db->query("select a.untuk, a.tanggal, b.id_spt, b.gbr_dok
                                                            from sijuara_spt a 
                                                            inner join sijuara_lap_spt b on a.id_spt = b.id_spt
                                                            where b.tolak_ukur_kegiatan = '$keg->subkomp' order by b.id_lap_spt desc")->result(); 
                                
                                foreach($get_kg as $gk){
                            ?>
                            <tr>
                                <td><?= $nos ?></td>
                                <td><?= $gk->tanggal ?></td>
                                <td><?= $gk->untuk ?></td>
                                <td>
                                    <?php
                                        $pc_gbr = explode(",",$gk->gbr_dok);
                                        foreach($pc_gbr as $pcg){
                                        ?>
                                        <img src="<?= base_url() ?>/asset/file_lainnya/lap_spt/<?= $pcg ?>" style="height:200px;width:auto">
                                        <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            $nos++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>