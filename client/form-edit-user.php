<?php
session_start();
?>
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
					
					$get_request = 'http://localhost/CMO/user/userID?id='.$_SESSION['id'];
					$response = \Httpful\Request::get($get_request)->send();
					$arr = json_decode($response->body, true);
					
					if (empty($_SESSION['name'])) {
    						echo 'Você não está logado';
					}else {
					$name = $arr[0]['name'];
					$email = $arr[0]['email'];
					$city_ID = $arr[0]['city_ID'];
					}
					                           
	    ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
               <h2 class="sub-header">Editar usuário</h2>
               <form action="form-new-user.php" method="put">
                  <div class="form-group">
                     <label for="name">Nome</label>
                     <input type="text" name="name" value="<?php echo $name ?>" required class="form-control"><br>
                  </div>
                  <div class="form-group">
                     <label for="email">Email</label>
                     <input type="email" name="email" value="<?php echo $email ?>" placeholder="Email" required class="form-control"><br>
                  </div>
                  <div class="form-group">
                     <label for="pontoFinal">Senha</label>
                     <input type="password" name="password" placeholder="Senha" required class="form-control"><br>
                  </div>
                  <div class="form-group">
                     <label for="idcidade">ID da cidade</label>
                     <select class="form-control" value="<?php echo $city_ID ?>" name="city_ID">
                        <option>1</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="idcidade">Linhas Favoritas</label>
                     <div class="input-group control-group after-add-more">
                        <div class="input-group-btn"> 
                           <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Nova</button>
                        </div>
                     </div>
                     <div class="copy hide">
                        <div class="control-group input-group" style="margin-top:10px">
                           <input type="text" name="addmore[]" class="form-control" placeholder="Número da linha">
                           <div class="input-group-btn"> 
                              <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remover</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <button type="submit" class="btn btn-primary" align="center">Criar</button>
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
