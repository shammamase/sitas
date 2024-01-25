<div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
      <a href="<?= base_url() ?>utama/subkomp/<?= $back ?>" class="btn btn-primary">Kembali</a>
        <br><br>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Detil <?= $subkomp ?></h3>
          </div>
          <div class="card-body">
            
            <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
              <label>Detil</label>
              <select name="kd_detil" class="form-control select2" required>
                <option value="<?= $kd_detilx ?>-<?= $nama_detil ?>"><?= $kd_detilx ?> - <?= $nama_detil ?></option>
                    <?php 
                    foreach($list_dtl as $ld){
                    ?>
                    <option value="<?= $ld->kd_detil ?>-<?= $ld->detil ?>"><?= $ld->kd_detil ?> - <?= $ld->detil ?></option>
                    <?php
                    }
                    ?>
              </select>
            </div>
            <div class="form-group">
              <label>Jumlah Biaya :</label>
              <input type="text" class="form-control" name="jumlah_biaya" value="<?= $jumlah_biaya ?>" required>
            </div>
            <input type="hidden" name="aksi" value="<?= $aksi ?>">
            <input type="hidden" name="idx" value="<?= $idx ?>">
            <input type="hidden" name="id_subkomp" value="<?= $id_subkomp ?>">
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
      <h3 class="card-title">Daftar Detil</h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="width:2%">No</th>
          <th style="width:25%">Kode Detil</th>
          <th style="width:33%">Detil</th>
          <th style="width:15%">Jumlah Biaya</th>
          <th style="width:25%">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $qwx = $this->db->query("select * from sijuara_detil where id_subkomp = $id_subkomp")->result();
        foreach($qwx as $qw){
        ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $qw->kd_detil ?></td>
            <td><?= $qw->detil ?></td>
            <td><?= number_format($qw->jumlah_biaya) ?></td>
            <td>
              <a href="<?= base_url() ?>utama/detil/<?= $qw->id_subkomp ?>/edit/<?= $qw->id_detil ?>" class="btn btn-primary">
                Edit
              </a>
              <a href="<?= base_url() ?>utama/detil/<?= $qw->id_subkomp ?>/copy/<?= $qw->id_detil ?>" class="btn btn-success">
                Copy
              </a>
              <a href="<?= base_url() ?>utama/subdetil/<?= $qw->id_detil ?>" class="btn btn-dark">
                Sub Detil
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