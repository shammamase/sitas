<?php
   if($uris=="kesesuaian_lahan"){
       $url = "Kesesuaian Lahan";
   } else if ($uris=="rpl") {
       $url = "RPL";
   } else if ($uris=="peta_tanah") {
       $url = "Peta Tanah";
   } else if ($uris=="luas_lahan") {
       $url = "Luas Lahan Sawah";
   }
?>
<nav class="navbar navbar-expand-sm bg-success navbar-dark sticky-top">
  <a class="navbar-brand" href="#" style="text-transform: capitalize"><?php echo $url ?></a>
</nav>
<br>
