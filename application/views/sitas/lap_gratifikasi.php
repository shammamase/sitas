<div class="container-fluid">
    <div class="row">
      
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Buat Laporan Gratifikasi</h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <form method="post" action="<?= base_url() ?>primer/save_lap_gratifikasi">
            <div class="form-group">
              <label>Berdasarkan Surat Tugas :</label>
              <select class="form-control select2" name="id_surat_keluar" style="width: 100%;" required>
                    <option value="">Pilih Surat Tugas</option>
              </select>
            </div>
            <div class="form-group">
              <label>Jenis Gratifikasi :</label>
              <select class="form-control select2" name="jenis_gratifikasi" style="width: 100%;" required>
                    <option value="<?= $jenis_gratifikasi ?>"><?= $jenis_gratifikasi_val ?></option>
                    <option value="Makanan">Makanan</option>
                    <option value="Uang">Uang</option>
                    <option value="Honor Narasumber">Honor Narasumber</option>
                    <option value="Honor Narasumber, Transport, dan Akomodasi">Honor Narasumber, Transport, dan Akomodasi</option>
                  </select>
            </div>
            <div class="form-group">
              <label>Nilai :</label>
              <input type="text" class="form-control" name="nilai" value="<?= $nilai ?>">
            </div>
            <div class="form-group">
              <label>Tanggal Penerimaan Pemberian :</label>
              <input type="date" name="tgl_terima" value="<?= $tgl_terima ?>" class="form-control" required/>
            </div>
            <div class="form-group">
              <label>Lokasi Pemberian :</label>
              <input type="text" class="form-control" name="lokasi_terima" value="<?= $lokasi_terima ?>" required>
            </div>
            <div class="form-group">
              <label>Identitas Pemberi Gratifikasi :</label>
              <textarea name="pemberi" class="form-control"><?= $pemberi ?></textarea>
            </div>
            <div class="form-group">
              <label>Hubungan dengan Pemberi :</label>
              <input type="text" class="form-control" name="hub_pemberi" value="<?= $hub_pemberi ?>" required>
            </div>
            <input type="hidden" name="status" value="<?= $status ?>">
          </div>
            <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
    
<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Daftar Laporan Gratifikasi</h3>
  </div>
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th style="width:2%">No</th>
        <th style="width:13%">Jenis Gratifikasi</th>
        <th style="width:15%">Nilai</th>
        <th style="width:10%">Tanggal Penerimaan</th>
        <th style="width:10%">Lokasi Penerimaan</th>
        <th style="width:25%">Pemberi Gratifikasi</th>
        <th style="width:10%">Hubungan dengan Pemberi</th>
        <th style="width:15%">Aksi</th>
      </tr>
      </thead>
      <tbody>
      
      </tbody>
    </table>
    </div>
  </div>
</div>