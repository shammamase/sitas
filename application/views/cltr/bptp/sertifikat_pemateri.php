<html> 
	<body>
	    <?php 
	        $uri3 = $this->uri->segment(3);
	        $uri5 = $this->uri->segment(5);
	        if(!empty($uri5)){
    	        $jml_str = strlen($qw->nama);
    	        if($jml_str>=0 and $jml_str<=18){
    	            $left = "410px";
    	        } else if($jml_str>=19 and $jml_str<=22) {
    	            $left = "375px";
    	        } else if($jml_str>=23 and $jml_str<=26) {
    	            $left = "365px";
    	        }
	        }
	        
	    ?>
        <?php if($uri3=="pohuwato"){ ?>
        <img src="<?= base_url() ?>asset/sertifikat/pemateri_pohuwato.png" style="width:95%;height:auto;margin-left:30px">
        <?php } else { ?>
        <img src="<?= base_url() ?>asset/sertifikat/pemateri_boalemo.png" style="width:95%;height:auto;margin-left:30px">
        <?php } ?>
        
        <?php if(!empty($uri5)){ ?>
        <div style="position:absolute;top:250px;left:<?= $left ?>;z-index:1000;font-size:30px;font-weight:bold"><?= $qw->nama ?></div>
        <?php } ?>
	</body>
	</html>