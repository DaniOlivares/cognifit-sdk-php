<?php

namespace CognifitSdk\Lib;

class Response {
	
	private $data			= array();
	private $error			= 0;
	private $errorMessage	= '';
	
	
	public function __construct(array $data){
		if(isset($data['error'])){
			$this->error 		= $data['error'];
			$this->errorMessage = isset($data['errorMessage']) ? $data['errorMessage'] : '';
		}
		$this->data = $data;		
	}
	
	public function hasError(){
		return ($this->error !== 0);
	}
	
	public function getError(){
		return $this->error;
	}
	
	public function getErrorMessage(){
		return $this->errorMessage;
	}
	
	public function getData(){
		return $this->data;
	}
	
	public function get($dataAttribute){		
		if(isset($this->data[$dataAttribute])){
			return $this->data[$dataAttribute];
		}
		return null;
	}
	
}
