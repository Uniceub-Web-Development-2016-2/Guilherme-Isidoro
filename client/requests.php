<?php

include('httpful.phar');

//$get_request = 'http://127.0.0.1/CMO/user/search?first_name="'.$_GET['search'].'"';

echo $_SERVER['REQUEST_URI'];

$get_request = 'http://127.0.0.1/CMO/search/routes/allRoutes/';

$response = \Httpful\Request::get($get_request)->send();


echo  $response->body;




