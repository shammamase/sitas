<div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
      <!--  
      <a href="<?= base_url() ?>utama/master_rkakl" class="btn btn-primary">Tahun Anggaran</a>
        <br><br>
      -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Alokasi TA</h3>
          </div>
          <div class="card-body">
            
            <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
              <label>Alokasi :</label>
              <input type="text" class="form-control" name="alokasi" value="<?= $alokasi ?>" required>
            </div>
            <div class="form-group">
              <label>TA :</label>
              <input type="text" class="form-control" name="ta" value="<?= $ta ?>" required>
            </div>
            <input type="hidden" name="aksi" value="<?= $aksi ?>">
            <input type="hidden" name="idx" value="<?= $idx ?>">
          <!--
            <div class="form-group">
              <label>Tanggal Surat</label>
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="text" name="tanggal" class="form-control datetimepicker-input" value="" data-target="#reservationdate" required/>
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <label>Perihal:</label>
              <textarea name="perihal" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label>Upload File PDF : </label>
              <input type="file" class="form-control" name="filex">
            </div>
            <input type="hidden" name="file_pdf" value="">
          -->
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
      <h3 class="card-title">Daftar TA</h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="width:2%">No</th>
          <th style="width:18%">Alokasi</th>
          <th style="width:10%">Tahun Anggaran</th>
          <th style="width:80%">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $qwx = $this->db->query("select * from sijuara_trs_alokasi")->result();
        foreach($qwx as $qw){
        ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= number_format($qw->alokasi) ?></td>
            <td><?= $qw->ta ?></td>
            <td>
              <a href="<?= base_url() ?>utama/master_rkakl/edit/<?= $qw->id_alokasi ?>" class="btn btn-primary">
                Edit
              </a>
              <a href="<?= base_url() ?>utama/master_rkakl/copy/<?= $qw->id_alokasi ?>" class="btn btn-success">
                Copy
              </a>
              <a href="<?= base_url() ?>utama/program/<?= $qw->id_alokasi ?>" class="btn btn-dark">
                Program
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