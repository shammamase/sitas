<!DOCTYPE html>
<html lang="en">
<head>
  <title>Alert</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: 'Berhasil!',
        text: 'Pesan Telah Terkirim',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke halaman
                window.location.href = '<?= base_url() ?>primer/status_spt/<?= $uri3 ?>/<?= $uri4 ?>';
            }
    });
</script>
</body>
</html>