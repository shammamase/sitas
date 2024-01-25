<?php 
$lev = $this->model_more->get_user_level($this->session->username)->row();
if($lev->id_stakeholder==8){
?>
<div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-6 col-lg-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Buat Tanggal SPT</h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <form method="get" action="">
            <div class="form-group">
              <label>Tanggal:</label>
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="text" name="tanggal" class="form-control datetimepicker-input" value="<?= $tanggal ?>" data-target="#reservationdate" required/>
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <!-- Date and time -->
            <div class="form-group">
              <label>Lamanya:</label>
              <input type="number" name="lama_hari" class="form-control" value="<?= $lama_hari ?>" required/>
            </div>
          </div>
          <input type="hidden" name="id_spt" value="<?= $id_spt ?>" <?= $kunci_id_spt ?>>
            <div class="card-footer">
                <button type="submit" name="buat_tgl" class="btn btn-primary btn-block">Buat <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
      
      <div class="col-12 col-md-6 col-lg-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Buat SPT</h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <form method="post" action="<?= base_url() ?>sijuara/save_spt">
            <div class="form-group">
              <label>Menimbang :</label>
              <textarea class="form-control" name="menimbang"><?= $menimbang ?></textarea>
            </div>
            <div class="form-group">
              <label>Dasar:</label>
              <textarea name="dasar" id="summernote">
                <?= $dasar ?>
              </textarea>
            </div>
            <div class="form-group">
                  <label>Kepada:</label>
                  <select class="form-control select2" multiple="multiple" name="peg[]" data-placeholder="Pilih Pegawai" style="width: 100%;" required>
                    <?php
                    if($peg){
                        foreach($arr as $ar){
                        ?>
                        <option selected value="<?= $ar->id_peg ?>"><?= $ar->nama ?></option>
                        <?php
                        }
                        foreach($peg->result() as $pg){
                        ?>
                        <option value="<?= $pg->id_peg ?>"><?= $pg->nama ?></option>
                        <?php
                        }
                    }
                    
                    ?>
                  </select>
            </div>
            <div class="form-group">
                  <label>Untuk:</label>
                  <textarea class="form-control" name="untuk" required><?= $untuk ?></textarea>
            </div>
            <div class="form-group">
                 <div class="icheck-primary d-inline">
                        <input type="checkbox" name="is_dipa" value="1" <?= $ceck ?> id="checkboxPrimary1">
                        <label for="checkboxPrimary1">
                        </label>
                  </div>
                  <label>DIPA BPTP Gorontalo Tahun <?= date('Y') ?></label>
            </div>
            <div class="form-group">
              <label>Tanggal Input:</label>
                <div class="input-group date" id="reservationdates" data-target-input="nearest">
                    <input type="text" name="tanggal_input" class="form-control datetimepicker-input" value="<?= $tanggal_input ?>" data-target="#reservationdates" required/>
                    <div class="input-group-append" data-target="#reservationdates" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
          </div>
          <input type="hidden" name="verif" value="<?= $verif ?>">
          <input type="hidden" name="id_arsip" value="45">
          <input type="hidden" name="lama_hari" value="<?= $lama_hari ?>">
          <input type="hidden" name="tanggal" value="<?= $tanggal ?>">
          <input type="hidden" name="user" value="<?= $this->session->username ?>">
          <input type="hidden" name="tanggal_akhir" value="<?= $tgl_no ?>">
          <input type="hidden" name="status" value="<?= $status ?>">
          <input type="hidden" name="id_spts" value="<?= $id_spt ?>">
            <div class="card-footer">
                <button type="submit" name="buat_spt" class="btn btn-primary btn-block">Buat SPT</button>
            </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
<?php } else { echo "Anda Tidak Memiliki Hak Akses Membuat SPT"; }
?>