<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar Surat</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:2%">No</th>
        <th style="width:20%">Perihal</th>
        <th style="width:28%">Kepada</th>
        <th style="width:10%">Tanggal</th>
        <th style="width:20%">No Surat</th>
        <th style="width:20%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        $no_hp = $kabalai->no_hp;
        $no_wa = substr_replace("$no_hp","62",0,1);
        foreach ($rec->result() as $row){
            $links = base_url()."sijuara/verif_surat_detail/".$row->id_buat_surat;
            $pesan = "*Layanan SIMANTEP* Mohon untuk mengecek Surat, silahkan klik link $links";
            
            $no_surat = $this->model_more->get_surat_buat($row->id_buat_surat);
            if($no_surat){
                $no_sr = $no_surat->no_lengkap;
            } else {
                $no_sr = $row->keterangan;
            }
            
     ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $row->hal ?></td>
        <td><?php echo $row->kepada." di ".$row->lokasi_kepada ?></td>
        <td><?php echo tgl_indoo($row->tanggal) ?></td>
        <td><?php echo $no_sr ?></td>
        <td>
            <?php
            if($row->verif_kabalai==1){
            ?>
            <a class='btn btn-warning btn-xs' title='Copy Data' href="<?php echo base_url() ?>sijuara/buat_surat?cs=<?php echo $row->id_buat_surat ?>"><i class='fas fa-copy'></i> Copy</a>
            <button class='btn btn-primary btn-xs' data-target="#sur" data-toggle="modal" data-id="<?= $row->id_buat_surat ?>"><i class='fas fa-file'></i> Lihat</button>
            <a class='btn btn-danger btn-xs' title='PDF' target="_blank" href="<?php echo base_url() ?>sijuara/pdf_suratx/<?php echo md5($row->id_buat_surat) ?>/<?= $row->id_buat_surat ?>"><i class='fas fa-file-pdf'></i> PDF Scan</a>
            <a class='btn btn-danger btn-xs' title='PDF' target="_blank" href="<?php echo base_url() ?>sijuara/pdf_surat_manualx/<?php echo md5($row->id_buat_surat) ?>/<?= $row->id_buat_surat ?>"><i class='fas fa-file-pdf'></i> PDF Asli</a>
            <?php
            } else {
            ?>
            <a class='btn btn-success btn-xs' title='Edit' href="<?php echo base_url() ?>sijuara/buat_surat?id_bs=<?php echo $row->id_buat_surat ?>"><i class='fas fa-edit'></i> Edit</a>
            <a class='btn btn-danger btn-xs' title='Delete Data' href="<?php echo base_url() ?>sijuara/delete_surat/<?php echo $row->id_buat_surat ?>" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')"><i class='fa fa-trash'></i> Hapus</a>
            <button class='btn btn-primary btn-xs' data-target="#sur" data-toggle="modal" data-id="<?= $row->id_buat_surat ?>"><i class='fas fa-file'></i> Lihat</button>
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

<div class="modal fade" id="sur" role="dialog">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Surat</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="fetch_datas"></div>
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
        $('#sur').on('show.bs.modal', function (e) {
            var rowids = $(e.relatedTarget).data('id');
            $.ajax({
               type : 'post',
               url : '<?= base_url() ?>sijuara/lihat_surat',
               data : 'id_buat_surat='+ rowids,
               success : function(data){
                   $('.fetch_datas').html(data);
               }
            });
        });
    });
</script>