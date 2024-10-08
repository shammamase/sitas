<html>
    <head>
      <title>Laporan</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body>
    <div class="container">
        <img style="width:95%; margin-left:15px" src="<?= base_url() ?>asset/kop_surat1.png">
        <h5 style="margin-top:30px;text-align:center"><u>Daftar Buku Tamu Periode <?php echo tgl_indo($timex) ?></u></h5>
        <table style="width:100%;margin-top:20px" class="table table-striped">
        <thead>
        <tr>
            <th>No</th><th>Nama</th><th>No HP</th><th>Instansi</th><th>Maksud Tujuan</th><th>Pengikut</th><th>Tanggal</th>
        <tr>
        </thead>
        <tbody>
        <?php
            $now = 1;
            foreach($dtx->result() as $dt){
                $wktu = substr($dt->waktu,0,10);
                $wkt = tgl_indo($wktu);
                if($dt->pengikut == 0){
                    $jml_ikut = "-";
                } else {
                    $jml_ikut = $dt->pengikut;
                }
        ?>
        <tr>
            <td style="width:2%"><?php echo $now ?></td>
            <td style="width:23%"><?php echo $dt->nama ?></td>
            <td style="width:10%"><?php echo $dt->no_hp ?></td>
            <td style="width:17%"><?php echo $dt->asal_instansi ?></td>
            <td style="width:25%"><?php echo $dt->maksud_tujuan ?></td>
            <td style="width:8%"><?php echo $jml_ikut ?></td>
            <td style="width:15%"><?php echo $wkt ?></td>
        </tr>
        <?php
            $now++;
            }
        ?>
        </tbody>
        </table>
    </div>
    </body>
</html>