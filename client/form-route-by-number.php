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
                  <li><a href="#">Perfil</a></li>
               </ul>
            </div>
         </div>
      </nav>
      <div class="container-fluid">
         <div class="row">
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
								<a href=form-remove-user.php method="get">Remover usuário</a><br>								
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
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
               <h2 class="sub-header">Todas as linhas</h2>
               <div class="table-responsive">
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th>Linha</th>
                           <th>Ponto de Partida</th>
                           <th>Ponto Final</th>
                           <th>Tarifa</th>
                           <th>Extensao</th>
                           <th>Denominacao</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           include('httpful.phar');
                           
                           $get_request = 'http://localhost/CMO/routes/findByRouteNumber?'.$_SERVER['QUERY_STRING'];
                           
                           $response = \Httpful\Request::get($get_request)->send();
                           $arr = json_decode($response->body, true);
                           if (count($arr) <= 0){
                           	echo '<tr><td></td><td></td><td>Esta linha nao existe</td><td></td><td></td><td></td></tr>';
                           } else {
                           	foreach ($arr as $key =>$value){
                           	echo '<tr><td>'.$value['id'].'</td>'.'<td>'.$value['starting_point'].'</td>'.'<td>'.$value['ending_point'].'</td>'.'<td>'.$value['fare'].'</td>'.'<td>'.$value['extension'].'</td>'.'<td>'.$value['denomination'].'</td></tr>';	
                           	}
                           }
                           ?>
                     </tbody>
                  </table>
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
   </body>
</html>
