<div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
      <?= $alert ?>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Data <b><?= $nama ?></b></h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <form method="post" action="<?= site_url('sekunder/update_profil') ?>" enctype="multipart/form-data">
            <!--<form method="post" action="#">-->
            <div class="form-group">
              <label>NIP :</label>
              <input type="text" class="form-control" name="nip" value="<?= $nip ?>">
            </div>
            <div class="form-group">
              <label>Jabatan :</label>
              <input type="text" class="form-control" name="jabatan" value="<?= $jabatan ?>">
            </div>
            <div class="form-group">
              <label>Pangkat :</label>
              <input type="text" class="form-control" name="pangkat" value="<?= $pangkat ?>">
            </div>
            <div class="form-group">
              <label>Gol :</label>
              <input type="text" class="form-control" name="gol" value="<?= $gol ?>">
            </div>
            <div class="form-group">
              <label>No HP (WhatsApp) :</label>
              <input type="text" class="form-control" name="no_hp" value="<?= $no_hp ?>">
            </div>
            <input type="hidden" name="id_pegawai" value="<?= $id_pegawai ?>">
          </div>
            <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary">Update Profil</button>
            </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
</div>
  <!-- /.container-fluid -->