<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIJUARA</title>
    <meta name="author" content="phpmu.com">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/lte31/plugins/fontawesome-free/css/all.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Tempusdominus Bootstrap 4 -->
      <!-- DataTables -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/lte31/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/lte31/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/lte31/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
      
      <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/lte31/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
      <!-- iCheck -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/lte31/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
      <!-- JQVMap -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/lte31/plugins/jqvmap/jqvmap.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/lte31/dist/css/adminlte.min.css">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/lte31/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/lte31/plugins/daterangepicker/daterangepicker.css">
      <!-- summernote 
      <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/lte31/plugins/summernote/summernote-bs4.min.css">
      -->
    
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <style type="text/css">
      .files{ position:absolute; z-index:2; top:0; left:0; filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; opacity:0; background-color:transparent; color:transparent; } 
      #example thead tr, #table1 thead tr, #example1 thead tr, #example2 thead tr{ background-color: #e3e3e3; }
    </style>
    <!--<script type="text/javascript" src="<?php echo base_url(); ?>/asset/admin/plugins/jQuery/jquery-1.12.3.min.js"></script>-->
    <script language="javascript" type="text/javascript"> 
      var maxAmount = 160;
      function textCounter(textField, showCountField) {
        if (textField.value.length > maxAmount) {
          textField.value = textField.value.substring(0, maxAmount);
        }else{ 
          showCountField.value = maxAmount - textField.value.length;
        }
      }
    </script>
    <script src="<?php echo base_url(''); ?>asset/ckeditor/ckeditor.js"></script>
    <style type="text/css">
      .checkbox-scroll { border:1px solid #ccc; width:100%; height: 114px; padding-left:8px; overflow-y: scroll; }
    </style>
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/plugins/jQueryUI/jquery-ui.min.css">
  </head>

  <body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="<?php echo base_url(); ?>/asset/lte31/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>sijuara/logout"><i class="fa fa-power-off"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $users = $this->model_users->users_edit_sijuara($this->session->username)->row_array(); ?>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
        
            <a href="<?php echo site_url('sijuara/home') ?>" class="brand-link">
              <img src="<?php echo base_url(); ?>asset/lte31/dist/img/AdminLTELogo.png" alt="Sijuara Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
              <span class="brand-text font-weight-light">SIJUARA</span>
            </a>
        
            <!-- Sidebar -->
            <div class="sidebar">
              <!-- Sidebar user panel (optional) -->
              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                  <img src="<?php echo base_url(); ?>/asset/admin/dist/img/users.gif" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                  <a href="#" class="d-block"><?php echo $users['nama']; ?></a>
                </div>
              </div>
        
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>sijuara/buat_spt" class="nav-link">
                      <i class="fa fa-list"></i>
                      <p>
                        Buat SPT
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>sijuara/daftar_spt" class="nav-link">
                      <i class="fa fa-list"></i>
                      <p>
                        Daftar SPT
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>sijuara/ganti_password" class="nav-link">
                      <i class="fa fa-key"></i>
                      <p>
                        Ganti Password
                      </p>
                    </a>
                 </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>sijuara/logout" class="nav-link">
                      <i class="fa fa-power-off"></i>
                      <p>
                        Logout
                      </p>
                    </a>
                  </li>
                </ul>
              </nav>
              <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
         </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
    <section class="content">
       <br>
       <?php echo $contents; ?>
       <br>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a target='_BLANK' href="<?php echo site_url('Utama_cltr') ?>"> BPTP Gorontalo</a>.</strong> All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
    
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/jszip/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    
    <!-- ChartJS -->
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/moment/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote 
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/summernote/summernote-bs4.min.js"></script>
    -->
    <!-- overlayScrollbars -->
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>asset/lte31/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url(); ?>asset/lte31/dist/js/pages/dashboard.js"></script>
    

    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url(); ?>asset/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

    <script>
    $('#rangepicker').daterangepicker();
      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
    </script>
<script>
  $(function () {
    $(".textarea").wysihtml5();
  });

  CKEDITOR.replace('editor1' ,{
    filebrowserImageBrowseUrl : '<?php echo base_url('asset/kcfinder'); ?>'
  });
</script>

  <script type="text/javascript">
  // To make Pace works on Ajax calls
  $(document).ajaxStart(function() { Pace.restart(); });
    $('.ajax').click(function(){
        $.ajax({url: '#', success: function(result){
            $('.ajax-content').html('<hr>Ajax Request Completed !');
        }});
    });


    var url = window.location;
    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
      return this.href == url;
    }).addClass('active');

    
    // for treeview 
    $('ul.nav-treeview a').filter(function() { 
        return this.href == url; 
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
  </script>
  </body>
</html>
