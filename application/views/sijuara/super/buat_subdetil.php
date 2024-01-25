<a href="<?= base_url() ?>utama/detil/<?= $back ?>" class="btn btn-primary">Kembali</a>
        <br><br>
<div class="container-fluid"> 
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Daftar Detil <?= $dtl->kd_detil ?> - <?= $dtl->detil ?></h3>
    </div>
    <div class="card-body">
    <form method="post" action="" enctype="multipart/form-data">
      <input type="hidden" name="id_detil" value="<?= $id_detil ?>">
      <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="width:2%">No</th>
          <th style="width:60%">Subdetil</th>
          <th style="width:7%">Vol</th>
          <th style="width:13%">Satuan</th>
          <th style="width:13%">Harga Satuan</th>
          <th style="width:5%"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $qwx = $this->db->query("select * from sijuara_subdetil where id_detil = $id_detil")->result();
        foreach($qwx as $qw){
        ?>
        <input type="hidden" name="id_subdetil[]" value="<?= $qw->id_subdetil ?>">
        <tr>
            <td><?= $no ?></td>
            <td>
                <textarea name="subdetil[]" class="form-control"><?= $qw->subdetil ?></textarea>
            </td>
            <td><input type="text" class="form-control" name="vol[]" value="<?= $qw->vol ?>"></td>
            <td><input type="text" class="form-control" name="satuan[]" value="<?= $qw->satuan ?>"></td>
            <td><input type="text" class="form-control" name="harga_satuan[]" value="<?= $qw->harga_satuan ?>"></td>
            <td><a onclick="return confirm('Apa anda yakin untuk hapus Data ini <?= $qw->subdetil ?>?')" href="<?= base_url() ?>utama/hapus_subdetil/<?= $id_detil ?>/<?= $qw->id_subdetil ?>" class="btn btn-danger btn-xs">Hapus</a></td>
        </tr>
        <?php
        $no++;
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
            <td></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
      </table>
    </div>
      <button type="submit" name="submit" class="btn btn-primary btn-block">Simpan</button>
    </form>
    </div>
  </div>
</div>
  <!-- /.container-fluid -->