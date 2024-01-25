<?php
   $get_uri = $this->db->query("select * from t_jenis_teknologi where id_tek = $uris");
   $roww = $get_uri->row();
?>
<nav class="navbar navbar-expand-sm bg-success navbar-dark sticky-top">
  <a class="navbar-brand" href="#" style="text-transform: capitalize"><?php echo $roww->jenis_teknologi ?></a>
</nav>
<br>
<div class="container">
<div class="card">
  <div class="card-body">
     <img class="img-fluid" src="<?php echo base_url() ?>asset/foto_content/<?php echo $roww->img_jenis_teknologi ?>">
  </div>
</div>
<p style="text-align:justify">
    <?php echo $roww->deskripsi ?>
</p>
</div>