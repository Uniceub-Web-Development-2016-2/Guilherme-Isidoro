<?php

include('httpful.phar');


//$get_request = 'http://127.0.0.1/CMO/user/search?first_name="'.$_GET['search'].'"';
$get_request = 'http://127.0.0.1/CMO/routes/allRoutes';
$get_request = '';

$response = \Httpful\Request::get($get_request)->send();

echo  $response->body;


/*
echo  "<a href=http://localhost/CMO/routes/allRoutes>Todas as linhas</a><br>
	<a href=http://localhost/CMO/routes/routeByGeolocation>Linhas por geolocalização</a><br>
	<a href=http://localhost/CMO/routes/routeByLocationName>Linhas por nome do destino</a><br>
	<a href=http://localhost/CMO/routes/findByRouteNumber>Pesquisar linha pelo número</a><br>
	<a href=http://localhost/CMO/vehicle/routeLocation>Localização atual de uma linha</a><br>
	<a href=http://localhost/CMO/vehicle/nextDeparture>Próxima partida de uma linha</a><br>
	<a href=http://localhost/CMO/user/userID>Pesquisar usuário pelo ID</a><br>
	<a href=http://localhost/CMO/user/userLocation>Pesquisar localização de um úsuario</a><br>";
*/

