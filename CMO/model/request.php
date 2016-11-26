<?php
class Request{
        private $method;
        private $protocol;
        private $server_ip;
        private $remote_ip;
        private $resource;
	private $resource2;
        private $params;
	private $body;
  
	 public function __construct($method, $protocol, $serverAddress, $clientAddress, $path, $queryString, $body)
    {
        $this->method = $method;
        $this->protocol = $protocol;
        $this->server_ip = $serverAddress;
        $this->remote_ip = $clientAddress;
        $this->setResource($path);
        $this->setParams($queryString);
        $this->body = $body;
    }
		 
        public function toString(){
                $request = "";
                $Inc = 1;
                foreach($this->params as $param) {
                        $request .= "P".$Inc."=".$param."&amp";
                        $Inc++;
        	}
        	return $this->protocol.'://'.$this->server_ip.'/'.$this->resource.'?'.$request;
        }
        public function setMethod($method){
                $this->method = $method;
        }
        public function getMethod(){
                return $this->method;
        }
        public function setProtocol($protocol){
               $this->protocol = $protocol;
        }
        public function getProtocol(){
                return $this->protocol;
        }
        public function setServer_IP($server_ip){
                $this->server_ip = $server_ip;
        }
        public function getServer_IP(){
                return $this->server_ip;
        }
         public function setRemote_IP($remote_ip){
                $this->remote_ip = $remote_ip;
        }
        public function getRemote_IP(){
                return $this->remote_ip;
        }
	
        public function setResource($resource){
        	$s = explode("?", $resource);
		$r = explode("/", $s[0]);
		$this->resource = $r[2];
		if (count($r) > 2) {
		$this->resource2 = $r[3];
		}		
	}
        public function getResource(){
                return $this->resource;
        }

	public function getResource2(){
                return $this->resource2;
        }
        
	public function setParams($paramsString){
        	parse_str($paramsString, $paramsArray);
       		 $this->params = $paramsArray;
    	}	
        public function getParameters(){
                return $this->params;
        }
		
	public function getBody(){
		return $this->body;
	}
}
