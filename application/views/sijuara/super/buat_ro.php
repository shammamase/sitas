<div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
      <a href="<?= base_url() ?>utama/kro/<?= $back ?>" class="btn btn-primary">Kembali</a>
        <br><br>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">RO</h3>
          </div>
          <div class="card-body">
            
            <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
              <label>KD RO :</label>
              <input type="text" class="form-control" name="kd_ro" value="<?= $kd_ro ?>" required>
            </div>
            <div class="form-group">
              <label>RO :</label>
              <input type="text" class="form-control" name="ro" value="<?= $ro ?>" required>
            </div>
            <div class="form-group">
              <label>Vol :</label>
              <input type="text" class="form-control" name="vol" value="<?= $vol ?>" required>
            </div>
            <div class="form-group">
              <label>Satuan :</label>
              <input type="text" class="form-control" name="satuan" value="<?= $satuan ?>" required>
            </div>
            <div class="form-group">
              <label>Jumlah Biaya :</label>
              <input type="text" class="form-control" name="jumlah_biaya" value="<?= $jumlah_biaya ?>" required>
            </div>
            <input type="hidden" name="aksi" value="<?= $aksi ?>">
            <input type="hidden" name="idx" value="<?= $idx ?>">
            <input type="hidden" name="id_kro" value="<?= $id_kro ?>">
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
      <h3 class="card-title">Daftar RO</h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="width:2%">No</th>
          <th style="width:10%">KD RO</th>
          <th style="width:28%">RO</th>
          <th style="width:10%">Vol</th>
          <th style="width:10%">Satuan</th>
          <th style="width:10%">Jumlah Biaya</th>
          <th style="width:30%">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $qwx = $this->db->query("select * from sijuara_ro where id_kro = $id_kro")->result();
        foreach($qwx as $qw){
        ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $qw->kd_ro ?></td>
            <td><?= $qw->ro ?></td>
            <td><?= $qw->vol ?></td>
            <td><?= $qw->satuan ?></td>
            <td><?= number_format($qw->jumlah_biaya) ?></td>
            <td>
              <a href="<?= base_url() ?>utama/ro/<?= $qw->id_kro ?>/edit/<?= $qw->id_ro ?>" class="btn btn-primary">
                Edit
              </a>
              <a href="<?= base_url() ?>utama/ro/<?= $qw->id_kro ?>/copy/<?= $qw->id_ro ?>" class="btn btn-success">
                Copy
              </a>
              <a href="<?= base_url() ?>utama/komponen/<?= $qw->id_ro ?>" class="btn btn-dark">
                Komponen
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