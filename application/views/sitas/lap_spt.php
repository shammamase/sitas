<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar SPT</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:3%">No</th>
        <!--<th style="width:29%">SPT</th>-->
        <th style="width:25%">No Surat</th>
        <th style="width:20%">Kepada</th>
        <th style="width:27%">Untuk</th>
        <th style="width:10%">Tanggal</th>
        <th style="width:15%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        foreach ($rec as $row){
            $pc_tgl = explode("-",$row->tanggal_input);
            $kpda = $this->model_sitas->listDataBy("a.tanggal_spt,b.nama","anggota_spt a inner join peserta_spt b on a.id_pegawai=b.id_pegawai",
                      "a.id_spt=$row->id_spt","a.id_anggota asc");
            $lap_id_spt = $this->model_sitas->rowDataBy("*","lap_spt","id_spt = $row->id_spt")->row();
            if($lap_id_spt){
                $lpi = $lap_id_spt->id_spt;
            } else {
                $lpi = 0;
            }
     ?>
      <tr>
        <td><?php echo $no ?></td>
        <!--<td><?php echo $row->menimbang ?></td>-->
        <td>B-<?= $row->no_surat_keluar ?>/TU.040/H.4.2/<?= $pc_tgl[1] ?>/<?= $pc_tgl[0] ?></td>
        <td>
                <?php
                $nok = 1;
                foreach($kpda as $kpd){
                    $tgl_plk = $kpd->tanggal_spt;
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
        <td>
          <?php 
            echo $row->untuk;
            if($lpi != 0){
              if($lap_id_spt->keterangan != ""){
              ?>
              <br><br><b>Keterangan :</b><?= $lap_id_spt->keterangan ?>
              <?php
              }
            }
          ?>
        </td>
        <td><?php echo $val_tgl ?></td>
        <td>
            <?php
                if($row->id_spt==$lpi){
                    if($lap_id_spt->verif_kabalai==0){
                    ?>
                    <a class='btn btn-info btn-xs' title='Kirim' href="<?= base_url() ?>primer/kirim_ajuan_lap_spt/<?= $row->id_spt ?>"><i class='fa fa-share'></i> Kirim</a>
                    <a class='btn btn-success btn-xs' title='Edit' href="<?php echo base_url() ?>primer/lap_spt?edit=<?= $row->id_spt ?>"><i class='fas fa-edit'></i> Edit</a>
                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class='btn btn-danger btn-xs' title='Delete' href="<?php echo base_url() ?>primer/delete_lap_spt/<?= $row->id_spt ?>"><i class='fas fa-trash'></i> Hapus</a>
                    <button class='btn btn-warning btn-xs' data-target="#myLs" data-toggle="modal" data-id="<?= $row->id_spt ?>"><i class='fas fa-file'></i> Lihat</button>
                    <?php
                    } else {
                    ?>
                    <a class='btn btn-primary btn-xs' title='Copy' href="<?php echo base_url() ?>sijuara/copy_lap_spt/<?= $row->id_spt ?>"><i class='fas fa-copy'></i> Copy</a>
                    <a class='btn btn-danger btn-xs' title='PDF' target="_blank" href="<?php echo base_url() ?>preview/pdf_lap_spt/<?php echo md5($row->id_spt) ?>/<?= $row->id_spt ?>"><i class='fas fa-file-pdf'></i> PDF</a>
                    <a class='btn btn-info btn-xs' title='PDF' target="_blank" href="<?php echo base_url() ?>preview/html_lap_spt/<?php echo md5($row->id_spt) ?>/<?= $row->id_spt ?>"><i class='fas fa-file-pdf'></i> PDF View</a>
                    <button class='btn btn-warning btn-xs' data-target="#myLs" data-toggle="modal" data-id="<?= $row->id_spt ?>"><i class='fas fa-file'></i> Lihat</button>
                    <?php
                    }
                    
                } else {
            ?>
            <a class='btn btn-success btn-xs' title='Laporan' href="<?php echo base_url() ?>primer/lap_spt/<?php echo $row->id_spt ?>/<?= get_kode_uniks($row->id_spt) ?>"><i class='fas fa-edit'></i> Buat Laporan</a>
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

<div class="modal fade" id="myLs" role="dialog">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Laporan Perjalanan Dinas</h4>
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
        $('#myLs').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            $.ajax({
               type : 'post',
               url : '<?= base_url() ?>primer/lihat_perjadin',
               data : 'id_spt='+ rowid,
               success : function(data){
                   $('.fetch_data').html(data);
               }
            });
        });
    });
</script>