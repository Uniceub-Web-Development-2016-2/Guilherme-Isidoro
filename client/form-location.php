<?php

include('httpful.phar');

$get_request = 'http://localhost/CMO/routes/allRoutes';

$response = \Httpful\Request::get($get_request)->send();

echo  $response->body;


