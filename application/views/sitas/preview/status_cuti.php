<!DOCTYPE html>
<html>
<head>
  <title>Status</title>
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
          <div style="text-align:center">
            <img src="<?php echo base_url() ?>asset/valid.png">
          </div>
          <table style="margin-top:20px" class="table table-striped">
            <thead>
              <tr>
                <td>Jenis Cuti</td>
                <td><?= $jns_cuti->jenis_cuti ?></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Kepada</td>
                <td><?php echo $bio->nama ?></td>
              </tr>
              <tr>
                <td>Alasan Cuti</td>
                <td><?php echo $data->alasan_cuti ?></td>
              </tr>
              <tr>
                <td>Lama Cuti</td>
                <td><?php echo $data->lama_cuti ?> Hari</td>
              </tr>
              <tr>
                <td>Tanggal Mulai Cuti</td>
                <td><?php echo tgl_indoo($data->tgl_mulai) ?></td>
              </tr>
              <tr>
                <td>Tanggal Akhir Cuti</td>
                <td><?php echo tgl_indoo($data->tgl_akhir) ?></td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
</div>
    
</body>
</html>