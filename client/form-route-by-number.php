<?php

include('httpful.phar');

$get_request = 'http://127.0.0.1/CMO/routes/findByRouteNumber?'.$_SERVER['QUERY_STRING'];

$response = \Httpful\Request::get($get_request)->send();

//var_dump($response);
echo  $response->body;

