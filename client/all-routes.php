<?php
header('Content-Type: text/html; charset=utf-8');
include('httpful.phar');

$get_request = 'http://127.0.0.1/CMO/routes/allRoutes';

$response = \Httpful\Request::get($get_request)->send();

var_dump( $response->body );

//$body = file_get_contents('http://127.0.0.1/CMO/routes/allRoutes');
//var_dump($body);
