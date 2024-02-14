<div class="row">
      
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Pejabat Verifikator</h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <form method="post" action="<?= base_url() ?>primer/save_pejabat">
            <div class="form-group">
              <label>Verifikator Awal:</label>
              <select class="form-control select2" name="id_pejabat1" style="width: 100%;">
                    <option value="<?= $awal->id_pegawai ?>"><?= $awal->nama ?></option>
                    <?php
                        foreach($pjb as $ar){
                        ?>
                        <option value="<?= $ar->id_pegawai ?>"><?= $ar->nama." - ".$ar->struktur ?></option>
                        <?php
                        }
                    ?>
                  </select>
            </div>
            <div class="form-group">
              <label>Verifikator Akhir:</label>
              <select class="form-control select2" name="id_pejabat2" style="width: 100%;">
                  <option value="<?= $akhir->id_pegawai ?>"><?= $akhir->nama ?></option>
                    <?php
                        foreach($pjb as $ar){
                        ?>
                        <option value="<?= $ar->id_pegawai ?>"><?= $ar->nama." - ".$ar->struktur ?></option>
                        <?php
                        }
                    ?>
                  </select>
            </div>
          </div>
            <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
    </div>