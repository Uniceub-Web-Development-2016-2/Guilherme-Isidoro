<?php
session_start();

include('httpful.phar');
if($_POST["email"] != null && $_POST["password"] != null)
{
	$login_array = array('email' => $_POST["email"], 'password' =>$_POST["password"]);
	$url = "http://localhost/CMO/user/login";
	$body = json_encode($login_array);
	$response = \Httpful\Request::post($url)->sendsJson()->body($body)->send();   
	$arr = json_decode($response->body, true);

	if($arr != false){
 		$_SESSION["email"] = $arr["email"];
		$_SESSION["id"] = $arr["id"];
		$_SESSION["name"] = $arr["name"];
		$_SESSION["privilege"] = $arr['privilege_ID'];
		header("Location: index.html");
	}
	else
		echo "Usuário ou senha incorretos!";
}


?>
