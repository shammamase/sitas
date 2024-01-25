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
                  
                  <table style="width:100%" border="0">
                      <tr>
                          <td style="width:20%">Realisasi Keuangan Saat Ini</td>
                          <td style="width:2%">:</td>
                          <td style="width:78%"><b><?= number_format($persen,2) ?> %</b></td>
                      </tr>
                      <tr>
                          <td style="width:20%">Laporan Bulan</td>
                          <td style="width:2%">:</td>
                          <td style="width:78%"><input type="text" name="lap_bln" class="form-control" value="<?= $lap_bln ?>" <?= $harus ?>></td>
                      </tr>
                      <tr>
                          <td style="width:20%">Capaian Kegiatan Dilapangan</td>
                          <td style="width:2%">:</td>
                          <td style="width:78%"><textarea class="form-control" name="capaian" placeholder="Jika lebih dari 1 capaian pisahkan dengan simbol #" <?= $harus ?>><?= $capaianx ?></textarea></td>
                      </tr>
                      <tr>
                          <td style="width:20%">Kendala</td>
                          <td style="width:2%">:</td>
                          <td style="width:78%"><textarea class="form-control" name="kendala" placeholder="Jika lebih dari 1 kendala pisahkan dengan simbol #" <?= $harus ?>><?= $kendalax ?></textarea></td>
                      </tr>
                      <tr>
                          <td style="width:20%">Solusi</td>
                          <td style="width:2%">:</td>
                          <td style="width:78%"><textarea class="form-control" name="solusi" placeholder="Jika lebih dari 1 solusi pisahkan dengan simbol #" <?= $harus ?>><?= $solusix ?></textarea></td>
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
                          <td style="width:78%"><input type="number" name="realisasi" class="form-control" value="<?= $realisasix ?>" <?= $harus ?>></td>
                      </tr>
                      <tr>
                          <td style="width:20%">Evaluasi penyelesaian kendala bulan sebelumnya</td>
                          <td style="width:2%">:</td>
                          <td style="width:78%"><textarea class="form-control" name="evaluasi_sebelum" placeholder="Jika lebih dari 1 pisahkan dengan simbol #"></textarea></td>
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
    </div>