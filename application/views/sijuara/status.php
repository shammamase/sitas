<!DOCTYPE html>
<html>
<head>
  <title>Bootstrap Example</title>
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
            $data_x = $dt_sp->row();
          ?>
          <table style="margin-top:20px" class="table table-striped">
            <thead>
              <tr>
                <td>Tanggal Pengajuan</td>
                <td><?php echo $data_x->tanggal ?></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Keperluan</td>
                <td><?php echo $data_x->keperluan ?></td>
              </tr>
              <tr>
                <td>Persentase Kegiatan</td>
                <td><?php echo $data_x->persentase ?>%</td>
              </tr>
              <tr>
                <td>PUMK</td>
                <td>
                    <?php 
                        $get_nama_asli = $this->db->query("
                            select c.nama
                            from sijuara_user a
                            inner join sijuara_pj b on a.id_pj = b.id_pj
                            inner join t_biodata c on b.id_bio = c.id_bio
                            where a.username = '$data_x->username'
                        ")->row();
                    echo $get_nama_asli->nama;
                    ?>
                </td>
              </tr>
              <?php
                foreach($dt_sp->result() as $brsa){
             ?>
             <tr>
                <td><?php echo $brsa->detil ?></td>
                <td><?php echo number_format($brsa->pengajuan_ini) ?></td>
              </tr>
             <?php
                }
              ?>
            </tbody>
          </table>
          
        </div>
    </div>
</div>
    
</body>
</html>