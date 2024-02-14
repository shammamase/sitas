<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Daftar Tamu</h3>
                </div>
                <div class="card-body">
                    <form style="margin-bottom:20px" class="form-inline" method="post" action="<?php echo site_url('nonlogin/lap_buku_tamu') ?>" target="_blank">
                        <div class="col-xs-2">
                        <input size="4" type="text" name="tahun" class="form-control" value="<?php echo date('Y') ?>">
                        </div>
                        <div style="margin-left:5px" class="col-xs-1">
                        <input size="2" type="text" name="bulan" class="form-control" value="<?php echo date('m') ?>">
                        </div>
                        <div style="margin-left:5px" class="col-xs-1">
                        <input size="2" type="text" name="tgl" class="form-control" value="<?php echo date('d') ?>">
                        </div>
                        <div style="margin-left:5px" class="col-xs-2">
                        <button type="submit" name="submit" class="btn btn-success">Export Data</button>
                        </div>
                    </form>
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width:3%">No</th>
                            <th style="width:15%">Nama</th>
                            <th style="width:12%">No HP</th>
                            <th style="width:15%">Asal Instansi</th>
                            <th style="width:20%">Maksud dan Tujuan</th>
                            <th style="width:15%">Bertemu</th>
                            <th style="width:10%">Foto</th>
                            <th style="width:10%">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $no = 1;
                        if($rec){
                        foreach ($rec as $ls){
                    ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $ls->nama ?></td>
                        <td><?php echo $ls->no_hp ?></td>
                        <td><?php echo $ls->asal_instansi ?></td>
                        <td><?php echo $ls->maksud_tujuan ?></td>
                        <td><?php echo $ls->nm ?></td>
                        <td><img style="height:100px;width:auto" src="<?= base_url() ?>asset/foto_tamu/<?= $ls->foto_tamu ?>.jpg"></td>
                        <td><?php echo $ls->waktu ?></td>
                    </tr>
                    <?php
                    $no++;
                        }
                    }
                    ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>