<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "openlayer";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
$ambil_peta=mysql_query("select *from koordinat");
while ($data_peta=mysql_fetch_array($ambil_peta)){
    $title = $data_peta['title'];
    $lat = $data_peta['lat'];
    $lng = $data_peta['lng'];
$markers = array( 
    array(
    'title'=>"$title",
    'lat'=>"$lat",
    'lng'=>"$lng",
    ),
);    
}
 // data marker
 // $markers = array(
 //  array(
 //   'title'=>'Marker 1',
 //   'lat'=>'-7.644871999999999',
 //   'lng'=>'112.90329700000007'
 //  ),
 //  array(
 //   'title'=>'Marker 2',
 //   'lat'=>'-6.188597',
 //   'lng'=>'106.58851700000002'
 //  ),
 //  array(
 //   'title'=>'Marker 3',
 //   'lat'=>'-7.981894',
 //   'lng'=>'112.62650299999996'
 //  ),
 //  array(
 //   'title'=>'Marker 4',
 //   'lat'=>'-6.202251',
 //   'lng'=>'107.001587'
 //  ),
 // );

 // set response
 $response = array(
  'type'=>'FeatureCollection',
  'features'=>array()
 );

 // loop marker
 foreach ($markers as $key=>$val) {
  $title = $val['title'];
  $lat = $val['lat'];
  $lng = $val['lng'];

  // set properties
  $properties = array(
   'title'=>$title,
   'lat'=>$lat,
   'lng'=>$lng,
  );

  // push data to features
  array_push($response['features'], array(
   'type'=>'Feature',
   'geometry'=>array(
    'type'=>'Point',
    'coordinates'=>array($lng, $lat)
   ),
   'properties'=>$properties
  ));
 }

 // set response JSON
 header('Content-Type: application/json');
 echo json_encode($response);
