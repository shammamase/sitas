<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar HPS</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style='width:20px'>No</th>
        <th>Nama Barang</th>
        <th>Satuan</th>
        <th>HPS</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        foreach ($record->result() as $row){
     ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $row->barang ?></td>
        <td><?php echo $row->vol ?></td>
        <td><?php echo number_format($row->hps,0,"",".") ?></td>
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