<div class="container-fluid">
    <div class="row">
      
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Petugas Terima Surat Keluar</h3>
          </div>
          <div class="card-body">
            <form method="post" action="<?= site_url() ?>sekunder/save_petugas_surat_keluar" enctype="multipart/form-data">
            <div class="form-group">
                <label>Pegawai</label>
                <select name="id_pegawai" style="width: 100%;" class="form-control select2">
                    <option value="<?= $row->id_pegawai ?>"><?= $row->nama ?></option>
                    <?php foreach($list as $ls){ ?>
                        <option value="<?= $ls->id_pegawai ?>"><?= $ls->nama ?></option>
                    <?php } ?>
                </select>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Simpan</button>
          </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
</div>
  <!-- /.container-fluid -->