<option value="">--Pilih MAK--</option>
<?php foreach($subdetil as $lk){ ?>
    <option value="<?= $lk->id_subdetil ?>"><?= $lk->kd_detil ?>-<?= $lk->subdetil ?></option>
<?php } ?>