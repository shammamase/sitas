<div class="container-fluid">
    <div class="row">
      
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Buat Surat</h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <form method="post" action="<?= base_url() ?>sijuara/save_surat">
            <div class="form-group">
              <label>Tanggal</label>
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="text" name="tanggal" class="form-control datetimepicker-input" value="<?= $tanggal ?>" data-target="#reservationdate" required/>
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <label>No Arsip Surat:</label>
              <select class="form-control select2" name="arsip" style="width: 100%;" required>
                    <option value="<?= $arsip ?>"><?= $arsip_val ?></option>
                    <?php
                        foreach($ars->result() as $ar){
                        ?>
                        <option value="<?= $ar->id_sub_arsip ?>"><?= $ar->kode_sub_arsip ?> - <?= $ar->arsip ?> - <?= $ar->sub_arsip ?></option>
                        <?php
                        }
                    ?>
                  </select>
            </div>
            <div class="form-group">
              <label>Lampiran</label>
              <input type="text" class="form-control" name="lampiran" value="<?= $lampiran ?>">
            </div>
            <div class="form-group">
              <label>Perihal</label>
              <textarea name="hal" class="form-control"><?= $hal ?></textarea>
            </div>
            <div class="form-group">
              <label>Kepada</label>
              <input type="text" class="form-control" name="kepada" value="<?= $kepada ?>">
            </div>
            <div class="form-group">
              <label>di</label>
              <input type="text" class="form-control" name="lokasi_kepada" value="<?= $lokasi_kepada ?>">
            </div>
            <div class="form-group">
              <label>Isi Surat:</label>
              <textarea name="isi_surat" id="summernote"><?= $isi_surat ?></textarea>
            </div>
            <div class="form-group">
              <label>Tembusan (Pisahkan dengan koma jika tembusan lebih dari 1)</label>
              <input type="text" class="form-control" name="tembusan" value="<?= $tembusan ?>">
            </div>
            <input type="hidden" name="status" value="<?= $status ?>">
            <input type="hidden" name="id_buat_surat" value="<?= $id_buat_surat ?>">
          </div>
            <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary">Buat Surat</button>
            </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
</div>
  <!-- /.container-fluid -->