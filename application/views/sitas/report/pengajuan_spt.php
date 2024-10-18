<div class="container-fluid">
    <div class="row">
      
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Pilih Bulan Pengajuan SPT</h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <form method="post" action="<?= base_url() ?>report/print_pengajuan_spt">
            <div class="form-group">
                <label>Pilih Bulan</label>
                <select class="form-control select2" name="tanggal" style="width: 100%;" required>
                    <option value="">--Pilih Bulan--</option>
                    <?php
                        foreach($bln as $bn){
                        ?>
                        <option value="<?= $thn."-".$bn ?>"><?= tgl_indoo($thn."-".$bn) ?></option>
                        <?php
                        }
                    ?>
                  </select>
            </div>
          </div>
            <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary">Proses</button>
            </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
</div>