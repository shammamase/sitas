<?php
    $lvel = explode(",",$lvl);
?>
<form method="post" action="<?= site_url('sijuara/save_level') ?>">
    <h3><?= $bio->nama ?></h3>
    <?php if(!empty($id_user)){ ?>
        <?php foreach($stakh as $st) { 
            if(in_array($st->id_stakholder,$lvel)){
                $cekd = "checked";
            } else {
                $cekd = "";
            }
        ?>
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" id="check<?= $st->id_stakholder ?>" name="id_stakholder[]" value="<?= $st->id_stakholder ?>" <?= $cekd ?>><?= $st->stakholder ?>
          </label>
        </div>
        <?php } ?>
    <input type="hidden" name="id_user" value="<?= $id_user ?>">
    <input type="hidden" name="status" value="<?= $status ?>">
    <button style="margin-top:20px" type="submit" name="submit" class="btn btn-primary">Submit</button>
    <?php 
        } else {
            echo "Anda belum membuat username untuk pegawai ini !!, Silahkan buat username pada tombol <b>Buat User</b>";
        }
    ?>
  </form>