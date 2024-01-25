<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WELCOME ADMINISTRATOR</title>
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
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>asset/lte31/plugins/jquery/jquery.min.js"></script>
    <div class="wrapper">
      
          <?php include "main-header-cltr.php"; ?>
      

      
          <?php include "menu-admin-cltr.php"; ?>
      
      <div class="content-wrapper">
        <section class="content">
            <br>
            <?php echo $contents; ?>
            <br>
        </section>
        <div style='clear:both'></div>
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
          <?php include "footer-cltr.php"; ?>
      </footer>
    </div><!-- ./wrapper -->
    
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
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>asset/lte31/dist/js/demo.js"></script>
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
  /*
  $(document).ajaxStart(function() { Pace.restart(); });
    $('.ajax').click(function(){
        $.ajax({url: '#', success: function(result){
            $('.ajax-content').html('<hr>Ajax Request Completed !');
        }});
    });
  */

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
