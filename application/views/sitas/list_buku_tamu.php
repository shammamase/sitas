<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <?php 
        $title = "BPSI TAS";
     ?>
    <title><?php echo $title ?></title>
    <link href="<?= base_url() ?>asset/favicon.png" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" id="bootstrap-css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core Stylesheet -->
</head>


<body style="background-color:#27d3a8">
<div class="container-fluid">
    <div class="col-12">
        <div class="card bg-light text-dark mt-5">
          <div class="card-body">
            <div class="row" style="padding:5px">
                <div class="col-lg-6">
                <h5>Terima Kasih Telah Berkunjung di BSIP TAS</h5>
                <a href="<?php echo site_url('nonlogin/buku_tamu') ?>"><button type="button" class="btn btn-primary">Registrasi Buku Tamu</button></a> 
                </div>
                <form class="form-inline" method="post" action="<?php echo site_url('nonlogin/lap_buku_tamu') ?>" target="_blank">
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
            </div>
            <div class="table-responsive">
             <table class="table table-hover">
                <thead style="background-color:#1f441e; color:#ffffff">
                  <tr>
                    <th style="width:3%">No</th>
                    <th style="width:15%">Nama</th>
                    <th style="width:7%">No HP</th>
                    <th style="width:15%">Asal Instansi</th>
                    <th style="width:20%">Maksud dan Tujuan</th>
                    <th style="width:20%">Ingin Bertemu</th>
                    <th style="width:10%">Foto</th>
                    <th style="width:10%">Waktu</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                 $no = 1;
                 foreach ($listx as $ls) {
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
                ?>
                </tbody>
              </table>
              </div>
          </div>
        </div>
    </div>
</div>
</body>
</html>