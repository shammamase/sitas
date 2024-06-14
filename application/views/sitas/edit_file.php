<form method="post" action="<?= site_url('sekunder/proses_edit_file') ?>">
    <div class="form-group">
    <label for="email">Nama File</label>
        <input type="text" class="form-control" name="nama_file" value="<?= $nama_file ?>" required>
    </div>
    <input type="hidden" name="id_file" value="<?= $id_file ?>"/>
    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
</form>