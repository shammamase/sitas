<!DOCTYPE html>
<html>
<head>
  <title>Status Perjalanan Dinas</title>
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
                <td><?php echo $spt->untuk ?></td>
              </tr>
              <tr>
                  <td>Kepada</td>
                  <td>
                  <?php
                      foreach($peg as $pg){
                            $tgl_plk = $pg->tanggal;
                    ?>
                    <?= $pg->nama ?><br>
                    <?php
                        }
                        
                        //logika tgl s.d tgl
                        $pc_tgl_plk = explode(",",$tgl_plk);
                        $jml_tgl = count($pc_tgl_plk);
                        if($jml_tgl>1){
                            $pc1 = explode("-",$pc_tgl_plk[0]);
                            $pc2 = explode("-",end($pc_tgl_plk));
                            if($pc1[1]==$pc2[1]){
                                $val_tgl = $pc1[2]." s.d ".tgl_indoo(end($pc_tgl_plk));
                            } else {
                                $pc11 = explode(" ",tgl_indoo($pc_tgl_plk[0]));
                                $val_tgl = $pc11[0]." ".$pc11[1]." s.d ".tgl_indoo(end($pc_tgl_plk));
                            }
                        } else {
                            $val_tgl = tgl_indoo($pc_tgl_plk[0]);
                        }
                        // end logika tgl s.d tgl
                    ?>
                  </td>
              </tr>
              <tr>
                <td>Tanggal Perjalanan</td>
                <td><?php echo $val_tgl ?></td>
              </tr>
              <tr>
                <td>Lokasi</td>
                <td><?php echo $lap_spt->lokasi ?></td>
              </tr>
              <tr>
                <td>Yang Membuat Laporan</td>
                <td><?php echo $user->nama ?></td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
</div>
    
</body>
</html>