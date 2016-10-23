<?php
include('control/request_controller.php');

echo  "<a href=http://localhost/CMO/routes/allRoutes>Todas as linhas</a><br>
	<a href=http://localhost/CMO/routes/routeByGeolocation>Linhas por geolocalização</a><br>
	<a href=http://localhost/CMO/routes/routeByLocationName>Linhas por nome do destino</a><br>
	<a href=http://localhost/CMO/routes/findByRouteNumber>Pesquisar linha pelo número</a><br>
	<a href=http://localhost/CMO/vehicle/routeLocation>Localização atual de uma linha</a><br>
	<a href=http://localhost/CMO/vehicle/nextDeparture>Próxima partida de uma linha</a><br>
	<a href=http://localhost/CMO/user/userID>Pesquisar usuário pelo ID</a><br>
	<a href=http://localhost/CMO/user/userLocation>Pesquisar localização de um úsuario</a><br>";

$controller = new RequestController();
echo $controller->execute();


