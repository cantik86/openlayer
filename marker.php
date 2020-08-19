<?php
 // data marker
 $markers = array(
  array(
   'id'=>1,
   'title'=>'Marker 1',
   'desc'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
   'lat'=>'-7.644871999999999',
   'lng'=>'112.90329700000007'
  ),
  array(
   'id'=>2,
   'title'=>'Marker 2',
   'desc'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
   'lat'=>'-6.188597',
   'lng'=>'106.58851700000002'
  ),
  array(
   'id'=>3,
   'title'=>'Marker 3',
   'desc'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
   'lat'=>'-7.981894',
   'lng'=>'112.62650299999996'
  ),
  array(
   'id'=>4,
   'title'=>'Marker 4',
   'desc'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
   'lat'=>'-6.202251',
   'lng'=>'107.001587'
  )
 );

 // set response
 $response = array(
  'type'=>'FeatureCollection',
  'features'=>array()
 );

 // loop marker
 foreach ($markers as $key=>$val) {
  $id = (int) $val['id'];
  $title = $val['title'];
  $desc = $val['desc'];
  $lat = $val['lat'];
  $lng = $val['lng'];

  // set properties
  $properties = array(
   'id'=>$id,
   'title'=>$title,
   'desc'=>$desc,
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
