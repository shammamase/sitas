<form method="post" action="<?= site_url('sijuara/save_user') ?>" class="was-validated">
    <h3>User <?= $bio->nama ?></h3>
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?= $username ?>" required>
        <div class="valid-feedback">Valid</div>
        <div class="invalid-feedback">Harap di isi !!</div>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" id="password" name="password" value="<?= $password ?>" required>
        <div class="valid-feedback">Valid</div>
        <div class="invalid-feedback">Harap di isi !!</div>
    </div>
    <input type="hidden" value="<?= $status ?>" name="status">
    <input type="hidden" value="<?= $bio->id_bio ?>" name="id_bio">
    <input type="hidden" value="<?= $bio->nik ?>" name="nik">
    <input type="hidden" value="<?= $id_pj ?>" name="id_pj">
    <input type="hidden" value="<?= $id_user ?>" name="id_user">
    <button type="submit" name="submit" class="btn btn-primary">Save</button>
</form>