<html>
	<body>
	    <?php 
	        /*
	        $jml_str = strlen($qw->nama);
	        if($jml_str<=21){
	            $left = "375px";
	        } else {
	            $left = "380px";
	        }
	        */
	        $left = $_GET['left'];
	    ?>
        <!--<img src="<?= base_url() ?>asset/sertifikat/sertifikat_seminar_peternakan.jpg" style="width:97%;height:auto;margin-left:15px"> for a4 -->
        <img src="<?= base_url() ?>asset/sertifikat/sertifikat_seminar_peternakan_cap.jpg" style="width:100%;height:100%">
        <div style="position:absolute;top:320px;left:<?= $left ?>px;z-index:1000;font-size:30px;font-weight:bold"><?= $qw->nama ?></div>
        <!--<div style="page-break-after:always; clear:both"></div>-->
	</body>
	</html>