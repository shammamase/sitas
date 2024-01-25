<?php
   if($uris=="varietas"){
       $url = "Varietas";
?>
<nav class="navbar navbar-expand-sm bg-success navbar-dark sticky-top">
  <a class="navbar-brand" href="#" style="text-transform: capitalize"><?php echo $url ?></a>
</nav>
<br>
<div class="container">

<?php
    $get_varietas_padi = $this->db->query("select a.*,c.nama_lengkap
                                          from cltr_post a
                                          inner join cltr_page b on a.id_page=b.id_page
                                          inner join users c on a.username=c.username
                                          where b.id_page = 26");
?>
<div id="accordion">
    <?php
        $nor = 1;
        foreach($get_varietas_padi->result() as $gvp){
            if($nor==1){
                $sh = "show";
            } else {
                $sh = "";
            }
    ?>
    <div class="card">
      <div class="card-header bg-success">
        <a class="card-link text-white" data-toggle="collapse" href="#collapse<?php echo $nor ?>">
          <?php echo $gvp->judul ?>
        </a>
      </div>
      <div id="collapse<?php echo $nor ?>" class="collapse <?php echo $sh ?>" data-parent="#accordion">
        <div class="card-body">
          <img class="img-fluid" src="<?php echo base_url() ?>asset/foto_content/<?php echo $gvp->gambar ?>">
          <?php echo $gvp->isi_berita ?>
          <b>Penulis : <?php echo $gvp->nama_lengkap ?></b>
        </div>
      </div>
    </div>
    <?php
    $nor++;
        }
    ?>
</div>
</div>
<?php
   } else if ($uris=="budidaya") {
       $url = "Budidaya";
?>
<nav class="navbar navbar-expand-sm bg-success navbar-dark sticky-top">
  <a class="navbar-brand" href="#" style="text-transform: capitalize"><?php echo $url ?></a>
</nav>
<br>
<div class="container">

<?php
    $get_varietas_padi = $this->db->query("select a.*,c.nama_lengkap
                                          from cltr_post a
                                          inner join cltr_page b on a.id_page=b.id_page
                                          inner join users c on a.username=c.username
                                          where b.id_page = 25");
?>
<div id="accordion">
    <?php
        $nor = 1;
        foreach($get_varietas_padi->result() as $gvp){
            if($nor==1){
                $sh = "show";
            } else {
                $sh = "";
            }
    ?>
    <div class="card">
      <div class="card-header bg-success">
        <a class="card-link text-white" data-toggle="collapse" href="#collapse<?php echo $nor ?>">
          <?php echo $gvp->judul ?>
        </a>
      </div>
      <div id="collapse<?php echo $nor ?>" class="collapse <?php echo $sh ?>" data-parent="#accordion">
        <div class="card-body">
          <img class="img-fluid" src="<?php echo base_url() ?>asset/foto_content/<?php echo $gvp->gambar ?>">
          <?php echo $gvp->isi_berita ?>
          <b>Penulis : <?php echo $gvp->nama_lengkap ?></b>
        </div>
      </div>
    </div>
    <?php
    $nor++;
        }
    ?>
</div>
</div>
<?php
   } else if ($uris=="hitungpupuk") {
       $url = "Hitung Pupuk";
?>
<nav class="navbar navbar-expand-sm bg-success navbar-dark sticky-top">
  <a class="navbar-brand" href="#" style="text-transform: capitalize"><?php echo $url ?></a>
</nav>
<br>
<?php
   } else if ($uris=="analisis") {
       $url = "Analisis Usaha Tani";
?>
<nav class="navbar navbar-expand-sm bg-success navbar-dark sticky-top">
  <a class="navbar-brand" href="#" style="text-transform: capitalize"><?php echo $url ?></a>
</nav>
<br>
<?php
   }
?>