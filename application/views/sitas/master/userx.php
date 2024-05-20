<form method="post" action="<?= site_url('sekunder/simpan_user') ?>">
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?= $username ?>" required>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="text" name="password" class="form-control" required>
    </div>
    <input type="hidden" name="id_pegawai" value="<?= $id_pegawai ?>">
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>