<?php

include_once ('../CMO/model/request.php');
include_once ('db_manager.php');

class ResourceController
{	
 	private $METHODMAP = ['GET' => 'search' , 'POST' => 'create' , 'PUT' => 'update', 'DELETE' => 'remove' ];
	
	public function treat_request($request) {
		return $this->{$this->METHODMAP[$request->getMethod()]}($request);
	
	}

	private function search($request) {
	
		$query = 'SELECT * FROM '.$request->getResource().' WHERE '.self::queryParams($request->getParameters());
		
		return self::select($query);
		
	}
	
	private function select($query) {
		$conn = (new DBConnector())->query($query);
		var_dump($query);
		return $conn->fetchAll();
		
	}

	private function update($request) {
               $body = $request->getBody();
               $resource = $request->getResource();
               $query = 'UPDATE '.$resource.' SET '. $this->getUpdateCriteria($body);
               //var_dump($query);
	//die();
		return self::execution_query($query);
        }

	private function create($request) {		
		$body = $request->getBody();
		//var_dump($body);
		$resource = $request->getResource();		
		$query = 'INSERT INTO '.$resource.' ('.$this->getColumns($body).') VALUES ('.$this->getValues($body).')';
		return self::execution_query($query);
		 
	}
		
	private function queryParams($params) {
		
		$query = "";		
		foreach($params as $key => $value) {
			$query .= $key.' = '."'".$value."'".' AND ';	
		}
		$query = substr($query,0,-5);
		if ($query == null) {
			$query.=1;		
		} 
		return $query;
	}

	private function execution_query($query) {
		$conn = (new DBConnector());
		$conn->query($query);
		echo ($query);
	}
		
	private function getUpdateCriteria($json)
	{
		$criteria = "";
		$where = " WHERE ";
		$array = json_decode($json, true);
		foreach($array as $key => $value) {
			if($key != 'id')
				$criteria .= $key." = '".$value."',";
			
		}
		return substr($criteria, 0, -1).$where." id = '".$array['id']."'";
	}
	
	private function getColumns($json) 
	{
		$array = json_decode($json, true);
		$keys = array_keys($array);
		return implode(",", $keys);
	
	}

	private function getValues($json)
        {
                $array = json_decode($json, true);
                $values = array_values($array);
                $string = implode("','", $values);
		return "'".$string."'";
        
        }

	
}
