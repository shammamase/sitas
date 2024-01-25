<div class="row">
      
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Pejabat Penandatanganan</h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <form method="post" action="<?= base_url() ?>sijuara/save_pejabat">
            <div class="form-group">
              <label>Nama Pejabat:</label>
              <select class="form-control select2" name="id_pejabat" style="width: 100%;">
                    <?php
                    $id_pjb = $this->db->query("select b.id_pejabat,b.id_bio,b.jabatan from sijuara_pejabat_ttd a inner join sijuara_pejabat b on a.id_pejabat=b.id_pejabat where a.id_pjs = 1")->row();
                    $nama_pjb = $this->db->query("select nama from t_biodata where id_bio = '$id_pjb->id_bio'")->row();
                    ?>
                    <option value="<?= $id_pjb->id_pejabat ?>"><?= $nama_pjb->nama ?> - <?= $id_pjb->jabatan ?></option>
                    <?php
                        foreach($pjb as $ar){
                        ?>
                        <option value="<?= $ar->id_pejabat ?>"><?= $ar->nama ?> - <?= $ar->jabatan ?></option>
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