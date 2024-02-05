<div class="container-fluid">
    <div class="row">
      
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Buat Laporan Perjalanan Dinas</h3>
          </div>
          <div class="card-body">
            <!-- Date -->
            <form method="post" action="<?= base_url() ?>sijuara/save_lap_spt" enctype="multipart/form-data">
            <div class="form-group">
              <label>No SPT</label>
              <input type="text" class="form-control" name="no_surat" value="<?= $spt->no_lengkap ?>" readonly>
            </div>
            <div class="form-group">
                  <label>Tolak Ukur Kegiatan</label>
                  <select class="form-control select2" name="tolak_ukur_kegiatan" style="width: 100%;" required>
                      <option value="<?= $tolak_ukur_kegiatan ?>"><?= $tolak_ukur_kegiatan ?></option>
                    <?php
                        foreach($arr as $ar){
                        ?>
                        <option value="<?= $ar->subkomp ?>"><?= $ar->subkomp ?></option>
                        <?php
                        }
                    ?>
                    
                    <?php
                    /*
                        $thn = date('Y');
                        $id_pj = "";
                        foreach($arr as $ar){
                            if($ar->id_pj!=0){
                                $id_pj .= $ar->id_pj.",";
                            }
                        }
                        $id_pjj = substr($id_pj,0,-1);
                        if(!empty($id_pjj)){
                        $subs_komp = $this->db->query("select a.* 
                                from sijuara_subkomp a 
                                inner join sijuara_komponen b on a.id_komponen = b.id_komponen
                                inner join sijuara_ro c on b.id_ro = c.id_ro
                                inner join sijuara_kro d on c.id_kro = d.id_kro
                                inner join sijuara_aktivitas e on d.id_aktivitas = e.id_aktivitas
                                inner join sijuara_program f on e.id_program = f.id_program
                                inner join sijuara_trs_alokasi g on f.id_alokasi = g.id_alokasi
                                where g.ta = '$thn' and a.id_pj in ($id_pjj)")->result();
                        foreach($subs_komp as $skp){
                        ?>
                        <option value="<?= $skp->subkomp ?>"><?= $skp->subkomp ?></option>
                        <?php
                        }
                        }
                        
                        $menim = $this->db->query("select a.* 
                                from sijuara_subkomp a 
                                inner join sijuara_komponen b on a.id_komponen = b.id_komponen
                                inner join sijuara_ro c on b.id_ro = c.id_ro
                                inner join sijuara_kro d on c.id_kro = d.id_kro
                                inner join sijuara_aktivitas e on d.id_aktivitas = e.id_aktivitas
                                inner join sijuara_program f on e.id_program = f.id_program
                                inner join sijuara_trs_alokasi g on f.id_alokasi = g.id_alokasi
                                where g.ta = '$thn' and a.subkomp like '%$spt->menimbang%'")->result();
                        foreach($menim as $men){
                        ?>
                        <option value="<?= $men->subkomp ?>"><?= $men->subkomp ?></option>
                        <?php
                        }
                    */
                    ?>
                  </select>
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
          <div style="margin-bottom:10px" class="col-6 col-lg-2 col-md-2"><img style="width:150px;height:auto" class="img-responsive" src="<?= base_url() ?>asset/file_lainnya/lap_spt/<?= $value ?>"></div>
          <?php
                }
            }
          ?>
          </div>
            <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary">Buat Laporan Perjalanan Dinas</button>
            </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
</div>
  <!-- /.container-fluid -->