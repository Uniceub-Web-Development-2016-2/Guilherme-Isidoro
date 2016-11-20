<?php

include('httpful.phar');

$get_request = 'http://127.0.0.1/CMO/routes/routeEstimate?'.'id='.$_GET['id'];

$response = \Httpful\Request::get($get_request)->send();

echo  $response->body;

