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
    echo '<br> Linha: '.$item['route_number'].' Ponto de partida: '.$item['ending_point'].' Destino: '.$item['ending_point'].'<br>'; 
}
} else {
	echo '<br> Infelizmente não temos esta linha em nosso banco de dados. <br>';
}



