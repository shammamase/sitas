<div class="container-fluid">
    <div class="row">
      
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Buat Laporan Gratifikasi</h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <form method="post" action="<?= base_url() ?>sekunder/save_lap_gratifikasi">
            <div class="form-group">
              <label>Berdasarkan Surat Tugas :</label>
              <select class="form-control select2" id="id_surat_keluar" name="id_surat_keluar" style="width: 100%;">
                    <?php foreach($list_surat as $lsx){ ?>
                      <option value="<?= $lsx->id_surat_keluar ?>"><?= $lsx->perihal ?></option>
                    <?php } ?>
                    <option value="">Pilih Surat Tugas</option>
              </select>
            </div>
            <div class="form-group">
              <label>Jenis Gratifikasi :</label>
              <select class="form-control select2" id="jenis_gratifikasi" name="jenis_gratifikasi" style="width: 100%;" required>
                    <option value="Uang">Uang</option>
                    <option value="Makanan">Makanan</option>
                    <option value="Honor Narasumber">Honor Narasumber</option>
                    <option value="Honor Narasumber, Transport, dan Akomodasi">Honor Narasumber, Transport, dan Akomodasi</option>
                  </select>
            </div>
            <div class="form-group">
              <label>Nilai :</label>
              <input type="text" class="form-control" id="nilai" name="nilai" required>
            </div>
            <div class="form-group">
              <label>Tanggal Penerimaan Pemberian :</label>
              <input type="date" id="tgl_terima" name="tgl_terima" class="form-control" required/>
            </div>
            <div class="form-group">
              <label>Lokasi Pemberian :</label>
              <input type="text" class="form-control" id="lokasi_terima" name="lokasi_terima" required>
            </div>
            <div class="form-group">
              <label>Identitas Pemberi Gratifikasi :</label>
              <textarea id="pemberi" name="pemberi" class="form-control" required></textarea>
            </div>
            <div class="form-group">
              <label>Hubungan dengan Pemberi :</label>
              <input type="text" class="form-control" id="hub_pemberi" name="hub_pemberi" required>
            </div>
            <input type="hidden" id="status" name="status" value="<?= $status ?>">
            <input type="hidden" name="id_pegawai" value="<?= $id_pegawai ?>">
            <input type="hidden" id="id_lap_gratifikasi" name="id_lap_gratifikasi" value="<?= $id_lap_gratifikasi ?>">
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
      <?php 
      $no=1; 
      foreach($list_data as $ld){ 
      ?>
      <tr>
        <td><?= $no ?></td>
        <td><?= $ld->jenis_gratifikasi ?></td>
        <td>Rp. <?= number_format($ld->nilai,0,",",".") ?></td>
        <td><?= tgl_indo($ld->tgl_terima) ?></td>
        <td><?= $ld->lokasi_terima ?></td>
        <td><?= $ld->pemberi ?></td>
        <td><?= $ld->hub_pemberi ?></td>
        <td>
          <button class="btn btn-primary btn-xs detail_button" data-id="<?= $ld->id_lap_gratifikasi ?>"><i class="fa fa-edit"></i> Edit</button>
          <a title="Hapus Data" href="<?= base_url('sekunder/hapus_gratifikasi/'.$ld->id_lap_gratifikasi) ?>" 
          class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda ingin menghapus data ini ?')">
          <i class="fa fa-trash"></i> Hapus
          </a>
        </td>
      </tr>
      <?php 
      $no++; 
      } ?>
      </tbody>
    </table>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#nilai').on('input', function(){
      var input = $(this).val().replace(/[^0-9]/g, '');
      if(!isNaN(input) && input !== ''){
        var formattedInput = Number(input).toLocaleString('id-ID');
        $(this).val(formattedInput);
      } 
    });

    $('#example1').on('click', '.detail_button', function() {
      var idLap = $(this).data('id');
      $.ajax({
        url: '<?= base_url() ?>sekunder/get_row_lap_gratifikai',
        type: 'POST',
        data: { id: idLap },
        success: function(response) {
          var data = JSON.parse(response);
          $('#nilai').val(Number(data.nilai).toLocaleString('id-ID'));
          $('#tgl_terima').val(data.tgl_terima);
          $('#id_surat_keluar').val(data.id_surat_keluar).trigger('change');
          $('#lokasi_terima').val(data.lokasi_terima);
          $('#pemberi').val(data.pemberi);
          $('#hub_pemberi').val(data.hub_pemberi);
          $('#jenis_gratifikasi').val(data.jenis_gratifikasi).trigger('change');
          $('#id_lap_gratifikasi').val(data.id_lap_gratifikasi);
          $('#status').val('edit');
        }
      });
    });
  });
</script>