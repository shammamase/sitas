<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta name="author" content="">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    
    <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/lte31/plugins/fontawesome-free/css/all.min.css">
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/lte31/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/lte31/dist/css/adminlte.min.css">
      
  </head>
  <body style="background-image:url('<?php echo base_url() ?>asset/admin/bg_sijuara.jpg')" class="hold-transition login-page">
    <div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-success">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>SIMANTEP</b></a>
      <p style="margin-bottom:-10px"><b class="text-success">S</b>ISTEM <b class="text-success">I</b>NFORMASI <b class="text-success">MAN</B>AJEMEN <b class="text-success">TE</b>R<b class="text-success">P</b>ADU</p>
    </div>
    <div class="card-body">
      <h2 style="text-align:center;margin-top:-20px;margin-bottom:20px;text-shadow: 1px 1px 2px #FBBC05;" class="text-success"><b>BPTP GORONTALO</b></h2>

      <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name='a' placeholder="Username" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name='b' placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
              <button name='submit' type="submit" class="btn btn-success btn-block">Masuk</button>
          </div>
        </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
    
    
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>/asset/lte31/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>/asset/lte31/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>/asset/lte31/dist/js/adminlte.min.js"></script>
  </body>
</html>
