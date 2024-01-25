<?php $dtnya = $dtl->row() ?>
    <img class="img-fluid" src="<?php echo base_url() ?>asset/android/eviden/<?php echo $dtnya->gambar ?>">
    <table style="margin-top:10px" class="table table-striped">
        <tbody>
        <tr>
        <th><?php echo $dtnya->keterangan ?></th>
        </tr>
        <tr>
        <th><?php echo tgl_indo($dtnya->tanggal) ?> <?php echo $dtnya->jam ?></th>
        </tr>
        </tbody>
    </table>