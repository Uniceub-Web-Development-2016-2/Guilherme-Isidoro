<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta name="author" content="">
		<link rel="icon" href="favicon.ico">
		<title>Cadê Meu ônibus?</title>
		<!-- Bootstrap core CSS -->
		<link href="dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="dashboard.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="assets/js/ie-emulation-modes-warning.js"></script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style>
			/* Always set the map height explicitly to define the size of the div
			* element that contains the map. */
			#map {
			height: 100%;
			}
			/* Optional: Makes the sample page fill the window. */
			html, body {
			height: 100%;
			margin: 0;
			padding: 0;
			}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Cadê Meu ônibus</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="login.html">Login</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container-fluid">
			<div class="row2">
				<div class="col-sm-3 col-md-2 sidebar">
					<img src="assets/img/onibus.jpg" style="border-radius: 25px;">
					<br>
					<br>
					<div id="accordion">
						<div class=".ui-accordion-header">
							<h3>Buscar Linhas</h3>
							<div>				
								<a href=all-routes.php method="get" type="button" class="btn-group">Todas as linhas</a><br>
								<a href=form-location.html method="get">Por geolocalização</a><br>
								<a href=form-start-end-point.html method="get">Por nome do destino</a><br>
								<a href=form-route-by-number.html method="get">Por número</a><br>
								<a href=form-route-time-estimate.html method="get">Estimativa de tempo</a><br>
								<a href=form-next-departure.html method="get">Próxima partida</a><br>
							</div>
						</div>
						<div class="group">
							<h3>Gerenciar Linha</h3>
							<div>
								<a href=form-new-route.html method="get">Criar nova linha</a><br>
								<a href=form-edit-route.php method="get">Editar linha</a><br>
								<a href=form-remove-route.php method="get">Remover linha</a><br>
							</div>
						</div>
						<div class="group">
							<h3>Gerenciar Usuário</h3>
							<div>
								<a href=form-new-user.html method="get">Criar novo usuário</a><br>
								<a href=form-edit-user.php method="get">Editar usuário</a><br>
								<a href=form-remove-user.html method="get">Remover usuário</a><br>								
							</div>
						</div>
						<div class="group">
							<h3>Rastrear</h3>
							<div>
								<a href=form-track-route.html method="get">Rastrear uma Linha</a><br>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-9 main">
					<h2 class="sub-header">Todas as linhas</h2>
					<div class="col-md-6" id="map" style="width:600px; height:500px"></div>
					<div class="col-md-3">
						<?php
							include('httpful.phar');
							$get_request = 'http://localhost/CMO/routes/routeEstimate?'.$_GET['id'];
							$userLatitude = $_GET['latitude'];
							$userLongitude = $_GET['longitude'];
							
							$response = \Httpful\Request::get($get_request)->send();
							
							$response->body;
							
							$arr = json_decode($response->body, true);
							
							$latitude = $arr[0]['latitude'];
							$longitude = $arr[0]['longitude'];
							$get_request = 'https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$userLatitude.','.$userLongitude.'&destinations='.$latitude.','.$longitude.'&key=AIzaSyBqrrE8Ty-fxu6XOcCYBkfDxIfNemYc1n0';
							
							$googleResponse = \Httpful\Request::get($get_request)->send();
							$travel = json_decode($googleResponse, true);



							if (empty($userLatitude)) {
								echo "Seu browser não permite o compartilhamento de suas coordenadas. Serviço indisponível.";
							} else {
							if ($travel['status'] == 'INVALID_REQUEST') {
								echo "Seu browser não permite o compartilhamento da sua localização ou você está muito distante.";
							} else if ($travel['status'] == 'OK'){
								echo '<label for="next">Distância: </label>'.($travel['rows'][0]['elements']['0']['distance']['text'].'<br><br>');
								echo '<label for="next">Tempo de chegada: </label>'.($travel['rows'][0]['elements']['0']['duration']['text'].'<br><br>');
								echo 'Valores cedidos pela Google';
							} else {
								echo "Ocorreu um erro";
								}
							}
							?>
					</div>
				</div>
			</div>
		</div>
		<!-- Bootstrap core JavaScript
			================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
		<script src="dist/js/bootstrap.min.js"></script>
		<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
		<script src="assets/js/vendor/holder.min.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
		<link rel="stylesheet" href="assets/css/jquery-ui.css">
		<script src="assets/css/jquery-1.12.4.js"></script>
		<script src="assets/css/jquery-ui.js"></script>
		<script>
		function initMap() {
								var map = new google.maps.Map(document.getElementById('map'), {
								  center: {lat: -34.397, lng: 150.644},
								  zoom: 15
								});
								var infoWindow = new google.maps.InfoWindow({map: map});

								// Try HTML5 geolocation.
								if (navigator.geolocation) {
								  navigator.geolocation.getCurrentPosition(function(position) {
									var pos = {
									  lat: position.coords.latitude,
									  lng: position.coords.longitude
									};

									infoWindow.setPosition(pos);
									infoWindow.setContent('Você está aqui');
									map.setCenter(pos);
								  }, function() {
									handleLocationError(true, infoWindow, map.getCenter());
								  });
								} else {
								  // Browser doesn't support Geolocation
								  handleLocationError(false, infoWindow, map.getCenter());
								}
							  }

							  function handleLocationError(browserHasGeolocation, infoWindow, pos) {
								infoWindow.setPosition(pos);
								infoWindow.setContent(browserHasGeolocation ?
													  'Error: The Geolocation service failed.' :
													  'Error: Your browser doesn\'t support geolocation.');
							  }
				


		$(function() {
		$("#accordion")
		.accordion({
		header: "> div > h3",
		collapsible: true
		}).click(function(event, ui) {
		//alert(jQuery("#accordion").accordion('option', 'active'));
		})
		});	  
		$('.btn-block').click(function(e){
		e.preventDefault(); //To prevent the default anchor tag behaviour		
		var url = "all-routes.php";		
		$(".col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main").load(url);
		})		
		</script>
		<script async defer
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqrrE8Ty-fxu6XOcCYBkfDxIfNemYc1n0&callback=initMap">
		</script>
		
		</body>
		</html>
