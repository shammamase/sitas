<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12"> 
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Input jumlah cuti sebelumnya</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Nama</th>
                            <th>Alasan</th>
                            <th>Tanggal</th>
                            <th>Sisa</th>
                            <th>PDF</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $nama ?></td>
                                <td><?= $alasan ?></td>
                                <td><?= tgl_indoo($tanggal) ?> (<b><?= $lama ?> Hari</b>)</td>
                                <td><?= $sisa ?></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <form method="post" action="<?= site_url('primer/proses_cuti_sebelum') ?>">
                        <div class="form-group">
                            <label>Jumlah cuti sebelumnya</label>
                            <input type="number" class="form-control" name="jumlah" value="<?= $jumlah_cuti_lalu ?>">
                        </div>
                        <input type="hidden" name="id_pegawai" value="<?= $id_pegawai ?>">
                        <input type="hidden" name="uri3" value="<?= $uri3 ?>">
                        <input type="hidden" name="uri4" value="<?= $uri4 ?>">
                        <input type="hidden" name="pejabat_atasan_langsung" value="<?= $pejabat_atasan_langsung ?>">
                        <div class="form-group">
                            <input type="submit" name="simpan" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>