<?php


class Request
{
	$method;
	$protocol;
	$server_address; //ip address
	$client_address; 
	$path;
	$query_string;
	$body;
	

	public function __construct($method, $protocol, $serv_addr, $client_addr, $path, $query, $body)
	{
		$this->method = $method;
		$this->protocol = $protocol;
		$this->server_address = $serv_addr;
		$this->client_address = $client_addr;
		$this->path = $path;
		$this->query_string = $query;
		$this->body = $body; 
	}	

}
