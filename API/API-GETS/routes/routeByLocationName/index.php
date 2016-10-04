<?php
include('request_controller.php');

$controller = new RequestController();

$dados = $controller->execute();

//var_dump($dados);

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
    echo '<br>'.'Linha: '.$item['route_number'].' Destino: '.$item['ending_point'].'<br>'; 
}

} else {
	echo '<br> Infelizmente não temos esta linha em nosso banco de dados. <br>';
}


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

