<?php 
$nama_file_to = explode(".",$nama_file);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Upload ADK</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
  <div class="card mt-4">
      <div class="card-header">
          <h3>2. Upload File ZIP</h3>
          <ol>
              <li>Download file zip ini terlebih dahulu <a target="_blank" href="<?= base_url() . $unduh?>" class="btn btn-warning btn-sm"><b><?= $nama_file ?></b></a></li>
              <li>(windows) Klik Kanan pada file zip yang telah di download kemudian pilih (klik) <b>extract files</b> / (macbook) klik kanan -> pilih open with -> the unarchiver</li>
              <li>File zip akan berubah menjadi folder, selanjutnya hapus file <b><?= $nama_file ?></b> yang telah didownload</li>
              <li>Klik kanan pada folder <b><?= $nama_file_to[0] ?></b> dan pilih <b>compres to zip</b></li>
              <li>Upload file zip <b><?= $nama_file ?></b> terbaru dibawah form ini</li>
          </ol>
      </div>
      <div class="card-body">
          <form method="post" action="<?= base_url('rkakl/proses_unzip') ?>" enctype="multipart/form-data">
            <div class="form-group">
              <label for="email">File ZIP:</label>
              <input type="file" class="form-control" name="filex">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
  </div>
</div>

</body>
</html>
