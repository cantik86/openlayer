<!DOCTYPE html>
<html>
<head>
<title>MENAMPILKAN MARKER DENGAN OPENLAYERS</title>
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="openlayers-2.12/OpenLayers.js"></script>
<script type="text/javascript" src="FeaturePopups.js"></script>
<script type="text/javascript">
 window.onload = function() {
  // set layer
  var osm = new OpenLayers.Layer.OSM('OSM');

  // set icon marker
  var icon = new OpenLayers.StyleMap({
   'externalGraphic': 'unnamed.png',
   'graphicOpacity': 1.0,
   'graphicWith': 16,
   'graphicHeight': 32,
   'graphicYOffset': -32
  });

  var map = new OpenLayers.Map({
   // div element
   'div': 'map',

   // set center
   'center': new OpenLayers.LonLat(13125273.0316, -237257.9905),

   // set zoom
   'zoom': 5,

   // set layers
   'layers': [osm]
  });

  // set vector marker
  var vector_marker = new OpenLayers.Layer.Vector('Marker', {
   'styleMap': icon,
   'strategies': [new OpenLayers.Strategy.Fixed()],
   'protocol': new OpenLayers.Protocol.HTTP({
    'url': 'map.php',
    'params': {},
    'format': new OpenLayers.Format.GeoJSON()
   })
  });

  // add to layer
  map.addLayer(vector_marker);

 // add merker point
 var marker = new OpenLayers.Layer.Markers('marker');
 map.addLayer(marker);

 // create event
 var singleEventListeners = {
  'beforepopupdisplayed': function(e) {
   var sel = e.selection;
   popup(sel.feature.attributes, true);
   return false;
  }
 }

 // Create control and add some layers
 var fp_control = new OpenLayers.Control.FeaturePopups({
  'boxSelectionOptions': {},
  'popupSingleOptions': {'eventListeners': singleEventListeners},
  'layers': [[vector_marker, {'templates': {'hover': '<b>${.title}</b>', 'single': ' ', 'item': '<li>${.title}</li>'}}]]
 });
 map.addControl(fp_control);
}

function popup(json, status) {
 if (status == true) {
  $('.background-popup').fadeIn(500);
  $('.popup').fadeIn(700);
  $('.popup > .popup-heading > .popup-heading-title').html(json.title);
  $('.popup > .popup-body').html(json.lat);
  $('.popup > .popup-body').html(json.lng);
 } else if (status == false) {
  $('.background-popup, .popup').fadeOut('fast');
  $('.popup > .popup-heading > .popup-heading-title, .popup > .popup-body').html('');
 }

 }
</script>

<style type="text/css">
 * { padding: 0; margin: 0; font-family: Arial; }
 .display-none { display: none; }
 .background-popup { position: fixed; width: 100%; height: 100%; background-color: #000; opacity: 0.7; z-index: 999; }
 .popup { z-index: 9999; background-color: #FFF; position: absolute; left: 15%; right: 15%; top: 5%; bottom: 5%; }
 .popup > .popup-heading { padding: 15px; background-color: #DDD; }
 .popup > .popup-heading > .popup-heading-title { font-size: 22px; }
 .popup > .popup-heading > .close { position: absolute; right: 15px; top: 20px; font-weight: bold; cursor: pointer; }
 .popup > .popup-body { padding: 7px; font-size: 14px; }
</style>

</head>
<body>
<!-- <div id="map" style="width: 1200px; height: 600px;"></div> -->
<div class="background-popup display-none"></div>
<div class="popup display-none">
 <div class="popup-heading">
  <h3 class="popup-heading-title">Data</h3>
  <span class="close" onclick="popup({}, false)">X</span>
 </div>
 <div class="popup-body">
  Properties
 </div>
</div>

<div id="map" style="position: fixed; width: 100%; height: 100%;"></div>

</body>
</html>
