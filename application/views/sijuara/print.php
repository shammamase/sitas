<html> 
	<body>
	   <?php
	        $keg = $kegiatan->row();
            $data_sp = $dt_sp->row();
            $text_keg_sub = $keg->subkomp."-".$keg->kd_ro.".".$keg->kd_komponen.".".$keg->kd_subkomp;
            $text_ks = wordwrap($text_keg_sub,88,"<br />\n");
            $jml_huruf =  strlen($text_keg_sub);
            
            if($jml_huruf>=85){
                $spasi_tgl = "";
            } else {
                $spasi_tgl = str_repeat('&nbsp;',150);
            }
	    ?>
	    <!--<div style="border:1 px solid black">-->
        <div>
		<div><img style="width:95%; margin-left:15px" src="<?php echo base_url().'asset/kopsurat.jpg' ?>"></div>
		<h5 style="text-align:center;margin-top:0px">FORM PENGAJUAN</h5>
		<p style="text-align:center;margin-top:-10px;font-size:11px">TAHUN ANGGARAN <?php echo $keg->ta ?></p>
		<table style="margin-left:10px;margin-top:10px;width:100%;font-size:12px" border="0">
          <tr>
              <td>Nomor</td><td>:</td><td><?php echo $data_sp->nomor.$spasi_tgl ?></td><td><?php echo tgl_indo($data_sp->tanggal_ajukan) ?></td>
          </tr>
          <tr>
              <td>Lampiran</td><td>:</td><td><?php echo $data_sp->lampiran ?> Lampiran</td><td></td>
          </tr>
          <tr>
              <td style="width:5%;">Kegiatan/Sub Kegiatan</td><td style="vertical-align:middle">:</td><td style="vertical-align:middle"><?php echo $text_ks ?></td><td></td>
          </tr>
          <tr>
              <td>Untuk Keperluan</td><td>:</td><td><?php echo $data_sp->keperluan ?></td><td></td>
          </tr>
        </table>
        
        <table style="width:80%;margin-left:10px;margin-top:0px;border-collapse:collapse;border:1 px solid black;font-size:12px;text-transform:capitalize">
                    <tr style="border:1 px solid black">
                      <td style="text-align:center;border:1 px solid black; vertical-align:middle">No</td>
                      <td style="text-align:center;border:1 px solid black; vertical-align:middle;width:10%">Akun</td>
                      <td style="text-align:center;border:1 px solid black; vertical-align:middle">Uraian</td>
                      <td style="text-align:center;border:1 px solid black; vertical-align:middle;width:15%">Pagu</td>
                      <td style="text-align:center;border:1 px solid black; vertical-align:middle;width:18%">Realisasi yg lalu</td>
                      <td style="text-align:center;border:1 px solid black; vertical-align:middle;width:15%">Pengajuan ini</td>
                      <td style="text-align:center;border:1 px solid black;width:15%">Realisasi s/d Pengajuan ini</td>
                      <td style="text-align:center;border:1 px solid black; vertical-align:middle;width:13%">Sisa Dana</td>
                    </tr>
                  
                  <?php 
                    $no = 1;
                    $jumlah_pagu = 0;
                    $realisasix = 0;
                    $realisasiw = 0;
                    $pengajuany = 0;
                    $tot_pengajuan_rl = 0;
                    $tot_sisa_dana = 0;
                    $pass_id_subdetil = "";
                    foreach($detil->result() as $dtl){
                        $pi_dtl = $this->model_polling->pengajuan_ini_detil_pdf($dtl->id_detil,$uri4,$uri5)->row();
                        $rl_dtl = $this->model_polling->realisasi_detil_pdf($dtl->id_detil,$uri4)->row();
                        $rl_dtw = $this->model_polling->realisasi_detil_pdf_z($dtl->id_detil,$uri4)->row();
                        //$rl_pdff = $rl_dtl->jlx_detil - $pi_dtl->jlx_detil;
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
                        $text_dtl = wordwrap($dtl->detil, 35, "<br />\n");
                        
                        $realisasix += $rl_dtl->jlx_detil;
                        $realisasiw += $rl_dtw->jlx_detil;
                        $pengajuany += $pi_dtl->jlx_detil;
                        $tot_pengajuan_rl += $rl_pi_dtl;
                        $tot_sisa_dana += $sd_dtl;
                        
                 ?>
                 <tr style="background-color:#cccccc;border:1 px solid black">
                     <td style="text-align:center;border:1 px solid black;vertical-align:middle"><?php echo $no ?></td>
                     <td style="border:1 px solid black;vertical-align:middle;text-align:center"><?php echo $dtl->kd_detil ?></td>
                     <td style="border:1 px solid black"><?php echo $text_dtl ?></td>
                     <td style="text-align:right;border:1 px solid black;vertical-align:middle"><?php echo number_format($dtl->jumlah_biaya,0," ",",") ?></td>
                     <td style="text-align:right;border:1 px solid black;vertical-align:middle"><?php echo $rl_dt ?></td>
                     <td style="text-align:right;border:1 px solid black;vertical-align:middle"><?php echo $pi_dt ?></td>
                     <td style="text-align:right;border:1 px solid black;vertical-align:middle"><?php echo $rl_pi ?></td>
                     <td style="text-align:right;border:1 px solid black;vertical-align:middle"><?php echo $sd_d ?></td>
                 </tr>
                 <?php
                 $no++;
                    $subdetil = $this->db->query("select * from sijuara_subdetil where id_detil = '$dtl->id_detil'")->result();
                        foreach($subdetil as $sdtl){
                            
                            $jlh = $sdtl->vol * $sdtl->harga_satuan;
                            $textx = wordwrap($sdtl->subdetil, 30, "<br />\n");
                            $pi_sbdtl = $this->model_polling->pengajuan_ini_subdetil_pdf($sdtl->id_subdetil,$uri4,$uri5)->row();
                            $rl_sbdtl = $this->model_polling->realisasi_subdetil_pdf($sdtl->id_subdetil,$uri4)->row();
                            //$rl_pdf = $rl_sbdtl->jlx_subdetil - $pi_sbdtl->jlx_subdetil;
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
                        <tr>
                             <td style="border:1 px solid black"></td>
                             <td style="border:1 px solid black"></td>
                             <td style="border:1 px solid black"><?php echo $textx ?></td>
                             <td style="text-align:right;border:1 px solid black;vertical-align:middle"><?php echo number_format($jlh,0," ",",") ?></td>
                             <td style="text-align:right;border:1 px solid black;vertical-align:middle"><?php echo $rl_sbdt ?></td>
                             <td style="text-align:right;border:1 px solid black;vertical-align:middle"><?php echo $pi_sbd ?></td>
                             <td style="text-align:right;border:1 px solid black;vertical-align:middle"><?php echo $pi_rl ?></td>
                             <td style="text-align:right;border:1 px solid black;vertical-align:middle"><?php echo $sd_sb ?></td>
                         </tr>
                        <?php    
                        }
                    }
                  ?>
                    <tr style="border:1 px solid black">
                        <td style="border:1 px solid black">&nbsp;</td>
                        <td style="border:1 px solid black"  colspan="2">Jumlah</td>
                        <td style="text-align:right;border:1 px solid black"><?php echo number_format($jumlah_pagu) ?></td>
                        <td style="text-align:right;border:1 px solid black">
                            <?php 
                                
                                if($realisasix!=0){
                                $realx = number_format($realisasix);
                                } 
                                else {
                                $realx = "-";
                                }
                                
                                /*
                                if($realisasiw!=0){
                                $realx = number_format($realisasiw);
                                } 
                                else {
                                $realx = "-";
                                }
                                */
                            echo $realx;
                            ?>
                        </td>
                        <td style="text-align:right;border:1 px solid black">
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
                        <td style="text-align:right;border:1 px solid black">
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
                        <td style="text-align:right;border:1 px solid black">
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
                  </table>
                  
                  <table style="width:80%;margin-left:30px;margin-top:10px;border-collapse: collapse;font-size:12px;">
                      <tr>
                          <td style="width:45%">Menyetujui,</td>
                          <td style="width:40%">Mengetahui,</td>
                          <td style="width:25%">Yang mengajukan,</td>
                      </tr>
                      <tr>
                          <td>an. Kuasa Pengguna Anggaran</td>
                          <td>Koordinator Program</td>
                          <td>Penanggungjawab Kegiatan</td>
                          
                      </tr>
                      <tr>
                          <td>Pejabat Pembuat Komitmen</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                      </tr>
                      <tr>
                          <td>
                              <?php $ppk = $this->model_polling->get_stakeholder(3)->row() ?>
                              <img style="height:70px" src="<?php echo base_url() ?><?php echo $ppk->ttd ?>">
                          </td>
                          <td>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <?php $prog = $this->model_polling->get_stakeholder(2)->row() ?>
                              <img style="height:70px" src="<?php echo base_url() ?><?php echo $prog->ttd ?>">
                          </td>
                          <td>
                              <?php $pjk = $this->model_polling->get_pjx($pjb->ttd_pj)->row() ?>
                              <img style="height:70px" src="<?php echo base_url() ?><?php echo $pjk->ttd ?>">
                          </td>
                      </tr>
                      <tr>
                          <td style="width:45%">
                              <u><?php echo $ppk->nama ?></u>
                              <br>NIP.<?php echo $ppk->nip ?>
                          </td>
                          <td style="width:35%">
                              <u><?php echo $prog->nama ?></u>
                              <br>NIP.<?php echo $prog->nip ?>
                          </td>
                          <td style="width:30%">
                              <u><?php echo $pjk->nama ?></u>
                              <br>NIP.<?php echo $pjk->nip ?>
                          </td>
                      </tr>
                  </table>
                  
                  <table style="width:80%;margin-left:30px;border-collapse: collapse; border:1px solid black;font-size:12px">
                      <tr>
                          <?php  ?>
                          <?php 
                            //$kabalai = $this->model_polling->get_stakeholder(1)->row();
                            $kabalai = $this->model_polling->get_user_ttd($data_sp->ttd_kabalai)->row(); 
                          ?>
                          <td style="height:15px;border-top:1px solid black;border-left:1px solid black">&nbsp;1&nbsp;</td>
                          <td style="border-top:1px solid black;width:38%">Dana Pagu Kegiatan</td>
                          <td style="border-top:1px solid black;border-right:1px solid black;text-align:right">Rp <?php echo number_format($jumlah_pagu) ?>&nbsp;&nbsp;</td>
                          <td style="border-top:1px solid black;border-right:1px solid black"><?php echo str_repeat('&nbsp;',18) ?>Mengetahui,<?php echo str_repeat('&nbsp;',5) ?></td>
                          <td rowspan="5">
                             <?php echo str_repeat('&nbsp;',5) ?><img style="width:100px" src="<?php echo base_url() ?>asset/file_lainnya/qr_code/<?php echo $uri5 ?>.png"> 
                          </td>
                      </tr>
                      <tr>
                          <td style="height:15px;border-left:1px solid black">&nbsp;2&nbsp;</td>
                          <td>Total Realisasi</td>
                          <!--<td style="border-right:1px solid black;text-align:right">Rp <?php echo $realx ?>&nbsp;&nbsp;</td>-->
                          <td style="border-right:1px solid black;text-align:right">Rp <?php echo $tot_peng ?>&nbsp;&nbsp;</td>
                          <td style="border-right:1px solid black"><?php echo str_repeat('&nbsp;',18) ?>Kepala Balai<?php echo str_repeat('&nbsp;',5) ?></td>
                      </tr>
                      <tr>
                          <td style="height:15px;border-left:1px solid black">&nbsp;3&nbsp;</td>
                          <td>Persentase Realisasi Keuangan</td>
                          <!--<td style="border-right:1px solid black;text-align:right"><?php $persentase = ($realisasix / $jumlah_pagu) * 100; echo number_format($persentase,1) ?>%&nbsp;&nbsp;</td>-->
                          <td style="border-right:1px solid black;text-align:right"><?php $persentase = ($realisasiw / $jumlah_pagu) * 100; echo number_format($persentase,1) ?>%&nbsp;&nbsp;</td>
                          <td style="border-right:1px solid black" rowspan="3">
                              <?php echo str_repeat('&nbsp;',18) ?><img src="<?php echo base_url() ?><?php echo $kabalai->ttd ?>">
                          </td>
                      </tr>
                      <tr>
                          <td style="height:15px;border-left:1px solid black">&nbsp;4&nbsp;</td>
                          <td>Persentase Kegiatan</td>
                          <td style="border-right:1px solid black;text-align:right"><?php echo $data_sp->persentase ?>%</td>
                      </tr>
                      <tr>
                          <td style="height:15px;border-left:1px solid black">&nbsp;5&nbsp;</td>
                          <td>Sisa Dana dalam Pagu</td>
                          <td style="border-right:1px solid black;text-align:right">Rp <?php echo $tot_sisa ?>&nbsp;&nbsp;</td>
                      </tr>
                      <tr>
                          <td style="height:15px;border-left:1px solid black">&nbsp;&nbsp;</td>
                          <td>&nbsp;&nbsp;</td>
                          <td style="border-right:1px solid black;text-align:right">&nbsp;&nbsp;</td>
                          <td style="border-right:1px solid black"><?php echo str_repeat('&nbsp;',10) ?><u><?php echo $kabalai->nama ?></u><?php echo str_repeat('&nbsp;',5) ?></td>
                      </tr>
                      <tr>
                          <td style="height:5px;border-left:1px solid black;border-bottom:1px solid black">&nbsp;&nbsp;</td>
                          <td style="border-bottom:1px solid black">&nbsp;&nbsp;</td>
                          <td style="border-right:1px solid black;border-bottom:1px solid black;text-align:right">&nbsp;&nbsp;</td>
                          <td style="border-bottom:1px solid black;border-right:1px solid black"><?php echo str_repeat('&nbsp;',10) ?>NIP.<?php echo $kabalai->nip ?><?php echo str_repeat('&nbsp;',5) ?></td>
                      </tr>
                  </table><br>
        </div>
        
        <div style="page-break-after:always; clear:both"></div>
        
        <?php
            $jml_hurufx =  strlen($text_keg_sub);
            if($jml_hurufx>=90){
                $spasi_tglx = "";
            } else {
                $spasi_tglx = str_repeat('&nbsp;',130);
            }
        $qw_get_pengajuan = $this->db->query("select a.id_detil,a.id_subdetil,a.tanggal_ajukan,a.username,a.ttd_pj,b.kd_detil
                                              from sijuara_simpan_pengajuan a
                                              inner join sijuara_detil b on a.id_detil = b.id_detil
                                              where a.kode_tr = '$uri5'")->result();
        foreach($qw_get_pengajuan as $pg){
            $ttx = $text_keg_sub.".".$pg->kd_detil;
            $text_ksx = wordwrap($ttx,90,"<br />\n");
            $get_keperluan = $this->model_polling->get_keperluan($pg->id_subdetil,$uri5)->row();
            $pc_for = explode("#",$get_keperluan->untuk);
        ?>
        <!--<div style="border:1 px solid black">-->
        <div>
		<div><img style="width:95%; margin-left:15px" src="<?php echo base_url().'asset/kopsurat.jpg' ?>"></div>
		<h5 style="text-align:center;margin-top:0px">RINCIAN PENGAJUAN</h5>
		<p style="text-align:center;margin-top:-10px;font-size:11px">TAHUN ANGGARAN <?php echo $keg->ta ?></p>
		<table style="margin-left:10px;margin-top:10px;width:100%;font-size:13px" border="0">
          <tr><td colspan="4"><?= str_repeat('&nbsp;',160) ?>Gorontalo,<?php echo tgl_indo($data_sp->tanggal) ?></td></tr>
          <tr>
              <td>Nomor</td><td>:</td><td><?php echo $spasi_tglx ?></td><td>&nbsp;</td>
          </tr>
          <tr>
              <td style="width:5%;">Kegiatan/Sub Kegiatan</td><td style="vertical-align:middle">:</td><td style="vertical-align:middle"><?php echo $text_ksx ?></td><td>&nbsp;</td>
          </tr>
          <tr>
              <td>Untuk Keperluan</td><td>:</td><td><?php echo $pc_for[0] ?></td><td></td>
          </tr>
        </table>
        <table style="width:80%;margin-left:10px;margin-top:10px;border-collapse:collapse;border:1 px solid black;font-size:13px">
                    <tr style="background-color:#cccccc;border:1 px solid black">
                      <td style="text-align:center;border:1 px solid black; vertical-align:middle"><b>NO</b></td>
                      <td style="text-align:center;border:1 px solid black; vertical-align:middle"><b>URAIAN</b></td>
                      <td colspan="2" style="text-align:center;border:1 px solid black; vertical-align:middle"><b><?php echo str_repeat('&nbsp;',5) ?>VOLUME<?php echo str_repeat('&nbsp;',5) ?></b></td>
                      <td style="text-align:center;border:1 px solid black; vertical-align:middle"><b><?php echo str_repeat('&nbsp;',5) ?>HARGA SATUAN<?php echo str_repeat('&nbsp;',5) ?></b></td>
                      <td style="text-align:center;border:1 px solid black; vertical-align:middle"><b><?php echo str_repeat('&nbsp;',5) ?>JUMLAH<?php echo str_repeat('&nbsp;',5) ?></b></td>
                    </tr>
                  
                  <?php 
                    $jumlah_rincian = 0;
                    $no_rn = 1;
                    $get_rincian = $this->model_polling->get_keperluan($pg->id_subdetil,$uri5)->result();
                    foreach($get_rincian as $gt_rn){
                        $jumlahx = $gt_rn->qty * $gt_rn->harga_satuan;
                        $jumlah_rincian+=$jumlahx;
                        $txtt = wordwrap($gt_rn->nama_barang, 40, "<br />\n");
                 ?>
                 <tr style="border:1 px solid black">
                     <td style="text-align:center;border:1 px solid black;vertical-align:middle"><?php echo $no_rn ?></td>
                     <td style="border:1 px solid black;vertical-align:middle;text-align:left"><?php echo $txtt.str_repeat('&nbsp;',10) ?></td>
                     <td style="text-align:center;border:1 px solid black;vertical-align:middle"><?php echo $gt_rn->qty ?></td>
                     <td style="text-align:center;border:1 px solid black;vertical-align:middle"><?php echo $gt_rn->vol ?></td>
                     <td style="text-align:right;border:1 px solid black;vertical-align:middle"><?php echo number_format($gt_rn->harga_satuan) ?></td>
                     <td style="text-align:right;border:1 px solid black;vertical-align:middle"><?php echo number_format($jumlahx) ?></td>
                 </tr>
                 <?php
                 $no_rn++;
                 } 
                 ?>
            <tr style="border:1 px solid black">
                <td colspan="5" style="border:1 px solid black">Jumlah</td>
                <td style="text-align:right;border:1 px solid black"><?php echo number_format($jumlah_rincian) ?></td>
            </tr>
          </table>
          
          <table style="width:80%;margin-left:30px;margin-top:20px;border-collapse: collapse;font-size:12px;">
                      <tr>
                          <td style="width:45%"></td>
                          <td style="width:40%"></td>
                          <td style="width:25%"></td>
                      </tr>
                      <tr>
                          <td>PUMK</td>
                          <td>Penanggungjawab Kegiatan</td>
                          <td></td>
                          
                      </tr>
                      <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                      </tr>
                      <tr>
                          <td>
                              <?php $pums = $this->model_polling->get_pumk($pg->username)->row() ?>
                              <img style="height:70px" src="<?php echo base_url() ?><?php echo $pums->ttd ?>">
                          </td>
                          <td>
                              <?php $pjk = $this->model_polling->get_pjx($pjb->ttd_pj)->row() ?>
                              <img style="height:70px" src="<?php echo base_url() ?><?php echo $pjk->ttd ?>">
                          </td>
                          <td>
                              <img style="width:100px" src="<?php echo base_url() ?>asset/file_lainnya/qr_code/<?php echo $uri5 ?>.png">
                          </td>
                      </tr>
                      <tr>
                          <td style="width:45%">
                              <u><?php echo $pums->nama ?></u>
                              <br>NIP.<?php echo $pums->nip ?>
                          </td>
                          <td style="width:35%">
                              <u><?php echo $pjk->nama ?></u>
                              <br>NIP.<?php echo $pjk->nip ?>
                          </td>
                          <td style="width:30%">
                              
                          </td>
                      </tr>
                  </table>
		</div>
		<div style="page-break-after:always; clear:both"></div>
        <?php
        }
        ?>
	</body>
	</html>