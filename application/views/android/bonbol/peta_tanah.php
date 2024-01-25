<style>
#map {
 margin-top:-30px;
 height: 95vh;
 width: 100%;
 overflow: hidden;
 border: thin solid #333;
 }
</style>
    
<nav class="navbar navbar-expand-sm bg-success navbar-dark sticky-top">
  <a class="navbar-brand" href="#" style="text-transform: capitalize"><?php echo $uris ?></a>
</nav>
<br>
<div id="map"></div>
<script>
var map;
var src = 'http://new.gorontalo.litbang.pertanian.go.id/web/asset/Tanah_50000.kml';

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: new google.maps.LatLng(0.5562274, 123.0142405),
    zoom: 8,
    mapTypeId: 'terrain'
  });

  var kmlLayer = new google.maps.KmlLayer(src, {
    map: map
  });
}
</script>
<!-- Replace the value of the key parameter with your own API key. -->
<script async
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmgSE6jGSNWKPStr0gWIr3M0qQDxq8YGQ&callback=initMap">
</script>