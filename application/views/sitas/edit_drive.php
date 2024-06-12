<form method="post" action="<?= site_url('sekunder/proses_edit_folder') ?>">
    <div class="form-group">
    <label for="email">Nama Folder</label>
        <input type="text" class="form-control" name="folder" value="<?= $nama ?>" required>
    </div>
    <input type="hidden" name="id_folder" value="<?= $id_folder ?>"/>
    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
</form>