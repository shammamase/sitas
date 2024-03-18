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
                                <td>
                                    <a target="_blank" href="<?= base_url() ?>preview/cuti/<?= $uri3 ?>/<?= $uri4 ?>">
                                    <i class="fa fa-file-pdf"> PDF</i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <form method="post" action="<?= site_url('primer/proses_cuti_sebelum') ?>">
                        <div class="form-group">
                            <label>Jumlah sisa cuti 2022</label>
                            <input type="number" class="form-control" name="jumlah[]" value="<?= $jumlah_cuti_lalu_sekali ?>">
                        </div>
                        <div class="form-group">
                            <label>Jumlah sisa cuti 2023</label>
                            <input type="number" class="form-control" name="jumlah[]" value="<?= $jumlah_cuti_lalu ?>">
                        </div>
                        <div class="form-group">
                            <label>Jumlah sisa cuti 2024</label>
                            <input type="number" class="form-control" name="jumlah[]" value="<?= $jumlah_cuti_ini ?>">
                        </div>
                        <input type="hidden" name="id_pegawai" value="<?= $id_pegawai ?>">
                        <input type="hidden" name="uri3" value="<?= $uri3 ?>">
                        <input type="hidden" name="uri4" value="<?= $uri4 ?>">
                        <input type="hidden" name="thnx[]" value="<?= $thn_lalu_sekali?>">
                        <input type="hidden" name="thnx[]" value="<?= $thn_lalu ?>">
                        <input type="hidden" name="thnx[]" value="<?= $thn_ini ?>">
                        <input type="hidden" name="pejabat_atasan_langsung" value="<?= $pejabat_atasan_langsung ?>">
                        <div class="form-group">
                            <input type="submit" name="simpan" class="btn btn-primary btn-block" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>