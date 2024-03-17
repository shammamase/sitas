<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar Pengajuan Cuti</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:3%">No</th>
        <th style="width:20%">Nama</th>
        <th style="width:15%">Jenis Cuti</th>
        <th style="width:25%">Alasan</th>
        <th style="width:22%">Tanggal</th>
        <th style="width:15%">Aksi</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        foreach ($rec as $row){
     ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $row->nama ?></td>
        <td><?php echo $row->jenis_cuti ?></td>
        <td><?php echo $row->alasan_cuti ?></td>
        <td>
            <?php 
            echo tgl_indoo($row->tgl_mulai);
            if($row->lama_cuti > 1){
                echo " s/d ".tgl_indoo($row->tgl_akhir);
            }
            ?> 
            (<b><?= $row->lama_cuti ?> Hari</b>)</td>
        <td>
            <a class='btn btn-warning btn-xs' title='Lihat' href="<?php echo base_url() ?>sekunder/verif_cuti/<?php echo $row->id_cuti ?>/<?= get_kode_uniks($row->id_cuti) ?>"><i class='fas fa-file'></i> Verifikasi</a>
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