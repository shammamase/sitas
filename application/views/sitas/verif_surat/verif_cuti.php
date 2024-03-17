<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Detail Pengajuan Cuti</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table class="table table-bordered table-striped">
        <tr>
            <td><b>Nama Pemohon</b></td>
            <td><?= $rec->nama ?></td>
        </tr>
        <tr>
            <td><b>Jenis Cuti</b></td>
            <td><?= $rec->jenis_cuti ?></td>
        </tr>
        <tr>
            <td><b>Alasan Cuti</b></td>
            <td><?= $rec->alasan_cuti ?></td>
        </tr>
        <tr>
            <td><b>Alamat Cuti</b></td>
            <td><?= $rec->alamat_cuti ?></td>
        </tr>
        <tr>
            <td><b>Lama Cuti</b></td>
            <td><?= $rec->lama_cuti ?> Hari</td>
        </tr>
        <tr>
            <td><b>Tanggal Mulai Cuti</b></td>
            <td><?= tgl_indoo($rec->tgl_mulai) ?></td>
        </tr>
        <tr>
            <td><b>Tanggal Berakhir Cuti</b></td>
            <td><?= tgl_indoo($rec->tgl_akhir) ?></td>
        </tr>
        <tr>
            <td><b>Sisa Cuti</b></td>
            <td>
                <?= $tahun_ini ?> = <?= $n ?><br>
                <?= $tahun_lalu ?> = <?= $n_1 ?><br>
                <?= $tahun_lalux ?> = <?= $n_2 ?><br>
                <?php $total_sisa = $n + $n_1 + $n_2 ?>
                Total = <?= $total_sisa ?>
            </td>
        </tr>
    </table>
    <br>
    <form method="post" action="<?= site_url('sekunder/proses_verif_cuti') ?>">
        <div class="form-group">
            <label>Status Verifikasi</label>
            <select name="id_verif_cuti" class="form-control select2" required>
                <?php foreach($verif_cuti as $vc){ ?>
                <option value="<?= $vc->id_verif_atasan ?>"><?= $vc->verif ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="alasan_atasan" class="form-control"></textarea>
        </div>
        <input type="hidden" name="pejabat_atasan" value="<?= $pejabat_atasan ?>">
        <input type="hidden" name="no_pemohon" value="<?= $no_pemohon ?>">
        <input type="hidden" name="uri3" value="<?= $uri3 ?>">
        <input type="hidden" name="uri4" value="<?= $uri4 ?>">
        <div class="form-group">
            <input type="submit" name="simpan" class="btn btn-primary btn-block" value="Submit">
        </div>
    </form>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->