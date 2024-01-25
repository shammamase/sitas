<div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
      <a href="<?= base_url() ?>utama/ro/<?= $back ?>" class="btn btn-primary">Kembali</a>
        <br><br>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Komponen</h3>
          </div>
          <div class="card-body">
            
            <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
              <label>KD Komponen :</label>
              <input type="text" class="form-control" name="kd_komponen" value="<?= $kd_komponen ?>" required>
            </div>
            <div class="form-group">
              <label>Komponen :</label>
              <input type="text" class="form-control" name="komponen" value="<?= $komponen ?>" required>
            </div>
            <div class="form-group">
              <label>Jumlah Biaya :</label>
              <input type="text" class="form-control" name="jumlah_biaya" value="<?= $jumlah_biaya ?>" required>
            </div>
            <input type="hidden" name="aksi" value="<?= $aksi ?>">
            <input type="hidden" name="idx" value="<?= $idx ?>">
            <input type="hidden" name="id_ro" value="<?= $id_ro ?>">
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
      <h3 class="card-title">Daftar Komponen</h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="width:2%">No</th>
          <th style="width:10%">KD Komponen</th>
          <th style="width:28%">Komponen</th>
          <th style="width:10%">Jumlah Biaya</th>
          <th style="width:30%">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $qwx = $this->db->query("select * from sijuara_komponen where id_ro = $id_ro")->result();
        foreach($qwx as $qw){
        ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $qw->kd_komponen ?></td>
            <td><?= $qw->komponen ?></td>
            <td><?= number_format($qw->jumlah_biaya) ?></td>
            <td>
              <a href="<?= base_url() ?>utama/komponen/<?= $qw->id_ro ?>/edit/<?= $qw->id_komponen ?>" class="btn btn-primary">
                Edit
              </a>
              <a href="<?= base_url() ?>utama/komponen/<?= $qw->id_ro ?>/copy/<?= $qw->id_komponen ?>" class="btn btn-success">
                Copy
              </a>
              <a href="<?= base_url() ?>utama/subkomp/<?= $qw->id_komponen ?>" class="btn btn-dark">
                Sub Komponen
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