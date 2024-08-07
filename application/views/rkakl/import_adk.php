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
      <div class="card-header"><h3>1. Upload File (ADK)</h3></div>
      <div class="card-body">
          <form method="post" action="<?= base_url('rkakl/proses_adk') ?>" enctype="multipart/form-data">
            <div class="form-group">
              <label for="email">File ADK:</label>
              <input type="file" class="form-control" name="filex">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
  </div>
</div>

</body>
</html>
