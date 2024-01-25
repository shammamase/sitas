<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar Surat Masuk</h3>
  </div>
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:2%">No</th>
        <th style="width:10%">No Surat</th>
        <th style="width:18%">Asal Surat</th>
        <th style="width:10%">Tanggal Masuknya Surat</th>
        <th style="width:10%">Tanggal Surat</th>
        <th style="width:20%">Perihal Surat</th>
        <th style="width:10%">Disposisi</th>
        <th style="width:20%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        if($rec){
        foreach ($rec->result() as $row){
     ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $row->no_surat_masuk ?></td>
        <td><?= $row->asal_surat ?></td>
        <td><?= tgl_indoo($row->tanggal_masuk) ?></td>
        <td><?= tgl_indoo($row->tanggal) ?></td>
        <td><?= $row->perihal ?></td>
        <td><?= $row->disposisi ?></td>
        <td>
            <a class='btn btn-warning btn-xs' title='Lihat' href="<?php echo base_url() ?>sijuara/disposisi_detail/<?php echo $row->id_surat_masuk ?>"><i class='fas fa-file'></i> Lihat</a>
        </td>
      </tr>
     <?php
      $no++;
        }
    }
      ?>
      </tbody>
    </table>
    </div>
  </div>