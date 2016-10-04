<?php

include ('resource_controller.php');
include_once('request.php');

class RequestController
{
	const VALID_METHODS = array('GET', 'POST', 'PUT', 'DELETE');

	private function create_request($request_info)
	{
		if(!self::is_valid_method($request_info['REQUEST_METHOD']))
		{
			return array("code" => "405", "message" => "method not allowed");
			
		}	
		


		
		return new Request($request_info['REQUEST_METHOD'],$request_info['SERVER_PROTOCOL'],$request_info['SERVER_ADDR'],$request_info['REMOTE_ADDR'],$request_info['REQUEST_URI'],$request_info['QUERY_STRING'],file_get_contents('php://input'));
		
	}
	
	public function is_valid_method($method)
	{
		if( is_null($method) || !in_array($method, self::VALID_METHODS))
			return false;
		
		return true;
	}



	public function execute() {
		$request = self::create_request($_SERVER);
		$resource_controller = new ResourceController();
	        return $resource_controller->treat_request($request);
	}












}
