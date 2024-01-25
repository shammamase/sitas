<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar SPT</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:2%">No</th>
        <th style="width:29%">SPT</th>
        <th style="width:10%">No Surat</th>
        <th style="width:18%">Kepada</th>
        <th style="width:17%">Untuk</th>
        <th style="width:7%">Tanggal</th>
        <!--<th style="width:7%">Tanggal SPT</th>-->
        <th style="width:7%">DIPA</th>
        <th style="width:10%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        $no_hp = $kabalai->no_hp;
        $no_wa = substr_replace("$no_hp","62",0,1);
        foreach ($rec->result() as $row){
            $links = base_url()."sijuara/verif_spt_detail/".$row->id_spt;
            $pesan = "*Layanan SIMANTEP* Mohon untuk mengecek pengajuan SPT, silahkan klik link $links";
            $kpda = $this->model_more->get_peg_spt($row->id_spt);
            $no_surat = $this->model_more->get_surat_spt($row->id_spt);
            if($no_surat){
                $no_sr = $no_surat->no_lengkap;
            } else {
                $no_sr = $row->keterangan;
            }
            
            if($row->is_dipa==1){
                $dip = "Ya";
            } else {
                $dip = "Tidak";
            }
     ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $row->menimbang ?></td>
        <td><?= $no_sr ?></td>
        <td>
                <?php
                $nok = 1;
                foreach($kpda as $kpd){
                    $tgl_plk = $kpd->tanggal;
                ?>
                <?= $nok.". ".$kpd->nama ?><br>
                <?php
                $nok++;
                }
                
                //logika tgl s.d tgl
                $pc_tgl_plk = explode(",",$tgl_plk);
                $jml_tgl = count($pc_tgl_plk);
                if($jml_tgl>1){
                    $pc1 = explode("-",$pc_tgl_plk[0]);
                    $pc2 = explode("-",end($pc_tgl_plk));
                    if($pc1[1]==$pc2[1]){
                        $val_tgl = $pc1[2]." s.d ".tgl_indo(end($pc_tgl_plk));
                    } else {
                        $pc11 = explode(" ",tgl_indo($pc_tgl_plk[0]));
                        $val_tgl = $pc11[0]." ".$pc11[1]." s.d ".tgl_indo(end($pc_tgl_plk));
                    }
                } else {
                    $val_tgl = tgl_indo($pc_tgl_plk[0]);
                }
                // end logika tgl s.d tgl
                
                ?>
        </td>
        <td><?php echo $row->untuk ?></td>
        <td><?php echo $val_tgl ?></td>
        <!--<td><?php echo tgl_indoo($row->tanggal) ?></td>-->
        <td><?php echo $dip ?></td>
        <td>
            <?php
            if($row->verif_kabalai==1){
            ?>
            <a class='btn btn-warning btn-xs' title='Copy Data' href="<?php echo base_url() ?>sijuara/copy_spt?id_spt=<?php echo $row->id_spt ?>"><i class='fas fa-copy'></i> Copy</a>
            <a class='btn btn-success btn-xs' title='Edit' href="<?php echo base_url() ?>sijuara/edit_spt?id_spt=<?php echo $row->id_spt ?>"><i class='fas fa-edit'></i> Edit</a>
            <?php if($this->session->username == "ikha" || $this->session->username == "yulianti"){ ?>
            <a class='btn btn-danger btn-xs' title='Delete Data' href="<?php echo base_url() ?>sijuara/delete_spt/<?php echo $row->id_spt ?>" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')"><i class='fa fa-trash'></i> Hapus</a>
            <?php } ?>
            <button class='btn btn-primary btn-xs' data-target="#myModalsx" data-toggle="modal" data-id="<?= $row->id_spt ?>"><i class='fas fa-file'></i> Lihat</button>
            <a class='btn btn-danger btn-xs' title='PDF' target="_blank" href="<?php echo base_url() ?>sijuara/pdf_spt/<?php echo md5($row->id_spt) ?>/<?= $row->id_spt ?>"><i class='fas fa-file-pdf'></i> PDF Scan</a>
            <a class='btn btn-danger btn-xs' title='PDF' target="_blank" href="<?php echo base_url() ?>sijuara/pdf_spt_manual/<?php echo md5($row->id_spt) ?>/<?= $row->id_spt ?>"><i class='fas fa-file-pdf'></i> PDF Asli</a>
            <?php
            } else {
            ?>
            <a class='btn btn-success btn-xs' title='Edit' href="<?php echo base_url() ?>sijuara/edit_spt?id_spt=<?php echo $row->id_spt ?>"><i class='fas fa-edit'></i> Edit</a>
            <a class='btn btn-danger btn-xs' title='Delete Data' href="<?php echo base_url() ?>sijuara/delete_spt/<?php echo $row->id_spt ?>" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')"><i class='fa fa-trash'></i> Hapus</a>
            <button class='btn btn-primary btn-xs' data-target="#myModalsx" data-toggle="modal" data-id="<?= $row->id_spt ?>"><i class='fas fa-file'></i> Lihat</button>
            <a class='btn btn-info btn-xs' title='Kirim' target="_blank" href="https://api.whatsapp.com/send?phone=<?= $no_wa ?>&text=<?= $pesan ?>"><i class='fa fa-share'></i> Kirim</a>
            <?php
            }
            ?>
        </td>
      </tr>
     <?php
      $no++;
        }
      ?>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card --> 

<div class="modal fade" id="myModalsx" role="dialog">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Surat Perintah Tugas</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="fetch_data"></div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  
<script>
    $(document).ready(function(){
        $('#myModalsx').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            $.ajax({
               type : 'post',
               url : '<?= base_url() ?>sijuara/lihat_spt',
               data : 'id_spt='+ rowid,
               success : function(data){
                   $('.fetch_data').html(data);
               }
            });
        });
    });
</script>