<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <?php 
        $title = "BPTP Gorontalo";
     ?>
    <title><?php echo $title ?></title>

    <!-- favicon -->
    <?php 
        $fav = $this->db->query("select favicon from cltr_identitas where id_identitas = 1")->row();
     ?>
    <link href="<?php echo base_url(); ?>asset/<?php echo $fav->favicon ?>" rel=icon>
    <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800" rel="stylesheet"> 
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/css/classy-nav.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/css/elegant-icon.css">
    <link href="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/select2/dist/css/select2.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/js/jquery/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/js/bootstrap/bootstrap.min.js"></script>
    
</head>


    <body style="background-color:#27d3a8">
        
    <?php echo $contents; ?>

    
    <?php $this->model_utama->kunjungan(); ?>
        

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    
    
    <!-- Popper js -->
    <script src="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    
    <!-- All Plugins js -->
    <script src="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/js/active.js"></script>
    
    <!-- js selec2 -->
    <script src="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/select2/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
           $('.tes').select2(); 
        });
    </script>
    <!-- js selec2 -->
</body>
</html>