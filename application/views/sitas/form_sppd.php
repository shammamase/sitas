<form method="post" action="<?= base_url('primer/add_no_sppd') ?>" enctype="multipart/form-data">
    <div class="form-group row">
        <div class="col-lg-12">
            <label for="tes">No SPPD</label>
            <input type="text" name="no_sppd" value="<?= $nox ?>" class="form-control" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <label for="tes">Kendaraan yang digunakan</label>
            <input type="text" name="kendaraan" value="<?= $kendaraan ?>" class="form-control" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <label for="tes">Tempat Berangkat</label>
            <input type="text" name="ket_berangkat" value="<?= $ket_berangkat ?>" class="form-control" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <label for="tes">Tujuan</label>
            <input type="text" name="ket_wilayah" value="<?= $ket_wilayah ?>" class="form-control" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <label for="tes">Satker Pembiayaan</label>
            <input type="text" name="instansi_pembiayaan" value="<?= $instansi_pembiayaan ?>" class="form-control" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <label for="tes">Kode Pembiayaan</label>
            <input type="text" name="kode_pembiayaan" value="<?= $kode_pembiayaan ?>" class="form-control" required>
        </div>
    </div>
    <!--
    <div class="form-group row">
        <div class="col-lg-12">
            <label for="tes">Kelompok/Instansi yang dikunjungi</label>
            <input type="text" name="instansi_tujuan" value="<?= $instansi_tujuan ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <label for="tes">Nama pejabat instansi yang dikunjungi</label>
            <input type="text" name="nama_ttd_yg_dikunjungi" value="<?= $nama_ttd_instansi_tujuan ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <label for="tes">NIP (opsi)</label>
            <input type="text" name="nip_ttd_yg_dikunjungi" value="<?= $nip_ttd_instansi_tujuan ?>" class="form-control">
        </div>
    </div>
    -->
    <div class="form-group row">
        <div class="col-lg-12">
            <label for="tes">Tanggal SPPD</label>
            <input type="text" name="tgl_sppd" value="<?= $tgl_sppd ?>" class="form-control" required>
        </div>
    </div>
    <!--
    <div class="form-group row">
        <div class="col-lg-12">
            <label for="tes">Upload File SPPD (Jika sudah di bubuhi ttd dan cap)</label>
            <input type="file" name="file_pdf" class="form-control">
        </div>
    </div>
    -->
    <input style="display:none" type="hidden" name="id_ppk" value="<?= $id_ppk ?>">
    <input style="display:none" type="hidden" name="id_spt" value="<?= $id_spt ?>" id="id_spt">
    <button type="submit" name="submit" class="btn btn-success btn-block text-white">Simpan</button><br>
</form>