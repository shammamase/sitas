<form method="post" action="<?= site_url('sijuara/save_pegawai') ?>" class="was-validated" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?= $peg->nama ?>" required>
        <div class="valid-feedback">Valid</div>
        <div class="invalid-feedback">Harap di isi !!</div>
    </div>
    <div class="form-group">
        <label>NIP</label>
        <input type="text" class="form-control" id="nip" name="nip" value="<?= $peg->nip ?>" required>
        <div class="valid-feedback">Valid</div>
        <div class="invalid-feedback">Harap di isi !!</div>
    </div>
    <div class="form-group">
        <label>NIK</label>
        <input type="number" class="form-control" id="nik" name="nik" value="<?= $peg->nik ?>" required>
        <div class="valid-feedback">Valid</div>
        <div class="invalid-feedback">Harap di isi !!</div>
    </div>
    <div class="form-group">
        <label>Jenis Kelamin</label>
        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="<?= $peg->jenis_kelamin ?>"><?= $peg->jenis_kelamin ?></option>
            <option value="Pria">Pria</option>
            <option value="Wanita">Wanita</option>
        </select>
        <div class="valid-feedback">Valid</div>
        <div class="invalid-feedback">Harap di pilih !!</div>
    </div>
    <div class="form-group">
        <label>Tempat Lahir</label>
        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $peg->tempat_lahir ?>">
    </div>
    <div class="form-group">
        <label>Tanggal Lahir</label>
        <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $peg->tanggal_lahir ?>" placeholder="thn-bln-tgl. Contoh:(1980-08-17)">
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $peg->alamat ?>">
    </div>
    <div class="form-group">
        <label>No HP</label>
        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $peg->no_hp ?>">
        <div class="valid-feedback">Valid</div>
        <div class="invalid-feedback">Harap di isi !!</div>
    </div>
    <div class="form-group">
        <label>Upload Tanda Tangan Scan</label>
        <input type="file" class="form-control" name="gbr">
        <?php 
            if(!empty($peg->ttd)){
        ?>
        <img style="height:100px;width:auto" src="<?= base_url() ?>asset/file_lainnya/ttd_scan/<?= $peg->ttd ?>">
        <?php
            } else {
                echo "Belum ada upload tanda tangan scan";
            }
        ?>
    </div>
    <input type="hidden" value="edit" name="status">
    <input type="hidden" value="<?= $peg->id_bio ?>" name="id_bio">
    <button type="submit" name="submit" class="btn btn-primary">Save</button>
</form>