<div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
      <a href="<?= base_url() ?>utama/aktivitas/<?= $back ?>" class="btn btn-primary">Kembali</a>
        <br><br>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">KRO</h3>
          </div>
          <div class="card-body">
            
            <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
              <label>KD KRO :</label>
              <input type="text" class="form-control" name="kd_kro" value="<?= $kd_kro ?>" required>
            </div>
            <div class="form-group">
              <label>KRO :</label>
              <input type="text" class="form-control" name="kro" value="<?= $kro ?>" required>
            </div>
            <div class="form-group">
              <label>Vol :</label>
              <input type="text" class="form-control" name="vol" value="<?= $vol ?>" required>
            </div>
            <div class="form-group">
              <label>Satuan :</label>
              <input type="text" class="form-control" name="satuan" value="<?= $satuan ?>" required>
            </div>
            <input type="hidden" name="aksi" value="<?= $aksi ?>">
            <input type="hidden" name="idx" value="<?= $idx ?>">
            <input type="hidden" name="id_aktivitas" value="<?= $id_aktivitas ?>">
          </div>
            <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
    
    
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Daftar KRO</h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="width:2%">No</th>
          <th style="width:10%">KD KRO</th>
          <th style="width:38%">KRO</th>
          <th style="width:10%">Vol</th>
          <th style="width:10%">Satuan</th>
          <th style="width:30%">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $qwx = $this->db->query("select * from sijuara_kro where id_aktivitas = $id_aktivitas")->result();
        foreach($qwx as $qw){
        ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $qw->kd_kro ?></td>
            <td><?= $qw->kro ?></td>
            <td><?= $qw->vol ?></td>
            <td><?= $qw->satuan ?></td>
            <td>
              <a href="<?= base_url() ?>utama/kro/<?= $qw->id_aktivitas ?>/edit/<?= $qw->id_kro ?>" class="btn btn-primary">
                Edit
              </a>
              <a href="<?= base_url() ?>utama/kro/<?= $qw->id_aktivitas ?>/copy/<?= $qw->id_kro ?>" class="btn btn-success">
                Copy
              </a>
              <a href="<?= base_url() ?>utama/ro/<?= $qw->id_kro ?>" class="btn btn-dark">
                RO
              </a>
            </td>
        </tr>
        <?php
        $no++;
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
  <!-- /.container-fluid -->