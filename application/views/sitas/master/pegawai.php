<div class="container-fluid">
    <div class="row">
      
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Pegawai</h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <form method="post" action="<?= site_url() ?>sekunder/save_pegawai" enctype="multipart/form-data">
            <!--<form method="post" action="#">-->
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" name="nama" value="<?= $nama ?>">
            </div>
            <div class="form-group">
              <label>NIP</label>
              <input type="text" class="form-control" name="nip" value="<?= $nip ?>">
            </div>
            <div class="form-group">
              <label>Jabatan</label>
              <input type="text" class="form-control" name="jabatan" value="<?= $jabatan ?>">
            </div>
            <div class="form-group">
              <label>Pangkat</label>
              <input type="text" class="form-control" name="pangkat" value="<?= $pangkat ?>">
            </div>
            <div class="form-group">
              <label>Gol</label>
              <input type="text" class="form-control" name="gol" value="<?= $gol ?>">
            </div>
            <div class="form-group">
              <label>No HP</label>
              <input type="text" class="form-control" name="no_hp" value="<?= $no_hp ?>">
            </div>
            <input type="hidden" name="status" value="<?= $status ?>">
            <input type="hidden" name="id_pegawai" value="<?= $id_pegawai ?>">
          </div>
            <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Save</button>
            </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
    
    <div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar Pegawai</h3>
  </div>
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:2%">No</th>
        <th style="width:15%">Nama</th>
        <th style="width:15%">NIP</th>
        <th style="width:15%">Jabatan</th>
        <th style="width:15%">Pangkat</th>
        <th style="width:15%">Gol</th>
        <th style="width:10%">No HP</th>
        <th style="width:13%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        if($rec){
        foreach ($rec as $row){
     ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?= $row->nama ?></td>
        <td><?= $row->nip ?></td>
        <td><?= $row->jabatan ?></td>
        <td><?= $row->pangkat ?></td>
        <td><?= $row->gol ?></td>
        <td><?= $row->no_hp ?></td>
        <td>
        <a class='btn btn-success btn-xs' title='Edit' href="<?php echo base_url() ?>sekunder/master_pegawai/<?php echo $row->id_pegawai ?>/<?php echo get_kode_uniks($row->id_pegawai) ?>"><i class='fas fa-edit'></i> Edit</a>
        <a class='btn btn-danger btn-xs' title='Delete Data' href="<?php echo base_url() ?>sekunder/hapus_pegawai/<?php echo $row->id_pegawai ?>/<?php echo get_kode_uniks($row->id_pegawai) ?>" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')"><i class='fa fa-trash'></i> Hapus</a>
        <button class="btn btn-primary btn-xs" data-target="#modalUser" data-toggle="modal" data-id="<?= $row->id_pegawai ?>"><i class="fas fa-user"></i> User</button>
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
</div>
  <!-- /.container-fluid -->
<div class="modal fade" id="modalUser" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Detail User</h4>
          </div>
          <div class="modal-body">
            <div class="fetch_data"></div>
          </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#modalUser').on('show.bs.modal', function (e){
            var rowId = $(e.relatedTarget).data('id');
            $.ajax({
              type : 'post',
              url : '<?= base_url() ?>sekunder/lihat_user',
              data : 'id_pegawai='+ rowId,
              success : function(data){
                $('.fetch_data').html(data);
              }
            });
        });
    });
</script>