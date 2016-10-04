<!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
  </head>
<script>
function ajaxFunction(){
	
               var ajaxRequest;  // The variable that makes Ajax possible!               
               var lat;               
               // Create a function that will receive data 
               // sent from the server and will update
               // div section in the same page.
					
               ajaxRequest.onreadystatechange = function(){
                  if(ajaxRequest.readyState == 4){
			if (navigator.geolocation) {	
        		navigator.geolocation.getCurrentPosition(function(position) {
			lat = position.coords.latitude;
			var lng = position.coords.longitude;			
			});	
    			}                     
                  }
               }
               
               // Now get the value from user and pass it to
               // server script.
					
                              
            
               queryString +=  "&lat=" + lat;
               ajaxRequest.open("GET", "index.php", true);
               ajaxRequest.send(null); 
            }


function getLocation() {
var lat;
if (navigator.geolocation) {	
        navigator.geolocation.getCurrentPosition(function(position) {
	lat = position.coords.latitude;
	var lng = position.coords.longitude;
			
	});	
    }	
}
</script>

    
<?php
include('request_controller.php');

$controller = new RequestController();

$dados = $controller->execute();

$arr = utf8_converter($dados);



function utf8_converter($array)
{
    array_walk_recursive($array, function(&$item, $key){
        if(!mb_detect_encoding($item, 'utf-8', true)){
                $item = utf8_encode($item);
        }
    });
 
    return $array;
}

if (count($arr) > 0) {
foreach($arr as $item) { 
    echo '<br> Latitude: '.$item['latitude'].' Longitude: '.$item['longitude'].'<br>'; 
}
} else {
	echo '<br> Não é possível localizar este usuário <br>';
}
echo "<script>ajaxFunction()</script>";

echo $_GET['lat'];

switch (json_last_error()) {
        case JSON_ERROR_NONE:
            echo ' - No errors';
        break;
        case JSON_ERROR_DEPTH:
            echo ' - Maximum stack depth exceeded';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            echo ' - Underflow or the modes mismatch';
        break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Unexpected control character found';
        break;
        case JSON_ERROR_SYNTAX:
            echo ' - Syntax error, malformed JSON';
        break;
        case JSON_ERROR_UTF8:
            echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
        break;
        default:
            echo ' - Unknown error';
        break;
    }


