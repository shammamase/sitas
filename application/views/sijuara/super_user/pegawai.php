<div class="card card-success">
  <div class="card-header">
    <a href="#" data-toggle="modal" data-target="#add" class="btn btn-warning">Tambah Pegawai</a>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" style="width:100%" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style='width:2%'>No</th>
        <th style='width:30%'>Nama</th>
        <th style='width:18%'>NIP</th>
        <th style='width:5%'>JK</th>
        <th style='width:15%'>Tempat/Tgl Lahir</th>
        <th style='width:30%'>Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
        $no = 1;
        foreach ($peg->result() as $row){
     ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $row->nama ?></td>
        <td><?php echo $row->nip ?></td>
        <td><?php echo $row->jenis_kelamin ?></td>
        <td><?php echo $row->tempat_lahir."/".tgl_indo($row->tanggal_lahir) ?></td>
        <td>
            <button class='btn btn-primary btn-xs' data-target="#editx" data-toggle="modal" data-id="<?= $row->id_bio ?>"><i class='fa fa-edit'></i> Edit</button>
            <a class='btn btn-danger btn-xs'  title='Hapus' onclick="alert('Apakah anda ingin menghapus data <?= $row->nama ?> ?')" href="<?php echo base_url() ?>sijuara/hapus_pegawai/<?php echo $row->id_bio ?>"><i class='fa fa-trash'></i> Hapus</a>
            <button class='btn btn-success btn-xs' data-target="#buat_userx" data-toggle="modal" data-id="<?= $row->id_bio ?>"><i class='fa fa-user'></i> Buat User</button>
            <button class='btn btn-warning btn-xs' data-target="#levelx" data-toggle="modal" data-id="<?= $row->id_bio ?>"><i class='fa fa-server'></i> Level</button>
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

<div class="modal fade" id="add" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= site_url('sijuara/save_pegawai') ?>" class="was-validated" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                        <div class="valid-feedback">Valid</div>
                        <div class="invalid-feedback">Harap di isi !!</div>
                    </div>
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" required>
                        <div class="valid-feedback">Valid</div>
                        <div class="invalid-feedback">Harap di isi !!</div>
                    </div>
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="number" class="form-control" id="nik" name="nik" required>
                        <div class="valid-feedback">Valid</div>
                        <div class="invalid-feedback">Harap di isi !!</div>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                        <div class="valid-feedback">Valid</div>
                        <div class="invalid-feedback">Harap di pilih !!</div>
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="thn-bln-tgl. Contoh:(1980-08-17)">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp">
                        <div class="valid-feedback">Valid</div>
                        <div class="invalid-feedback">Harap di isi !!</div>
                    </div>
                    <div class="form-group">
                        <label>Upload Tanda Tangan Scan</label>
                        <input type="file" class="form-control" name="gbr">
                    </div>
                    <input type="hidden" value="save" name="status">
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editx" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="fetch_data"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="buat_userx" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Buat User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="fetch_data_user"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="levelx" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Atur Level</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="fetch_data_level"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#editx').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            $.ajax({
               type : 'post',
               url : '<?= base_url() ?>sijuara/edit_pegawai',
               data : 'id_bio='+ rowid,
               success : function(data){
                   $('.fetch_data').html(data);
               }
            });
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('#buat_userx').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            $.ajax({
               type : 'post',
               url : '<?= base_url() ?>sijuara/buat_user',
               data : 'id_bio='+ rowid,
               success : function(data){
                   $('.fetch_data_user').html(data);
               }
            });
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('#levelx').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            $.ajax({
               type : 'post',
               url : '<?= base_url() ?>sijuara/buat_level',
               data : 'id_bio='+ rowid,
               success : function(data){
                   $('.fetch_data_level').html(data);
               }
            });
        });
    });
</script>