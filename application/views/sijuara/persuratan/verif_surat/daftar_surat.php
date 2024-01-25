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
        
        foreach ($rec->result() as $row){
            $no_surat = $this->model_more->get_surat_buat($row->id_buat_surat);
            if($no_surat){
                $no_sr = $no_surat->no_surat_keluar;
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
            <a class='btn btn-warning btn-xs' title='Lihat' href="<?php echo base_url() ?>sijuara/verif_surat_detail/<?php echo $row->id_buat_surat ?>"><i class='fas fa-file'></i> Lihat</a>
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