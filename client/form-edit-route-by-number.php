<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="favicon.ico">
		<title>Cadê Meu ônibus?</title>
		<!-- Bootstrap core CSS -->
		<link href="dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="dashboard.css" rel="stylesheet">
		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="assets/js/ie-emulation-modes-warning.js"></script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body onload=getInputValue()>
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
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
					<img src="assets/img/onibus.jpg" class="img-thumbnail">
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
				<?php
					include('httpful.phar');
					
					$get_request = 'http://localhost/CMO/routes/findByRouteNumber?id='.$_GET['id'];
					
					$response = \Httpful\Request::get($get_request)->send();
					$arr = json_decode($response->body, true);
					$redirect = '';
					if (array_key_exists('redirect', $_GET)) {
					$redirect = $_GET['redirect'];
					}
					if (count($arr) <= 0){
						echo "<script> alert('Esta linha não existe');</script>";
						$redirect = 'false';
						die();
					} else if (array_key_exists('redirect', $_GET) && $redirect === 'true'){
					$addmore = explode(";", $arr[0]['schedule']);
					
					$arr[0]['addmore'] = $addmore;
					
					unset($arr[0]['schedule']);
					
					header('Location: http://localhost/client/form-edit-route-by-number.php?'.http_build_query($arr[0]));
					}                           
				?>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<h2 class="sub-header">Cadastrar nova Linha</h2>
					<form action="form-update-route.php" method="post">
						<div class="form-group">
							<label for="numLinha">Número da Linha</label>
							<input type="text" name="id" class="form-control" id="id" required maxlength=5><br>
						</div>
						<div class="form-group">
							<label for="pontoPartida">Ponto de Partida</label>
							<input type="text" name="starting_point" id ="starting_point" required class="form-control"><br>
						</div>
						<div class="form-group">
							<label for="pontoFinal">Ponto Final</label>
							<input type="text" name="ending_point" id="ending_point" required class="form-control"><br>
						</div>
						<div class="form-group">
							<label for="tarifa">Tarifa</label>
							<input type="text" name="fare" required id="fare" class="form-control"><br>
						</div>
						<div class="form-group">
							<label for="extensao">Extensão do Percurso</label>
							<input type="text" name="extension" required id="extension" class="form-control"><br>
						</div>
						<div class="form-group">
							<label for="denominacao">Denominação</label>
							<input type="text" name="denomination" required id="denomination" class="form-control"><br>
						</div>
						<div class="form-group">
							<label for="idempresa">ID da empresa</label>
							<select class="form-control" id="company_ID" name="company_ID">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							</select>
						</div>
						<div class="form-group">
							<label for="idcidade">ID da cidade</label>
							<select class="form-control" id="city_ID" name="city_ID">
								<option>1</option>
							</select>
						</div>
						<button type="submit" class="btn btn-primary" align="center">Salvar</button>
				</div>
				</form>
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
			function getInputValue() {
				  var assoc  = {};
				  var decode = function (s) { return decodeURIComponent(s.replace(/\+/g, " ")); };
				  var queryString = location.search.substring(1); 
				  var keyValues = queryString.split('&'); 
			
				  for(var i in keyValues) { 
				    var key = keyValues[i].split('=');
				    if (key.length > 1) {
				      assoc[decode(key[0])] = decode(key[1]);
				    }
				  } 
			
			
				for (var key in assoc) {
			 if (key === 'length' || !assoc.hasOwnProperty(key)) continue;
			 var value = assoc[key];
			document.getElementById(key).value = value;
			}			
			}
			
			function removeSpaces(string) {
				return string.split(' ').join('').toUpperCase();;
			}
			
			$(document).ready(function() {
			
			   $(".add-more").click(function(){ 
			       var html = $(".copy").html();
			       $(".after-add-more").after(html);
			   });
			
			   $("body").on("click",".remove",function(){ 
			       $(this).parents(".control-group").remove();
			   });
			
			 });
			
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
			});		
		</script>
		<style>
			.entry:not(:first-of-type)
			{
			margin-top: 10px;
			}
			.glyphicon
			{
			font-size: 12px;
			}
		</style>
	</body>
</html>
