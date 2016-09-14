<?php


class RequestController
{
	const VALID_METHODS = array('GET', 'POST', 'PUT', 'DELETE');
	const VALID_PROTOCOL = array('HTTP/1.0', 'HTTP/1.1', 'HTTPS/1.1', 'HTTPS/1.0');	

	public function create_request($request_info)
	{
		if(!self::is_valid_method($request_info['REQUEST_METHOD']))
		{

			return array("code" => "405", "message" => "method not allowed");
			
		}	
		if(!self::is_valid_protocol($request_info['SERVER_PROTOCOL']))
		{
			return array("code" => "505", "message" => "protocol not allowed");
			
		}
		if (!self::is_valid_remote_address($request_info['REMOTE_ADDR'])) {
			return array("code" => "401", "message" => "IP address not allowed");
		}
		
		return 'valid request';
	}
	
	public function is_valid_method($method)
	{
		if( is_null($method) || !in_array($method, self::VALID_METHODS))
			return false;
		
		return true;
	}

	public function is_valid_protocol($protocol)
	{
		if( is_null($protocol) || !in_array($protocol, self::VALID_PROTOCOL))
			return false;
		
		return true;
	}

	public function is_valid_remote_address($remote_address)
	{
		if(is_null($remote_address) || filter_var($remote_address, FILTER_VALIDATE_IP) === FALSE)
            return false;
        return true;
	}















}
