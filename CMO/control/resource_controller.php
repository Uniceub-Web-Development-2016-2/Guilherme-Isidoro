<?php

include_once ('../CMO/model/request.php');
include_once ('db_manager.php');

class ResourceController
{	
 	private $METHODMAP = ['GET' => 'search' , 'POST' => 'create' , 'PUT' => 'update', 'DELETE' => 'remove' ];
	
	public function treat_request($request) {
		if ($request->getResource2() == 'routeEstimate') {
			return self::getLatLon($request);
		} else if ($request->getResource2() == 'routeByLocationName') {   //Melhorar busca de métodos
			return self::get_route_by_name($request);
		} else if ($request->getResource2() == 'login') {
			return self::login($request);
		}
		return $this->{$this->METHODMAP[$request->getMethod()]}($request);	
	}


	private function login ($request) {
		/*
		$inputEmail = json_decode($request->getBody(), true)['email'];
		$inputPassword = json_decode($request->getBody(), true)['password'];
		$searchEncryptPass = "SELECT password FROM user WHERE email = '".$inputEmail."'";
		$encryptPass = self::select($searchEncryptPass)[0]['password'];
		//echo crypt($inputPassword,$encryptPass);
		//echo password_verify($inputPassword, $encryptPass);
		echo 'senha entrada: '.$inputPassword.' senha cript: '.$encryptPass.' comparação: '.crypt($inputPassword,$encryptPass);
		if (crypt($inputPassword, $encryptPass) == $encryptPass) {
			//Senha certa
		} else {
			//senha errada
		}
		*/
		$inputEmail = json_decode($request->getBody(), true)['email'];
		$inputPassword = json_decode($request->getBody(), true)['password'];
		$searchPass = "SELECT * FROM user WHERE email = '".$inputEmail."'";
		$user = self::select($searchPass)[0];
		$pass = self::select($searchPass)[0]['password'];
		
		if ($pass == $inputPassword) {
			return $user;
		} else 
			echo 'entrei';
			return false;

	}

	private function search($request) {
	
		$query = 'SELECT * FROM '.$request->getResource().' WHERE '.self::queryParams($request->getParameters()).' AND status = 1';
		return self::select($query);
		
	}

	private function get_route_by_name ($request) {
		$query = 'SELECT * FROM routes r WHERE r.starting_point like "%'.$request->getParameters()['starting_point'].'%" and r.ending_point like"%'.$request->getParameters()['ending_point'].'%"';
		return self::select($query);
	}

	private function getLatLon($request){		
		$params = str_replace('_', '.', self::queryParams($request->getParameters()));
		$query = 'SELECT r.latitude, r.longitude FROM routes r WHERE r.id = '.substr($params, 0, -5);
		
		return self::select($query);
	}
	
	private function select($query) {
	/*		
		$conn = (new DBConnector())->query($query);
		$results = $conn->fetchAll(PDO::FETCH_ASSOC);
		$json=json_encode($results, JSON_UNESCAPED_UNICODE);
		return $json;		
	*/
		
		$conn = (new DBConnector())->query($query);
		
		return $conn->fetchAll(PDO::FETCH_ASSOC);
		
	}

	private function update($request) {
               $body = $request->getBody();
               $resource = $request->getResource();
               $query = 'UPDATE '.$resource.' SET '. $this->getUpdateCriteria($body);
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
		//echo ($query);
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

	private function bodyParams($json) {
		$criteria = "";
                $array = json_decode($json, true);
                foreach($array as $key => $value) {
                                $criteria .= $key." = '".$value."' AND ";
                 
                }
                return substr($criteria, 0, -5);
	
		
	}

	
}
