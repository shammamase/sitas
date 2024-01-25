<!DOCTYPE html>
<html>
<head>
  <title>Status SPT</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<br>
<div class="container">
  <div class="card">
      <div class="card-header bg-success text-white">
          Info
      </div>
        <div class="card-body">
          <img src="<?php echo base_url() ?>asset/file_lainnya/valid.png">
          <?php
            if(!empty($no_surat)){
                $no_srt = $no_surat->no_lengkap;
            } else {
                $no_srt = " - ";
            }
          ?>
          <table style="margin-top:20px" class="table table-striped">
            <thead>
              <tr>
                <td>No Surat</td>
                <td><?= $no_srt ?></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Untuk</td>
                <td><?php echo $spt->hal ?></td>
              </tr>
              <tr>
                <td>Kepada</td>
                <td><?php echo $spt->kepada." di ".$spt->lokasi_kepada ?></td>
              </tr>
              <tr>
                <td>Tanggal Surat</td>
                <td><?php echo tgl_indoo($spt->tanggal) ?></td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
</div>
    
</body>
</html>