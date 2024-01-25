<div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
      <!--  
      <a href="<?= base_url() ?>utama/master_rkakl" class="btn btn-primary">Tahun Anggaran</a>
        <br><br>
      -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Filter</h3>
          </div>
          <div class="card-body">
            
            <form method="GET" action="" enctype="multipart/form-data">
            <div class="form-group">
              <label>Detil</label>
              <select name="kd_detil" class="form-control select2" required>
                <option value="">-- Pilih Detil --</option>
                    <?php 
                    foreach($list_dtl as $ld){
                    ?>
                    <option value="<?= $ld->kd_detil ?>"><?= $ld->kd_detil ?> - <?= $ld->detil ?></option>
                    <?php
                    }
                    ?>
              </select>
            </div>
            <div class="form-group">
              <label>Kegiatan</label>
              <select name="id_subkomp" class="form-control select2" required>
                <option value="">-- Pilih Kegiatan --</option>
                    <?php 
                    foreach($subkomp as $skm){
                    ?>
                    <option value="<?= $skm->id_subkomp ?>"><?= $skm->ta ?> - <?= $skm->subkomp ?></option>
                    <?php
                    }
                    ?>
              </select>
            </div>
          </div>
            <div class="card-footer">
                <button type="submit" name="cari" class="btn btn-primary">Proses</button>
            </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
    
    
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Detil/Subdetil <?= $keg ?></h3>
    </div>
    <div class="card-body">
    <form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label>KD Detil :</label>
        <input type="text" class="form-control" name="id_detil" value="<?= $kd_detil ?>-<?= $detil ?>">
    </div>
    <div class="form-group">
        <label>Jumlah Biaya Detil :</label>
        <input type="text" class="form-control" name="jumlah_biaya" required>
    </div>
    <div class="form-group">
        <label>Copy pada kegiatan</label>
        <select name="id_subkomp" class="form-control select2" required>
        <option value="">-- Pilih Kegiatan --</option>
            <?php 
            foreach($subkomp2 as $skm2){
            ?>
            <option value="<?= $skm2->id_subkomp ?>"><?= $skm2->id_subkomp ?> - <?= $skm2->subkomp ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="width:2%">No</th>
          <th style="width:60%">Subdetil</th>
          <th style="width:7%">Vol</th>
          <th style="width:13%">Satuan</th>
          <th style="width:13%">Harga Satuan</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $jml = 20;
        $no = 1;
        if($sdtl != NULL){
            foreach($sdtl as $qw){
            ?>
            <tr>
                <td><?= $no ?></td>
                <td>
                    <textarea name="subdetil[]" class="form-control"><?= $qw->subdetil ?></textarea>
                </td>
                <td><input type="text" class="form-control" name="vol[]" value="<?= $qw->vol ?>"></td>
                <td><input type="text" class="form-control" name="satuan[]" value="<?= $qw->satuan ?>"></td>
                <td><input type="text" class="form-control" name="harga_satuan[]" value="<?= $qw->harga_satuan ?>"></td>
            </tr>
            <?php
            $no++;
            }
        }
        for($ii = $no; $ii <= $jml; $ii++){
        ?>
        <input type="hidden" name="id_subdetil[]">
        <tr>
            <td><?= $ii ?></td>
            <td>
                <textarea name="subdetil[]" class="form-control"></textarea>
            </td>
            <td><input type="text" class="form-control" name="vol[]"></td>
            <td><input type="text" class="form-control" name="satuan[]"></td>
            <td><input type="text" class="form-control" name="harga_satuan[]"></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
      </table>
      <button type="submit" name="submit" class="btn btn-primary btn-block">Simpan</button>
    </form>
    </div>
  </div>
</div>
  <!-- /.container-fluid -->