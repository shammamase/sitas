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
                                $pi_sbdt = "<a href='#' class='rincian' data-toggle='modal' nim='$sdtl->id_subdetil'>".number_format($pi_sbdtl->jlx_subdetil)."</a>";
                                $pi_sbd = $pi_sbdtl->jlx_subdetil;
                            } else {
                                $pi_sbdt = "-";
                                $pi_sbd = 0;
                            }
                            
                            
                            
                            if($pi_sbdtl->jlx_subdetil!=0){
                                $pi_sbdt = "<a href='#' class='rincian' data-toggle='modal' nim='$sdtl->id_subdetil'>".number_format($pi_sbdtl->jlx_subdetil)."</a>";
                                //$pi_sbd = number_format($pi_sbdtl->jlx_subdetil);
                                $pass_id_subdetil .= $pi_sbdtl->id_subdetil.",";
                            } else {
                                $pi_sbdt = "-";
                                //$pi_sbd = "-";
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
                             <td style="text-align:right"><?php echo $pi_sbdt ?></td>
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
                                if($get_id_subdetil_sp->ttd_ppk=="Tolak"){
                                    
                                    $icons = "<a href='#' data-toggle='modal' data-target='#penolakan_ppk'><i class='fa fa-times' style='font-size:40px;color:red;margin-left:50px'></i></a>";
                                } else if ($get_id_subdetil_sp->ttd_ppk==""){
                                    $icons = "<b style='font-size:40px;color:black;margin-left:50px'>-</b>";
                                } else {
                                    $icons = "<i class='fa fa-check-square' style='font-size:40px;color:green;margin-left:50px'></i>";
                                }
                                echo $icons;
                                ?>
                          </td>
                          <td>
                              <?php 
                                if($get_id_subdetil_sp->ttd_program=="Tolak"){
                                    
                                    $icons = "<a href='#' data-toggle='modal' data-target='#penolakan_program'><i class='fa fa-times' style='font-size:40px;color:red;margin-left:50px'></i></a>";
                                } else if ($get_id_subdetil_sp->ttd_program==""){
                                    $icons = "<b style='font-size:40px;color:black;margin-left:50px'>-</b>";
                                } else {
                                    $icons = "<i class='fa fa-check-square' style='font-size:40px;color:green;margin-left:50px'></i>";
                                }
                                echo $icons;
                                ?>
                          </td>
                          <td>
                              <?php 
                                if($get_id_subdetil_sp->ttd_pj=="Tolak"){
                                    $icons = "<a href='#' data-toggle='modal' data-target='#detail_tolaks'><i class='fa fa-times' style='font-size:40px;color:red;margin-left:50px'></i></a>";
                                } else if ($get_id_subdetil_sp->ttd_pj==""){
                                    $icons = "<b style='font-size:40px;color:black;margin-left:50px'>-</b>";
                                } else {
                                    $icons = "<i class='fa fa-check-square' style='font-size:40px;color:green;margin-left:50px'></i>";
                                }
                                echo $icons;
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
                                if($get_id_subdetil_sp->ttd_kabalai=="Tolak"){
                                    
                                    $icons = "<a href='#' data-toggle='modal' data-target='#penolakan_kabalai'><i class='fa fa-times' style='font-size:40px;color:red;margin-left:180px'></i></a>";
                                } else if ($get_id_subdetil_sp->ttd_kabalai==""){
                                    $icons = "<b style='font-size:40px;color:black;margin-left:180px'>-</b>";
                                } else {
                                    $icons = "<i class='fa fa-check-square' style='font-size:40px;color:green;margin-left:180px'></i>";
                                }
                                echo $icons;
                                
                                /*
                                if($get_id_subdetil_sp->verif_keuangan=="Tolak"){
                                    
                                    $ico = str_repeat('&nbsp;',10)."<a href='#' data-toggle='modal' data-target='#penolakan_keuangan'><img style='width:80px' src='http://new.gorontalo.litbang.pertanian.go.id/web/asset/file_lainnya/reject.png'></a>";
                                } else if ($get_id_subdetil_sp->verif_keuangan==""){
                                    $ico = str_repeat('&nbsp;',40).".....";
                                } else {
                                    $ico = str_repeat('&nbsp;',10)."<img style='width:80px' src='http://new.gorontalo.litbang.pertanian.go.id/web/asset/file_lainnya/approv.png'>";
                                }
                                echo $ico;
                                */
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
                      <tr>
                          <td>4</td>
                          <td colspan="2">Persentase Kegiatan</td>
                          <td style="text-align:right"><?= $get_id_subdetil_sp->persentase ?>%</td>
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
                <!--<a href="<?php echo base_url().$this->uri->segment(1).'/kegiatan_pumk' ?>"><button type='button' class='btn btn-primary pull-right'>Kembali</button></a>&nbsp;&nbsp;-->
                <a href="#" data-toggle='modal' data-target='#setujui'><button type='button' class='btn btn-success pull-right'><i class='fa fa-check-square'></i> Setujui</button></a>&nbsp;&nbsp;
                <a href="#" data-toggle='modal' data-target='#tolak'><button type='button' class='btn btn-danger pull-right'><i class='fa fa-times'></i> Tolak</button></a>&nbsp;&nbsp;
            </div>
            <?php } ?>
    </div>
</div>
<div class="modal hide fade" id="rincian_modal" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div id="tampil_modal">
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="setujui" tabindex="-1">
<div class="modal-dialog modal-xl">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Anda Akan Menyetujui Form Pengajuan Ini ?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <?php
        if($pejabat==2){
            $lnextp = "sijuara/verif/".$uris."/3";
            $nextp = 3;
        } else if($pejabat==3){
            $lnextp = "sijuara/verif/".$uris."/1";
            $nextp = 1;
        } else if($pejabat==1){
            $lnextp = "sijuara/pengajuan_status/".$uris;
            $nextp = 1;
        }
        $get_pejabat = $this->model_polling->get_pejabat($nextp)->row();
        $get_username = $this->model_polling->get_username($get_id_subdetil_sp->username)->row();
        if($pejabat==1){
            $no_hp_org = $get_username->no_hp;
        } else {
            $no_hp_org = $get_pejabat->no_hp;
        }
        $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open('sijuara/verif',$attributes);
        ?>
          <!--<input type="hidden" name="uriss" value="<?php echo $uris ?>">-->
          <input type="hidden" name="uriss" value="<?php echo $uris ?>">
          <input type="hidden" name="pejabat" value="<?php echo $pejabat ?>">
          <input type="hidden" name="id_subdetil" value="<?php echo $ps_id_sbdtl ?>">
          <input type="hidden" name="kode_tr" value="<?php echo $get_id_subdetil_sp->kode_tr ?>">
          <input type="hidden" name="username" value="<?php echo $this->session->username ?>">
          <input type="hidden" name="no_hp" value="<?php echo $no_hp_org ?>">
          <input type="hidden" name="links" value="<?php echo base_url() ?><?php echo $lnextp ?>">
          <div class="form-group">
            <label for="comment">Alasan:</label>
            <textarea class="form-control" name="alasan" rows="5"></textarea>
          </div>
          <button type="submit" name="submit" class="btn btn-success">Setuju</button>
        </form>
    </div>
    <div class = "modal-footer" > 
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="tolak" tabindex="-1">
<div class="modal-dialog modal-xl">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Anda Akan Menolak Form Pengajuan Ini ?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
    <?php
        $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open('sijuara/verif',$attributes);
        ?>
          <input type="hidden" name="uriss" value="<?php echo $uris ?>">
          <input type="hidden" name="pejabat" value="<?php echo $pejabat ?>">
          <input type="hidden" name="id_subdetil" value="<?php echo $ps_id_sbdtl ?>">
          <input type="hidden" name="kode_tr" value="<?php echo $get_id_subdetil_sp->kode_tr ?>">
          <input type="hidden" name="username" value="Tolak">
          <input type="hidden" name="no_hp" value="<?php echo $get_username->no_hp ?>">
          <input type="hidden" name="links" value="<?php echo base_url() ?>sijuara/pengajuan_status/<?php echo $uris ?>">
          <div class="form-group">
            <label for="comment">Alasan:</label>
            <textarea class="form-control" name="alasan" rows="5"></textarea>
          </div>
          <button type="submit" name="submit" class="btn btn-danger">Tolak</button>
        </form>
    </div>
    <div class = "modal-footer" > 
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="detail_tolaks" tabindex="-1">
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

<script>
        
        $('.rincian').click(function(){

            var nim = $(this).attr("nim");
            $.ajax({
                url: '<?php echo base_url(); ?>/sijuara/list_rincian',
                method: 'post',
                data: {nim:nim},
                success:function(data){
                    $('#rincian_modal').modal("show");
                    $('#tampil_modal').html(data);
                }
            });
        });
</script>