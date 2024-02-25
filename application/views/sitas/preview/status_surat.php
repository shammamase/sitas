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
                <td>No Surat</td>
                <td><?= $data->no_surat_keluar ?></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Kode Arsip</td>
                <td><?php echo $kode_arsip->kode_sub_arsip."-".$kode_arsip->sub_arsip ?></td>
              </tr>
              <tr>
                <td>Tujuan Surat</td>
                <td><?php echo $data->tujuan_surat ?></td>
              </tr>
              <tr>
                <td>Perihal</td>
                <td><?php echo $data->perihal ?></td>
              </tr>
              <tr>
                <td>Tanggal Surat</td>
                <td><?php echo tgl_indoo($data->tanggal) ?></td>
              </tr>
              <tr>
                <td>Status Verifikasi</td>
                <td>
                    <?php 
                    if($data->id_verif == 0){
                        echo "Belum";
                    } else {
                        echo "Sudah";
                    }
                    ?>
                </td>
              </tr>
              <tr>
                <td>Pejabat Verifikasi</td>
                <td>
                    <?php 
                    if($data->id_verif == 0){
                        $view_pjb = "-";
                    } else {
                        $qw = $this->model_sitas->rowDataBy("nama","pegawai","id_pegawai = $data->id_verif")->row();
                        $view_pjb = $qw->nama;
                    }
                    echo $view_pjb;
                    ?>
                </td>
              </tr>
              <tr>
                <td>Waktu Verifikasi</td>
                <td>
                    <?php 
                    if($data->id_verif == 0){
                        $waktu = "-";
                    } else {
                        $waktu = $data->waktu_verif;
                    }
                    echo $waktu;
                    ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
</div>    
</body>
</html>