<?php
   if($uris=="varietas"){
       $url = "Varietas";
   } else if ($uris=="budidaya") {
       $url = "Budidaya";
   } else if ($uris=="formulasipakan") {
       $url = "Formulasi Pakan";
   } else if ($uris=="analisis") {
       $url = "Analisis Usaha Tani";
   }
?>
<nav class="navbar navbar-expand-sm bg-success navbar-dark sticky-top">
  <a class="navbar-brand" href="#" style="text-transform: capitalize"><?php echo $url ?></a>
</nav>
<br>