<?php

include('httpful.phar');


//$get_request = 'http://172.22.51.134/aula8/user/create?first_name="'.$_POST['firstName'].'"&'.'last_name="'.$_POST['lastName'].'"&'.'email="'.$_POST['email'].'"&'.'password="'.$_POST['password'].'"&'."gender='".$_POST['gender']."'&"."birthdate='".$_POST['birthdate']."'";

$json = json_encode($_POST);

$get_request = 'http://172.22.51.134/aula8/user/create';
$response = \Httpful\Request::post($get_request)
->sendsJson()
->body($json)
->send()
;

echo  $response->body;
