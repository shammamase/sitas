    <div class='col-md-12'>
    
        <div class="card card-outline card-success">
            <div class="card-header">
                <h2 class="card-title">Form Pengajuan Tahun Anggaran <?php $keg = $kegiatan->row(); echo $keg->ta ?></h2>
        
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
                 ?>
                  <table style="width:100%" border="0">
                      <tr>
                          <td style="width:12%">Nomor</td><td style="width:2%">:</td><td style="width:66%"><?php echo $nmr ?></td><td style="width:20%"><?php echo tgl_indo($tgll) ?></td>
                      </tr>
                      <tr>
                          <td>Lampiran</td><td>:</td><td><?php echo $lam ?> Lampiran</td><td></td>
                      </tr>
                      <tr>
                          <td>Kegiatan/Sub Kegiatan</td><td>:</td><td><?php echo $keg->subkomp ?> - <?php echo $keg->kd_ro ?>.<?php echo $keg->kd_komponen ?>.<?php echo $keg->kd_subkomp ?></td><td></td>
                      </tr>
                      <tr>
                          <td>Untuk Keperluan</td><td>:</td><td><?php echo $perl ?></td><td></td>
                      </tr>
                  </table>
                  <table style="width:100%;margin-top:20px" class='table table-bordered'>
                  <thead>
                    <tr>
                      <th style="width:2%; text-align:center; font-size:14px;">No</th>
                      <th style="width:3%; text-align:center; font-size:14px;">Akun</th>
                      <th style="width:25%; text-align:center; font-size:14px;">Uraian</th>
                      <th style="width:10%; text-align:center; font-size:14px;">Pagu</th>
                      <th style="width:15%; text-align:center; font-size:14px;">Realisasi yg lalu</th>
                      <th style="width:15%; text-align:center; font-size:14px;">Pengajuan ini</th>
                      <th style="width:10%; text-align:center; font-size:14px;">Realisasi s/d Pengajuan ini</th>
                      <th style="width:20%; text-align:center; font-size:14px;">Sisa Dana</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  <?php 
                    $no = 1;
                    $jumlah_pagu = 0;
                    $realisasix = 0;
                    $pengajuany = 0;
                    $tot_pengajuan_rl = 0;
                    $tot_sisa_dana = 0;
                    $pass_id_subdetil = "";
                    foreach($detil->result() as $dtl){
                        $pi_dtl = $this->model_polling->pengajuan_ini_detil($dtl->id_detil)->row();
                        $rl_dtl = $this->model_polling->realisasi_detil($dtl->id_detil)->row();
                        $rl_pi_dtl = $pi_dtl->jlx_detil + $rl_dtl->jlx_detil;
                        //$sd_dtl = $dtl->jumlah_biaya - $rl_dtl->jlx_detil;
                        $sd_dtl = $dtl->jumlah_biaya - $rl_pi_dtl;
                        if($pi_dtl->jlx_detil!=0){
                            $pi_dt = number_format($pi_dtl->jlx_detil);
                        } else {
                            $pi_dt = "-";
                        }
                        
                        if($rl_dtl->jlx_detil!=0){
                            $rl_dt = number_format($rl_dtl->jlx_detil);
                        } else {
                            $rl_dt = "-";
                        }
                        
                        if($rl_pi_dtl!=0){
                            $rl_pi = number_format($rl_pi_dtl);
                        } else {
                            $rl_pi = "-";
                        }
                        
                        if($sd_dtl!=0){
                            $sd_d = number_format($sd_dtl);
                        } else {
                            $sd_d = "-";
                        }
                        
                        $jumlah_pagu += $dtl->jumlah_biaya;
                        $realisasix += $rl_dtl->jlx_detil;
                        $pengajuany += $pi_dtl->jlx_detil;
                        $tot_pengajuan_rl += $rl_pi_dtl;
                        $tot_sisa_dana += $sd_dtl;
                 ?>
                 <tr style="background-color:#cccccc;font-size:15px">
                     <td style="text-align:center"><?php echo $no ?></td>
                     <td style="text-align:center"><?php echo $dtl->kd_detil ?></td>
                     <td><?php echo $dtl->detil ?></td>
                     <td style="text-align:right"><?php echo number_format($dtl->jumlah_biaya,0," ",".") ?></td>
                     <td style="text-align:right"><?php echo $rl_dt ?></td>
                     <td style="text-align:right"><?php echo $pi_dt ?></td>
                     <td style="text-align:right"><?php echo $rl_pi ?></td>
                     <td style="text-align:right"><?php echo $sd_d ?></td>
                 </tr>
                 <?php
                 $no++;
                    $subdetil = $this->db->query("select * from sijuara_subdetil where id_detil = '$dtl->id_detil'")->result();
                        foreach($subdetil as $sdtl){
                            
                            $jlh = $sdtl->vol * $sdtl->harga_satuan;
                            $pi_sbdtl = $this->model_polling->pengajuan_ini_subdetil($sdtl->id_subdetil)->row();
                            $rl_sbdtl = $this->model_polling->realisasi_subdetil($sdtl->id_subdetil)->row();
                            $pi_rl_sbdtl = $pi_sbdtl->jlx_subdetil + $rl_sbdtl->jlx_subdetil;
                            //$sd_sbdtl = $jlh - $rl_sbdtl->jlx_subdetil;
                            $sd_sbdtl = $jlh - $pi_rl_sbdtl;
                            if($pi_sbdtl->jlx_subdetil!=0){
                                $pi_sbd = number_format($pi_sbdtl->jlx_subdetil);
                                $pass_id_subdetil .= $pi_sbdtl->id_subdetil.",";
                            } else {
                                $pi_sbd = "-";
                                $pass_id_subdetil .= "";
                            }
                            
                            if($rl_sbdtl->jlx_subdetil!=0){
                                $rl_sbdt = number_format($rl_sbdtl->jlx_subdetil);
                            } else {
                                $rl_sbdt = "-";
                            }
                            
                            if($pi_rl_sbdtl!=0){
                                $pi_rl = number_format($pi_rl_sbdtl);
                            } else {
                                $pi_rl = "-";
                            }
                            
                            if($sd_sbdtl!=0){
                                $sd_sb = number_format($sd_sbdtl);
                            } else {
                                $sd_sb = "-";
                            }
                            
                        ?>
                        <tr style="font-size:15px">
                             <td></td>
                             <td></td>
                             <td><?php echo $sdtl->subdetil ?></td>
                             <td style="text-align:right"><?php echo number_format($jlh,0," ",".") ?></td>
                             <td style="text-align:right"><?php echo $rl_sbdt ?></td>
                             <td style="text-align:right"><?php echo $pi_sbd ?></td>
                             <td style="text-align:right"><?php echo $pi_rl ?></td>
                             <td style="text-align:right"><?php echo $sd_sb ?></td>
                         </tr>
                        <?php    
                        }
                    }
                  ?>
                    <tr style="font-size:15px">
                        <td>&nbsp;</td>
                        <td style="text-align:right;font-weight:bold" colspan="2">Jumlah</td>
                        <td style="text-align:right;font-weight:bold"><?php echo number_format($jumlah_pagu) ?></td>
                        <td style="text-align:right;font-weight:bold">
                            <?php 
                                if($realisasix!=0){
                                $realx = number_format($realisasix);
                                } 
                                else {
                                $realx = "-";
                                }
                            echo $realx;
                            ?>
                        </td>
                        <td style="text-align:right;font-weight:bold">
                            <?php 
                                if($pengajuany!=0){
                                $pengaj = number_format($pengajuany);
                                } 
                                else {
                                $pengaj = "-";
                                }
                            echo $pengaj;
                            ?>
                        </td>
                        <td style="text-align:right;font-weight:bold">
                            <?php 
                                if($tot_pengajuan_rl!=0){
                                $tot_peng = number_format($tot_pengajuan_rl);
                                } 
                                else {
                                $tot_peng = "-";
                                }
                            echo $tot_peng;
                            ?>
                        </td>
                        <td style="text-align:right;font-weight:bold">
                            <?php 
                                if($tot_sisa_dana!=0){
                                $tot_sisa = number_format($tot_sisa_dana);
                                } 
                                else {
                                $tot_sisa = "-";
                                }
                            echo $tot_sisa;
                            ?>
                        </td>
                    </tr>
                  </tbody>
                  </table>
                  <?php 
                        $ps_id_sbdtl =  substr($pass_id_subdetil,0,-1);
                        if(!empty($ps_id_sbdtl)){
                        $get_id_subdetil_sp = $this->db->query("select * from sijuara_simpan_pengajuan where id_subdetil in ($ps_id_sbdtl) and status = '' order by id_pengajuan desc")->row();
                  ?>
                  <table style="width:100%;margin-top:20px;border-collapse: collapse">
                      <tr>
                          <td>
                          <p style="line-height:0.3">Menyetujui,</p>
                          <p style="line-height:0.3">an. Kuasa Pengguna Anggaran</p>
                          <p style="line-height:0.3">Pejabat Pembuat Komitmen</p>
                          </td>
                          <td>
                          <p style="line-height:0.3">Mengetahui,</p>
                          <p style="line-height:0.3">Koordinator Program</p>
                          <p style="line-height:0.3">&nbsp;</p>
                          </td>
                          <td>
                          <p style="line-height:0.3">Yang mengajukan,</p>
                          <p style="line-height:0.3">Penanggungjawab Kegiatan</p>
                          <p style="line-height:0.3">&nbsp;</p>
                          </td>
                      </tr>
                      <tr>
                          <td style="height:50px">
                              <?php
                                if(!empty($get_id_subdetil_sp)){
                                if($get_id_subdetil_sp->ttd_ppk=="Tolak"){
                                    
                                    $icons = "<a href='#' data-toggle='modal' data-target='#penolakan_ppk'><i class='fa fa-times' style='font-size:40px;color:red;margin-left:50px'></i></a>";
                                    $count_ppk = 0;
                                } else if ($get_id_subdetil_sp->ttd_ppk==""){
                                    $icons = "<b style='font-size:40px;color:black;margin-left:50px'>-</b>";
                                    $count_ppk = 0;
                                } else {
                                    $icons = "<i class='fa fa-check-square' style='font-size:40px;color:green;margin-left:50px'></i>";
                                    $count_ppk = 1;
                                }
                                echo $icons;
                                }
                                ?>
                          </td>
                          <td>
                              <?php 
                                if(!empty($get_id_subdetil_sp)){
                                if($get_id_subdetil_sp->ttd_program=="Tolak"){
                                    
                                    $icons = "<a href='#' data-toggle='modal' data-target='#penolakan_program'><i class='fa fa-times' style='font-size:40px;color:red;margin-left:50px'></i></a>";
                                    $count_program = 0;
                                } else if ($get_id_subdetil_sp->ttd_program==""){
                                    $icons = "<b style='font-size:40px;color:black;margin-left:50px'>-</b>";
                                    $count_program = 0;
                                } else {
                                    $icons = "<i class='fa fa-check-square' style='font-size:40px;color:green;margin-left:50px'></i>";
                                    $count_program = 1;
                                }
                                echo $icons;
                                }
                                ?>
                          </td>
                          <td>
                              <?php 
                                if(!empty($get_id_subdetil_sp)){
                                if($get_id_subdetil_sp->ttd_pj=="Tolak"){
                                    $icons = "<a href='#' data-toggle='modal' data-target='#detail_tolak'><i class='fa fa-times' style='font-size:40px;color:red;margin-left:50px'></i></a>";
                                    $count_pj = 0;
                                } else if ($get_id_subdetil_sp->ttd_pj==""){
                                    $icons = "<b style='font-size:40px;color:black;margin-left:50px'>-</b>";
                                    $count_pj = 0;
                                } else {
                                    $icons = "<i class='fa fa-check-square' style='font-size:40px;color:green;margin-left:50px'></i>";
                                    $count_pj = 1;
                                }
                                echo $icons;
                                }
                                ?>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <?php $ppk = $this->model_polling->get_stakeholder(3)->row() ?>
                              <p style="line-height:0.3"><u><?php echo $ppk->nama ?></u></p>
                              <p style="line-height:0.3">NIP.<?php echo $ppk->nip ?></p>
                          </td>
                          <td>
                              <?php $prog = $this->model_polling->get_stakeholder(2)->row() ?>
                              <p style="line-height:0.3"><u><?php echo $prog->nama ?></u></p>
                              <p style="line-height:0.3">NIP.<?php echo $prog->nip ?></p>
                          </td>
                          <td>
                              <?php $pjk = $this->model_polling->get_pj($uris)->row() ?>
                              <p style="line-height:0.3"><u><?php echo $pjk->nama ?></u></p>
                              <p style="line-height:0.3">NIP.<?php echo $pjk->nip ?></p>
                          </td>
                      </tr>
                  </table>
                  
                  <table style="width:100%;margin-top:30px;border-collapse: collapse; border:1px solid black">
                      <tr>
                          <td style="width:2%">1</td>
                          <td style="width:38%" colspan="2">Dana Pagu Kegiatan</td>
                          <td style="width:10%;text-align:right">Rp <?php echo number_format($jumlah_pagu) ?></td>
                          <td style="width:15%">&nbsp;</td>
                          <td style="border:1px solid black;width:35%" rowspan="5">
                          <p style="line-height:0.3;text-align:center">Mengetahui,<p>
                          <p style="line-height:0.3;text-align:center">Kepala Balai<p>
                          
                          <?php 
                                if(!empty($get_id_subdetil_sp)){
                                if($get_id_subdetil_sp->ttd_kabalai=="Tolak"){
                                    
                                    $icons = "<a href='#' data-toggle='modal' data-target='#penolakan_kabalai'><i class='fa fa-times' style='font-size:40px;color:red;margin-left:180px'></i></a>";
                                    $count_kabalai = 0;
                                } else if ($get_id_subdetil_sp->ttd_kabalai==""){
                                    $icons = "<b style='font-size:40px;color:black;margin-left:180px'>-</b>";
                                    $count_kabalai = 0;
                                } else {
                                    $icons = "<i class='fa fa-check-square' style='font-size:40px;color:green;margin-left:180px'></i>";
                                    $count_kabalai = 1;
                                }
                                echo $icons;
                                
                                /*
                                if($get_id_subdetil_sp->verif_keuangan=="Tolak"){
                                    
                                    $ico = str_repeat('&nbsp;',10)."<a href='#' data-toggle='modal' data-target='#penolakan_keuangan'><img style='width:80px' src='http://new.gorontalo.litbang.pertanian.go.id/web/asset/file_lainnya/reject.png'></a>";
                                    $count_keuangan = 0;
                                } else if ($get_id_subdetil_sp->verif_keuangan==""){
                                    $ico = str_repeat('&nbsp;',40).".....";
                                    $count_keuangan = 0;
                                } else {
                                    $ico = str_repeat('&nbsp;',10)."<img style='width:80px' src='http://new.gorontalo.litbang.pertanian.go.id/web/asset/file_lainnya/approv.png'>";
                                    $count_keuangan = 1;
                                }
                                echo $ico;
                                */
                                
                                }
                                ?>
                         
                          <?php $kabalai = $this->model_polling->get_stakeholder(1)->row() ?>
                          <p style="line-height:0.3;text-align:center"><u><?php echo $kabalai->nama ?></u></p>
                          <p style="line-height:0.3;text-align:center">NIP.<?php echo $kabalai->nip ?></p>
                          </td>
                      </tr>
                      <tr>
                          <td>2</td>
                          <td colspan="2">Total Realisasi</td>
                          <td style="text-align:right">Rp <?php echo $realx ?></td>
                          <td>&nbsp;</td>
                          
                      </tr>
                      <tr>
                          <td>3</td>
                          <td colspan="2">Persentase Realisasi Keuangan</td>
                          <!--<td style="text-align:right"><?php $persentase = ($realisasix / $jumlah_pagu) * 100; echo number_format($persentase,1) ?>%</td>-->
                          <td style="text-align:right"><?php $persentase = ($tot_pengajuan_rl / $jumlah_pagu) * 100; echo number_format($persentase,1) ?>%</td>
                          <td>&nbsp;</td>
                          
                      </tr>
                      <?php 
                      if(empty($data_sp->persentase)){
                          $prsnt = 0;
                      } else {
                          $prsnt = $data_sp->persentase;
                      }
                      ?>
                      <tr>
                          <td>4</td>
                          <td colspan="2">Persentase Kegiatan</td>
                          <td style="text-align:right"><?= $prsnt; ?>%</td>
                          <td>&nbsp;</td>
                          
                      </tr>
                      <tr>
                          <td>5</td>
                          <td colspan="2">Sisa Dana dalam Pagu</td>
                          <td style="text-align:right">Rp <?php echo $tot_sisa ?></td>
                          <td>&nbsp;</td>

                      </tr>
                  </table>
                </div>
             </div>
             <div class='card-footer'>
                 <?php 
                    if(!empty($get_id_subdetil_sp)){
                    $total_stak = $count_ppk+$count_program+$count_pj+$count_kabalai;
                    }
                 ?>
                <a href="<?php echo base_url().$this->uri->segment(1).'/kegiatan_pumk' ?>"><button type='button' class='btn btn-danger pull-right'>Kembali</button></a>
                <?php
                if(!empty($get_id_subdetil_sp)){
                    if($total_stak==4){
                ?>
                <a href="<?php echo base_url().'sijuara/tes_pdf/'.$uris.'/'.$get_id_subdetil_sp->tanggal.'/'.$get_id_subdetil_sp->kode_tr?>" target="_blank"><button type='button' class='btn btn-info pull-right'>PDF</button></a>
                <a href="<?php echo base_url().'sijuara/tes_pdf_manual/'.$uris.'/'.$get_id_subdetil_sp->tanggal.'/'.$get_id_subdetil_sp->kode_tr?>" target="_blank"><button type='button' class='btn btn-success pull-right'>PDF TTD</button></a>
                <?php
                    if($get_id_subdetil_sp->username==$this->session->username){
                ?>
                <a href="#" data-toggle="modal" data-target="#end"><button type='button' class='btn btn-success pull-right'>Selesai</button></a>
                <?php
                    }
                ?>
                <?php
                    }
                }
                 ?>
            </div>
            <?php } ?>
    </div>
</div>

<div class="modal fade" id="end" tabindex="-1">
<div class="modal-dialog modal-md">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Pengajuan Telah Selesai ?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <?php
        $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open('sijuara/selesai',$attributes);
        ?>
          <input type="hidden" name="uriss" value="<?php echo $uris ?>">
          <input type="hidden" name="kode_tr" value="<?php echo $get_id_subdetil_sp->kode_tr ?>">
          <button type="submit" name="submit" class="btn btn-success">Selesai</button>
        </form>
    </div>
    <div class = "modal-footer" > 
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="detail_tolak" tabindex="-1">
<div class="modal-dialog modal-xl">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Alasan Dipending ?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <p><?php echo $get_id_subdetil_sp->alasan_pj ?></p>
      </div>
    </div>
    <div class = "modal-footer" > 
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="penolakan_kabalai" tabindex="-1">
<div class="modal-dialog modal-xl">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Alasan Dipending ?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <p><?php echo $get_id_subdetil_sp->alasan_kabalai ?></p>
      </div>
    </div>
    <div class = "modal-footer" > 
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="penolakan_program" tabindex="-1">
<div class="modal-dialog modal-xl">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Alasan Dipending ?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <p><?php echo $get_id_subdetil_sp->alasan_program ?></p>
      </div>
    </div>
    <div class = "modal-footer" > 
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="penolakan_ppk" tabindex="-1">
<div class="modal-dialog modal-xl">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Alasan Dipending ?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <p><?php echo $get_id_subdetil_sp->alasan_ppk ?></p>
      </div>
    </div>
    <div class = "modal-footer" > 
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="penolakan_keuangan" tabindex="-1">
<div class="modal-dialog modal-xl">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Alasan Dipending ?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <p><?php echo $get_id_subdetil_sp->alasan_keuangan ?></p>
      </div>
    </div>
    <div class = "modal-footer" > 
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>