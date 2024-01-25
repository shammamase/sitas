<div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
      <a href="<?= base_url() ?>utama/program/<?= $back ?>" class="btn btn-primary">Kembali</a>
        <br><br>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Aktivitas</h3>
          </div>
          <div class="card-body">
            
            <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
              <label>KD Aktivitas :</label>
              <input type="text" class="form-control" name="kd_aktivitas" value="<?= $kd_aktivitas ?>" required>
            </div>
            <div class="form-group">
              <label>Aktivitas :</label>
              <input type="text" class="form-control" name="aktivitas" value="<?= $aktivitas ?>" required>
            </div>
            <input type="hidden" name="aksi" value="<?= $aksi ?>">
            <input type="hidden" name="idx" value="<?= $idx ?>">
            <input type="hidden" name="id_program" value="<?= $id_program ?>">
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
      <h3 class="card-title">Daftar Aktivitas</h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="width:2%">No</th>
          <th style="width:10%">KD Aktivitas</th>
          <th style="width:48%">Aktivitas</th>
          <th style="width:40%">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $qwx = $this->db->query("select * from sijuara_aktivitas where id_program = $id_program")->result();
        foreach($qwx as $qw){
        ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $qw->kd_aktivitas ?></td>
            <td><?= $qw->aktivitas ?></td>
            <td>
              <a href="<?= base_url() ?>utama/aktivitas/<?= $qw->id_program ?>/edit/<?= $qw->id_aktivitas ?>" class="btn btn-primary">
                Edit
              </a>
              <a href="<?= base_url() ?>utama/aktivitas/<?= $qw->id_program ?>/copy/<?= $qw->id_aktivitas ?>" class="btn btn-success">
                Copy
              </a>
              <a href="<?= base_url() ?>utama/kro/<?= $qw->id_aktivitas ?>" class="btn btn-dark">
                KRO
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