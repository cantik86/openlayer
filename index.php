<!DOCTYPE html>
<html>
<head>
<title>MENAMPILKAN PETA OSM</title>
<script type="text/javascript" src="openlayers-2.12/OpenLayers.js"></script>
<script type="text/javascript">

// var map = new OpenLayers.Map('map', { controls: [] });

// map.addControl(new OpenLayers.Control.PanZoomBar());
// map.addControl(new OpenLayers.Control.LayerSwitcher({'ascending':false}));
// map.addControl(new OpenLayers.Control.Permalink());
// map.addControl(new OpenLayers.Control.Permalink('permalink'));
// map.addControl(new OpenLayers.Control.MousePosition());
// map.addControl(new OpenLayers.Control.OverviewMap());
// map.addControl(new OpenLayers.Control.KeyboardDefaults());


 window.onload = function() {
  // layer OSM
  var osm = new OpenLayers.Layer.OSM('Map OSM');

  var map = new OpenLayers.Map({
   // div element
   'div': 'map',

   // set center Longitude dan Langitude
   'center': new OpenLayers.LonLat(13125273.0316, -237257.9905),
//   controls: defaultControls().extend([mousePositionControl]),
//  'controls': [new OpenLayers.Control.MousePosition()],
   // set zoom peta
   'zoom': 5,

   // set layer
   'layers': [osm]
  });



 }
    </script>
</head>
<body>
<div id="map" style="width: 800px; height: 400px;"></div>
</body>
</html>
