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
    $get_varietas_buah = $this->db->query("select a.*,c.nama_lengkap
                                          from cltr_post a
                                          inner join cltr_page b on a.id_page=b.id_page
                                          inner join users c on a.username=c.username
                                          where b.id_page = 29");
?>
<div id="accordion">
    <?php
        $nor = 1;
        foreach($get_varietas_buah->result() as $gvb){
            if($nor==1){
                $sh = "show";
            } else {
                $sh = "";
            }
    ?>
    <div class="card">
      <div class="card-header bg-success">
        <a class="card-link text-white" data-toggle="collapse" href="#collapse<?php echo $nor ?>">
          <?php echo $gvb->judul ?>
        </a>
      </div>
      <div id="collapse<?php echo $nor ?>" class="collapse <?php echo $sh ?>" data-parent="#accordion">
        <div class="card-body">
          <img class="img-fluid" src="<?php echo base_url() ?>asset/foto_content/<?php echo $gvb->gambar ?>">
          <?php echo $gvb->isi_berita ?>
          <b>Penulis : <?php echo $gvb->nama_lengkap ?></b>
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
    $get_varietas_buah = $this->db->query("select a.*,c.nama_lengkap
                                          from cltr_post a
                                          inner join cltr_page b on a.id_page=b.id_page
                                          inner join users c on a.username=c.username
                                          where b.id_page = 31");
?>
<div id="accordion">
    <?php
        $nor = 1;
        foreach($get_varietas_buah->result() as $gvb){
            if($nor==1){
                $sh = "show";
            } else {
                $sh = "";
            }
    ?>
    <div class="card">
      <div class="card-header bg-success">
        <a class="card-link text-white" data-toggle="collapse" href="#collapse<?php echo $nor ?>">
          <?php echo $gvb->judul ?>
        </a>
      </div>
      <div id="collapse<?php echo $nor ?>" class="collapse <?php echo $sh ?>" data-parent="#accordion">
        <div class="card-body">
          <img class="img-fluid" src="<?php echo base_url() ?>asset/foto_content/<?php echo $gvb->gambar ?>">
          <?php echo $gvb->isi_berita ?>
          <b>Penulis : <?php echo $gvb->nama_lengkap ?></b>
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