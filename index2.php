<!DOCTYPE html>
<html>
<head>
<title>SHARE LOKASI DI OPENLAYERS</title>
<script type="text/javascript" src="openlayers-2.12/openlayers.js"></script>
<script type="text/javascript">
 window.onload = function() {
  // set layer
  var osm = new OpenLayers.Layer.OSM('OSM');

  var map = new OpenLayers.Map({
   // div element
   'div': 'maps',

   // set center
   'center': new OpenLayers.LonLat(13125273.0316, -237257.9905),

   // set zoom
   'zoom': 4,
'controls': [new OpenLayers.Control.Zoom()],
   // set layers
   'layers': [osm]
  });
  var marker = new OpenLayers.Layer.Markers('marker');
  map.addLayer(marker);

  // add event ketika button di klik
  document.getElementsByTagName('button')[0].addEventListener('click', function() {
   navigator.geolocation.getCurrentPosition(function(response) {
    var pos = new OpenLayers.LonLat(response.coords.longitude, response.coords.latitude).transform(
     new OpenLayers.Projection('EPSG:4326'), map.getProjectionObject()
    );

    var size = new OpenLayers.Size(32, 32);
    var offset = new OpenLayers.Pixel(-(size.w / 2), -size.h);
    var icon = new OpenLayers.Icon('https://4.bp.blogspot.com/-XjraOOVhBpI/VuZqnqPVlrI/AAAAAAAABPQ/u6-6K7CpPhUlY9_DCO01sdqBTM-ho2BCQ/s320/merah.png', size, offset);
    marker.addMarker(new OpenLayers.Marker(pos, icon));
    map.setCenter(pos, 16);
   });
  });
 }
</script>
</head>
<body>
<div id="maps" style="width: 600px; height: 400px; background-color: #EEE"></div>
<button>SHARE LOKASI</button>
</body>
</html>
