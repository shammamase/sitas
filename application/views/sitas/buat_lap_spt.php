<div class="container-fluid">
    <div class="row">
      
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Buat Laporan Perjalanan Dinas</h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <form method="post" action="<?= base_url() ?>primer/save_lap_spt" enctype="multipart/form-data">
            <div class="form-group">
              <label>No SPT</label>
              <input type="text" class="form-control" name="no_surat" value="B-<?= $spt->no_surat_keluar ?>/TU.040/H.4.2/<?= $bln ?>/<?= $thn ?>" readonly>
            </div>
            <div class="form-group">
              <label>Transportasi</label>
              <input type="text" class="form-control" name="transportasi" value="<?= $transportasi ?>">
            </div>
            <div class="form-group">
              <label>Lokasi</label>
              <input type="text" class="form-control" name="lokasi" value="<?= $lokasi ?>">
            </div>
            <div class="form-group">
              <label>Uraian:</label>
              <textarea name="uraian" id="summernote"><?= $uraian ?></textarea>
            </div>
            <div class="form-group">
              <label>Upload Eviden (Foto atau open camera, bukan PDF) : </label>
              <input type="file" class="form-control" name="foto[]" multiple <?= $harus ?>>
            </div>
            <input type="hidden" name="status" value="<?= $status ?>">
            <input type="hidden" name="id_lap_spt" value="<?= $id_lap_spt ?>">
            <input type="hidden" name="id_spt" value="<?= $spt->id_spt ?>">
            <input type="hidden" name="file_pdf" value="<?= $nama_file ?>">
          </div>
          <div style="margin-left:5px" class="row">
          <?php 
            if(!empty($nama_file)){
                $pc_nf = explode(",",$nama_file);
                foreach($pc_nf as $value){
          ?>
          <div style="margin-bottom:10px" class="col-6 col-lg-2 col-md-2"><img style="width:150px;height:auto" class="img-responsive" src="<?= base_url() ?>asset/lap_spt/<?= $value ?>"></div>
          <?php
                }
            }
          ?>
          </div>
            <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
</div>
  <!-- /.container-fluid -->