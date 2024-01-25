<?php
$usd = $this->session->username;
$levs = $this->db->query("select username from sijuara_user where username = '$usd'")->row();
?>
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
              <?php 
              $pj = $get_pj->row();
              $hr_ini = date('Y-m-d');
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open('sijuara/pengajuan_full',$attributes); 
               ?>
                <div class='col-md-12'>
                  <input type="hidden" name="no_hp" value="<?php echo $pj->no_hp ?>">
                  <input type="hidden" name="links" value="<?php echo base_url().'sijuara/verif_pj/'.$uris ?>">
                  <table style="width:100%" border="0">
                      <tr>
                          <td style="width:12%">Nomor</td><td style="width:2%">:</td><td style="width:66%"><input type="text" class="form-control" name="nomor" style="width: 8%" required></td><td style="width:20%"><?php echo tgl_indo($hr_ini) ?></td>
                      </tr>
                      <tr>
                          <td>Lampiran</td><td>:</td><td><input type="text" class="form-control" name="lampiran" style="width: 8%" required></td><td></td>
                      </tr>
                      <tr>
                          <td>Persentase Kegiatan</td><td>:</td><td><input type="text" class="form-control" name="persentase" style="width: 8%" required></td><td></td>
                      </tr>
                      <tr>
                          <td>Kegiatan/Sub Kegiatan</td><td>:</td><td><?php echo $keg->subkomp ?> - <?php echo $keg->kd_ro ?>.<?php echo $keg->kd_komponen ?>.<?php echo $keg->kd_subkomp ?></td><td></td>
                      </tr>
                      <tr>
                          <td>Untuk Keperluan</td><td>:</td><td><input type="text" class="form-control" name="keperluan" required></td><td></td>
                      </tr>
                  </table>
                  <input type="hidden" name="user" value="<?php echo $user ?>">
                  <input type="hidden" name="uris" value="<?php echo $uris ?>">
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
                    <!--
                    keterangan input text
                    a = pagu
                    b = realisasi lalu
                    c = pengajuan ini
                    cc = pengajuan ini angka
                    d = realisasi sd pengajuan ini
                    dd = realisasi sd pengajuan ini angka
                    ee = sisa dana angka
                    eee = sisa dana
                    -->      
                    
                  <?php 
                    $no = 1;
                    $jumlah_pagu = 0;
                    $realisasix = 0;
                    $persen = 0;
                    $pengajuany = 0;
                    $tot_pengajuan_rl = 0;
                    $tot_sisa_dana = 0;
                    $pengajuan2 = "";
                    $pass_sdt = "";
                    foreach($detil->result() as $dtl){
                        $pi_dtl = $this->model_polling->pengajuan_ini_detil($dtl->id_detil)->row();
                        $rl_dtl = $this->model_polling->realisasi_detil($dtl->id_detil)->row();
                        $rl_pi_dtl = $pi_dtl->jlx_detil + $rl_dtl->jlx_detil;
                        //$sd_dtl = $dtl->jumlah_biaya - $rl_dtl->jlx_detil;
                        $sd_dtl = $dtl->jumlah_biaya - $rl_pi_dtl;
                        if($pi_dtl->jlx_detil!=0){
                            $pi_dt = number_format($pi_dtl->jlx_detil);
                            $pengajuan2 .= $pi_dtl->id_detil.",";
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
                            $rl_dtl2 = $this->model_polling->get_tot_rincian($sdtl->id_subdetil)->row();
                            $pi_rl_sbdtl = $pi_sbdtl->jlx_subdetil + $rl_sbdtl->jlx_subdetil;
                            //$sd_sbdtl = $jlh - $rl_sbdtl->jlx_subdetil;
                            $sd_sbdtl = $jlh - $pi_rl_sbdtl;
                            
                            if($pi_sbdtl->jlx_subdetil!=0){
                                $pi_sbdt = "<a href='#' class='rincian' data-toggle='modal' nim='$sdtl->id_subdetil'>".number_format($pi_sbdtl->jlx_subdetil)."</a>";
                                $pi_sbd = $pi_sbdtl->jlx_subdetil;
                                $pass_sdt .= $sdtl->id_subdetil."-";
                            } else {
                                $pi_sbdt = "-";
                                $pi_sbd = 0;
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
                             <td><?php echo "" ?><input type="hidden" name="id_detil[]" value="<?php echo $dtl->id_detil ?>"></td>
                             <td><?php echo "" ?><input type="hidden" name="id_subdetil[]" value="<?php echo $sdtl->id_subdetil ?>"></td>
                             <td><?php echo $sdtl->subdetil ?></td>
                             <td style="text-align:right"><?php echo number_format($jlh,0," ",".") ?></td>
                             <td style="text-align:right"><?php echo $rl_sbdt ?></td>
                             <td style="text-align:right"><?php echo $pi_sbdt ?><input type="hidden" name="pengajuan_ini[]" value="<?php echo $pi_sbd ?>"/><input type="hidden" name="tanggal[]" value="<?php echo $pi_sbdtl->tanggal ?>"/></td>
                             <td style="text-align:right"><?php echo $pi_rl ?></td>
                             <td style="text-align:right"><?php echo $sd_sb ?></td>
                         </tr>
                        <?php
                        $persen += $rl_dtl2->tot_rn;
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
                  <b>Persentase Realisasi Keuangan <?php $persentase = ($persen / $jumlah_pagu) * 100; echo number_format($persentase,1) ?>%</b>
                </div>
             </div>
             <?php
                $konv_pass_sdt = substr($pass_sdt,0,-1);
                $atur_pengajuan = substr($pengajuan2,0,-1);
                if($atur_pengajuan!=""){
                    $qw_ajukan = $this->model_polling->pengajuan_ini_detil2($atur_pengajuan)->row();
                    if($qw_ajukan){
                        $tombol_ajukan = "disabled";
                    } else {
                        $tombol_ajukan = "";
                    }
                } else {
                    $qw_ajukan = "";
                    $tombol_ajukan = "";
                }
             ?>
             <?php if($levs->username=="yusufantu"){ ?>
             <?php } else { ?>
             <input type="hidden" name="inp_pass_sdt" value="<?php echo $konv_pass_sdt ?>" >
             <div class='card-footer'>
                <button type='submit' name='submit' class='btn btn-success' <?php echo $tombol_ajukan ?>>Ajukan</button>
                <a href="<?php echo base_url().$this->uri->segment(1).'/kegiatan_pumk' ?>"><button type='button' class='btn btn-danger pull-right'>Cancel</button></a>
            </div>
            <?php } ?>
            </form>
    </div>
</div>
<div class="col-md-12">
<div class="card card-outline card-success">
    <div class="card-header">
        <h2 class="card-title">List Pengajuan</h2>

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
        <?php
        $no_get_pengajuan = 1;
            $get_simpan_pengajuan = $this->db->query("select distinct a.keperluan,a.tanggal,a.kode_tr,a.status
                                                    from sijuara_simpan_pengajuan a
                                                    inner join sijuara_subdetil z on a.id_subdetil = z.id_subdetil
                                                    inner join sijuara_detil b on z.id_detil = b.id_detil
                                                    inner join sijuara_subkomp c on b.id_subkomp = c.id_subkomp
                                                    where c.id_subkomp = '$uris'
                                                    order by a.id_pengajuan desc");
            if($get_simpan_pengajuan){
                
            
            foreach($get_simpan_pengajuan->result() as $gsp){
                if($gsp->tanggal!=""){
                    if($gsp->status=="cair"){
                        $bg_tab = "bg-success";
                        $prnt = "<i class='fa fa-file-pdf' style='font-size:24px;color:red'></i>";
                    } else {
                        $bg_tab = "";
                        $prnt = "";
                    }
        ?>
        <table style="width:100%;margin-top:-10px" class='table table-bordered'>
        <tr class="<?php echo $bg_tab ?>">
          <td style="width:2%; text-align:center; font-size:14px;"><?php echo $no_get_pengajuan ?></td>
          <td style="width:48%; text-align:center; font-size:14px;"><?php echo $gsp->keperluan ?></td>
          <td style="width:30%; text-align:center; font-size:14px;"><?php echo $gsp->tanggal ?></td>
          <td style="width:30%; text-align:center; font-size:14px;"><a href="<?php echo base_url().'sijuara/tes_pdf/'.$uris.'/'.$gsp->tanggal.'/'.$gsp->kode_tr?>" target="_blank"><?php echo $prnt ?></a></td>
        </tr>
        </table>
        <?php
        $no_get_pengajuan++;
            }
         }    
        }
        ?>
    </div>
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
        
        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
          var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        
          // tambahkan titik jika yang di input sudah menjadi angka ribuan
          if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
          }
        
          rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
          return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
        }
        
        /* Fungsi formatangka */
        function formatangka(x,y) {
          var w = x.replace(/[^,\d]/g, "").toString(),
            split = w.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        
            if (ribuan) {
            separator = sisa ? "" : "";
            rupiah += separator + ribuan.join("");
          }
        
          rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
          return y == undefined ? rupiah : rupiah ? "" + rupiah : "";
        }
</script>
