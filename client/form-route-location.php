<?php

include('httpful.phar');

//$get_request = 'http://127.0.0.1/CMO/routes/routeByGeolocation?'.$_SERVER['QUERY_STRING'];
$get_request = 'http://localhost/CMO/routes/routeByGeolocation?'.$_GET['id'];
$userLatitude = $_GET['latitude'];
$userLongitude = $_GET['longitude'];

$response = \Httpful\Request::get($get_request)->send();

echo 'resposta serv: '.$response->body;

$arr = json_decode($response->body, true);

$latitude = $arr[0]['latitude'];
$longitude = $arr[0]['longitude'];

echo 'asasasas'.$latitude;

$get_request = 'https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$userLatitude.','.$userLongitude.'&destinations='.$latitude.','.$longitude.'&key=AIzaSyBqrrE8Ty-fxu6XOcCYBkfDxIfNemYc1n0';

$googleResponse = \Httpful\Request::get($get_request)->send();

echo $googleResponse;



