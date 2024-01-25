<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar Kegiatan</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style='width:20px'>No</th>
        <th>Nama Kegiatan</th>
        <th style='width:50px'>Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        foreach ($record->result() as $row){
     ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $row->subkomp ?></td>
        <td>
            <a class='btn btn-success btn-xs' target="_blank" title='Ajukan' href="<?php echo base_url() ?>sijuara/verif/<?php echo $row->id_subkomp ?>/<?php echo $this->uri->segment(3) ?>"><i class='fas fa-file-invoice'></i> Detail</a>
            <!--
            <a class='btn btn-success btn-xs' title='Konfirmasi' href="<?php echo base_url() ?>admin/konfirmasi_pemesanan/" onclick="return confirm('Apa anda yakin melakukan konfirmasi ?')"><i class='fa fa-check'></i></a>
            
            <a class='btn btn-primary btn-xs' title='Edit Data' href="<?php echo base_url() ?>admin/edit_pemesanan/"><i class='fa fa-edit'></i></a>
            <a class='btn btn-danger btn-xs' title='Delete Data' href="<?php echo base_url() ?>admin/delete_pemesanan/" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')"><i class='fa fa-trash'></i></a>
            -->        
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