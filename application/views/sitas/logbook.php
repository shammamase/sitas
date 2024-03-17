<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Logbook <?= $bio->nama ?></h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:80%">Periode</th>
        <th style="width:20%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
      foreach($bulan as $x => $x_val) { 
      ?>
      <tr>
        <td><?php echo $x." ".$thn ?></td>
        <td>
            <a class='btn btn-danger btn-xs' title='Detail' target="_blank" href="<?php echo base_url() ?>sekunder/logbook_detail/<?= $thn."-".$x_val ?>/<?= $user ?>"><i class='fas fa-file'></i> Detail</a>
        </td>
      </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card --> 