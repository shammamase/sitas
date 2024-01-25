<div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
      <a href="<?= base_url() ?>utama/master_rkakl" class="btn btn-primary">Kembali</a>
        <br><br>
      <!--  
      <a href="<?= base_url() ?>utama/master_rkakl" class="btn btn-primary">Tahun Anggaran</a>
        <br><br>
      -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Program</h3>
          </div>
          <div class="card-body">
            
            <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
              <label>KD Program :</label>
              <input type="text" class="form-control" name="kd_program" value="<?= $kd_program ?>" required>
            </div>
            <div class="form-group">
              <label>Program :</label>
              <input type="text" class="form-control" name="program" value="<?= $program ?>" required>
            </div>
            <div class="form-group">
              <label>Jumlah Biaya :</label>
              <input type="text" class="form-control" name="jumlah_biaya" value="<?= $jumlah_biaya ?>" required>
            </div>
            <div class="form-group">
              <label>Tahun Anggaran</label>
              <select name="ta" class="form-control">
                <option value="">-- Pilih TA --</option>
                    <?php 
                    foreach($ta as $tax){
                    ?>
                    <option value="<?= $tax->id_alokasi ?>"><?= $tax->ta ?></option>
                    <?php
                    }
                    ?>
              </select>
            </div>
            <input type="hidden" name="aksi" value="<?= $aksi ?>">
            <input type="hidden" name="idx" value="<?= $idx ?>">
            <input type="hidden" name="id_alokasi" value="<?= $id_alokasi ?>">
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
      <h3 class="card-title">Daftar Program</h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="width:2%">No</th>
          <th style="width:10%">KD Program</th>
          <th style="width:38%">Program</th>
          <th style="width:10%">Jumlah Biaya</th>
          <th style="width:40%">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $qwx = $this->db->query("select * from sijuara_program where id_alokasi = $id_alokasi")->result();
        foreach($qwx as $qw){
        ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $qw->kd_program ?></td>
            <td><?= $qw->program ?></td>
            <td><?= number_format($qw->jumlah_biaya) ?></td>
            <td>
              <a href="<?= base_url() ?>utama/program/<?= $qw->id_alokasi ?>/edit/<?= $qw->id_program ?>" class="btn btn-primary">
                Edit
              </a>
              <a href="<?= base_url() ?>utama/program/<?= $qw->id_alokasi ?>/copy/<?= $qw->id_program ?>" class="btn btn-success">
                Copy
              </a>
              <a href="<?= base_url() ?>utama/aktivitas/<?= $qw->id_program ?>" class="btn btn-dark">
                Aktivitas
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