<?php
	class Request{
		
		private $Method;
		private $Protocol;
		private $IP;
		private $remote_IP;
		private $Resource;
		private $Parameters;
		
		public function __construct($method, $protocol, $ip, $remote_ip, $resource, $parameters){
			$this->Method = $method;
			$this->Protocol = $protocol;
			$this->IP = $ip;
			$this->remote_IP = $remote_ip;
			$this->Resource = $resource;
			$this->Parameters = $parameters;
		}
		public function getProtocol(){
			return $this->Protocol;
		}
		public function getMethod(){
			return $this->Method;
		}
		public function getIP(){
			return $this->IP;
		}
		public function getremote_IP(){
			return $this->remote_IP;
		}
		public function getResource(){
			return $this->Resource;
		}
		public function getParameters(){
			return $this->Parameters;
		}
		public function setProtocol($protocol){
			$this->Protocol = $protocol;
		}
		public function setMethod($method){
			$this->Method = $method;
		}
		public function setIP($ip){
			$this->IP = $ip;
		}
		public function setremote_IP($remote_ip){
			$this->remote_IP = $remote_ip;
		}
		public function setResource($resource){
			$this->Resource = $resource;
		}
		public function setParameters($parameters){
			$this->Parameters = $parameters;
		}
		public function toString(){
			$url = $getProtocol()."://".$getIP()."/".getResources."?";
			return $url;
		}	
	}
	//$request = new Request($_SERVER['REQUEST_METHOD'], $_SERVER['SERVER_PROTOCOL'], "12345678", "resource", array("par1"=>123,"par2"=>1234));
	//echo $request->toString();
