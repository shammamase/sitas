<div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
      <a href="<?= base_url() ?>utama/komponen/<?= $back ?>" class="btn btn-primary">Kembali</a>
        <br><br>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Sub Komponen</h3>
          </div>
          <div class="card-body">
            
            <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
              <label>KD Sub Komponen :</label>
              <input type="text" class="form-control" name="kd_subkomp" value="<?= $kd_subkomp ?>" required>
            </div>
            <div class="form-group">
              <label>Sub Komponen :</label>
              <input type="text" class="form-control" name="subkomp" value="<?= $subkomp ?>" required>
            </div>
            <div class="form-group">
              <label>Jumlah Biaya :</label>
              <input type="text" class="form-control" name="jumlah_biaya" value="<?= $jumlah_biaya ?>" required>
            </div>
            <div class="form-group">
              <label>Penanggung Jawab</label>
              <select name="id_pj" class="form-control select2" required>
                <option value="<?= $id_pj ?>"><?= $nama_pj ?></option>
                    <?php 
                    foreach($pjx as $pj){
                    ?>
                    <option value="<?= $pj->id_pj ?>"><?= $pj->nama ?></option>
                    <?php
                    }
                    ?>
              </select>
            </div>
            <div class="form-group">
              <label>PUMK</label>
              <select name="id_pumk" class="form-control select2" required>
                <option value="<?= $id_pumk ?>"><?= $nama_pumk ?></option>
                    <?php 
                    foreach($pum as $pm){
                    ?>
                    <option value="<?= $pm->id_pj ?>"><?= $pm->nama ?></option>
                    <?php
                    }
                    ?>
              </select>
            </div>
            <div class="form-group">
              <label>Blokir :</label>
              <input type="text" class="form-control" name="blokir" value="<?= $blokir ?>" required>
            </div>
            <input type="hidden" name="aksi" value="<?= $aksi ?>">
            <input type="hidden" name="idx" value="<?= $idx ?>">
            <input type="hidden" name="id_komponen" value="<?= $id_komponen ?>">
          </div>
            <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            </div>
          <!-- /.card-body -->
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
    
    
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Daftar Sub Komponen</h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="width:2%">No</th>
          <th style="width:5%">KD</th>
          <th style="width:23%">SubKomp</th>
          <th style="width:15%">Jumlah Biaya</th>
          <th style="width:15%">PJ</th>
          <th style="width:15%">PUMK</th>
          <th style="width:5%">Blokir</th>
          <th style="width:20%">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $qwx = $this->db->query("select * from sijuara_subkomp where id_komponen = $id_komponen")->result();
        foreach($qwx as $qw){
            $pj_select = $this->db->query("select b.nama from sijuara_pj a 
												inner join t_biodata b on a.id_bio=b.id_bio 
												where a.id_pj = $qw->id_pj")->row();
            $pum_select = $this->db->query("select a.id_pj, b.nama from sijuara_pj a 
												inner join sijuara_pumk aa on aa.id_pj=a.id_pj
												inner join t_biodata b on a.id_bio=b.id_bio 
												where aa.id_subkomp = $qw->id_subkomp")->row();
        ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $qw->kd_subkomp ?></td>
            <td><?= $qw->subkomp ?></td>
            <td><?= number_format($qw->jumlah_biaya) ?></td>
            <td><?= $pj_select->nama ?></td>
            <td><?= $pum_select->nama ?></td>
            <td><?= $qw->blokir ?></td>
            <td>
              <a href="<?= base_url() ?>utama/subkomp/<?= $qw->id_komponen ?>/edit/<?= $qw->id_subkomp ?>" class="btn btn-primary">
                Edit
              </a>
              <a href="<?= base_url() ?>utama/subkomp/<?= $qw->id_komponen ?>/copy/<?= $qw->id_subkomp ?>" class="btn btn-success">
                Copy
              </a>
              <a href="<?= base_url() ?>utama/detil/<?= $qw->id_subkomp ?>" class="btn btn-dark">
                Detil
              </a>
            </td>
        </tr>
        <?php
        $no++;
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
  <!-- /.container-fluid -->