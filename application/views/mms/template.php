<!DOCTYPE html>
<html>

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

    <link rel="canonical" href="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
    <?php 
        $urix3 = $this->uri->segment(3);
        if ($this->uri->segment(2)=="detail") {
            $view_thum = $this->db->query("SELECT * FROM cltr_post WHERE judul_seo = '$urix3'")->row();  
        ?>
            <meta property="og:title" content="<?php echo $view_thum->judul ?>" />
             <meta property="og:type" content="article" />
             <meta property="og:url" content="<?php echo base_url() ?><?php echo $this->uri->segment(1) ?>/detail/<?php echo $this->uri->segment(3) ?>" />
             <meta property="og:image" content="<?php echo base_url() ?>asset/foto_content/<?php echo $view_thum->thumbnail  ?>" />
             <meta property="og:description" content=""/>
        <?php
        }
     ?>

    <!-- favicon -->
    <?php 
        $fav = $this->db->query("select favicon from cltr_identitas where id_identitas = 1")->row();
     ?>
    <link href="<?php echo base_url(); ?>asset/<?php echo $fav->favicon ?>" rel=icon>
    <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800" rel="stylesheet"> 
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/js/chart_spedo.css"><!-- hapus nnti -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/css/owl.carousel.min.css"><!-- hapus nnti -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/css/animate.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/css/font-awesome.min.css">
    
    <link rel="stylesheet" type="text/css" href="http://mamasecorps.com/coki/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="http://mamasecorps.com/coki/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="http://mamasecorps.com/coki/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="http://mamasecorps.com/coki/css/util.min.css">
    <link rel="stylesheet" type="text/css" href="http://mamasecorps.com/coki/css/main.css">
    
    <style>
    div#google_translate_element span{
        color:green;
    }
    </style>
</head>


    <body>

    <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({pageLanguage: 'id', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
    }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <?php include "main-menu_mms.php"; ?>
    <?php echo $contents; ?>

    
    <!-- Footer -->
    <?php $this->model_utama->kunjungan(); ?>
	<footer>
		<div class="bg2 p-t-40 p-b-25">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 p-b-20">
						<div class="size-h-3 flex-s-c">
						    <?php 
                                $lg = $this->db->query("select logo from cltr_identitas where id_identitas = 1")->row();
                               ?>
                              <a href="" class="nav-brand"><img src="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/img/core-img/<?php echo $lg->logo ?>" alt=""></a>
							<a href="<?php echo site_url('Home') ?>">
								<img class="max-s-full" src="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/img/core-img/<?php echo $lg->logo ?>" alt="LOGO">
							</a>
						</div>
                        <?php 
                            $var_id = $this->db->query("select * from cltr_identitas where id_identitas=1")->row();
                            $ft_hd = $topheader->row();
                         ?>
						<div>
							<p class="f1-s-1 cl11 p-b-16">
								<?php echo $var_id->alamat ?>
							</p>

							<p class="f1-s-1 cl11 p-b-16">
								<?php 
                                    foreach ($topheader->result() as $ft_hd) {
                                ?>
                                <i class="<?php echo $ft_hd->icon ?>"></i> <?php echo $ft_hd->nama_menu ?>&nbsp;&nbsp;
                                <?php
                                    }
                                 ?>
							</p>

							<div class="p-t-15">
								<?php 
                                    foreach ($topheader2->result() as $ft_hd2) {
                                ?>
                                <a href="<?php echo $ft_hd2->url ?>"><i class="<?php echo $ft_hd2->icon ?>" aria-hidden="true"></i></a>
                                <?php
                                    }
                                 ?>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-lg-4 p-b-20">
						<div class="size-h-3 flex-s-c">
							<h5 class="f1-m-7 cl0">
								Popular Posts
							</h5>
						</div>

						<ul>
						    <?php
						           $thn = date('Y');
						           $xss = $this->db->query("SELECT a.*, b.nama_lengkap FROM cltr_post a INNER JOIN users b ON a.username=b.username WHERE a.acc = 1 AND a.id_page = '$id_p' AND a.tanggal like '%$thn' ORDER BY a.dibaca DESC LIMIT 3")->result();
                                    foreach ($xss as $xs) {
                            ?>
                            <li class="flex-wr-sb-s p-b-20">
								<a href="<?php echo site_url('berita/detail/'.$xs->judul_seo) ?>" class="size-w-4 wrap-pic-w hov1 trans-03">
									<img src="<?php echo base_url() ?>asset/foto_content/<?php echo $xs->thumbnail ?>" alt="IMG">
								</a>

								<div class="size-w-5">
									<h6 class="p-b-5">
										<a href="#" class="f1-s-5 cl11 hov-cl10 trans-03">
											<?php echo $xs->judul ?>
										</a>
									</h6>

									<span class="f1-s-3 cl6">
										<?php echo tgl_indo($xs->tanggal) ?>
									</span>
								</div>
							</li>
                            <?php
                                }
                             ?>
						</ul>
					</div>

					<div class="col-sm-6 col-lg-4 p-b-20">
						<div class="size-h-3 flex-s-c">
							<h5 class="f1-m-7 cl0">
								Category
							</h5>
						</div>

						<ul class="m-t--12">
							<li class="how-bor1 p-rl-5 p-tb-10">
								<a href="#" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
									Fashion (22)
								</a>
							</li>

							<li class="how-bor1 p-rl-5 p-tb-10">
								<a href="#" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
									Technology (29)
								</a>
							</li>

							<li class="how-bor1 p-rl-5 p-tb-10">
								<a href="#" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
									Street Style (15)
								</a>
							</li>

							<li class="how-bor1 p-rl-5 p-tb-10">
								<a href="#" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
									Life Style (28)
								</a>
							</li>

							<li class="how-bor1 p-rl-5 p-tb-10">
								<a href="#" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
									DIY & Crafts (16)
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="bg11">
			<div class="container size-h-4 flex-c-c p-tb-15">
				<span class="f1-s-1 cl0 txt-center">
					<a href="#" class="f1-s-1 cl10 hov-link1"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> BPTP Gorontalo All rights reserved
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</span>
			</div>
		</div>
	</footer>

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<span class="fas fa-angle-up"></span>
		</span>
	</div>

	<!-- Modal Video 01-->
	<div class="modal fade" id="modal-video-01" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document" data-dismiss="modal">
			<div class="close-mo-video-01 trans-0-4" data-dismiss="modal" aria-label="Close">&times;</div>

			<div class="wrap-video-mo-01">
				<div class="video-mo-01">
					<iframe src="https://www.youtube.com/embed/wJnBTPUQS5A?rel=0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
<!--===============================================================================================-->	
	<script src="http://mamasecorps.com/coki/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="http://mamasecorps.com/coki/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script src="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/js/bootstrap/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/js/bootstrap/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="http://mamasecorps.com/coki/js/main.js"></script>
    <script type="text/javascript" src="https://widget.kominfo.go.id/gpr-widget-kominfo.min.js"></script>
    
    <script src="<?php echo base_url(); ?>template/<?php echo template_cltr(); ?>/assets/js/chart_spedo.js"></script>
    
</body>
</html>