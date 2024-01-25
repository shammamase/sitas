<html> 
	<body>
	    <?php 
	        $uri3 = $this->uri->segment(3);
	        $uri5 = $this->uri->segment(5);
	        if(!empty($uri5)){
    	        $jml_str = strlen($qw->nama);
    	        if($jml_str<=21){
    	            $left = "370px";
    	        } else {
    	            $left = "375px";
    	        }
	        }
	        
	    ?>
        <?php if($uri3=="pohuwato"){ ?>
        <img src="<?= base_url() ?>asset/sertifikat/pohuwato_1.png" style="width:95%;height:auto;margin-left:30px">
        <?php } else { ?>
        <img src="<?= base_url() ?>asset/sertifikat/boalemo_1.png" style="width:95%;height:auto;margin-left:30px">
        <?php } ?>
        
        <?php if(!empty($uri5)){ ?>
        <div style="position:absolute;top:250px;left:<?= $left ?>;z-index:1000;font-size:30px;font-weight:bold"><?= $qw->nama ?></div>
        <?php } ?>
        <div style="page-break-after:always; clear:both"></div>
        
        <?php if($uri3=="pohuwato"){ ?>
        <img src="<?= base_url() ?>asset/sertifikat/pohuwato_2.png" style="width:95%;height:auto;margin-left:30px">
        <?php } else { ?>
        <img src="<?= base_url() ?>asset/sertifikat/boalemo_2.png" style="width:95%;height:auto;margin-left:30px">
        <?php } ?>
	</body>
	</html>