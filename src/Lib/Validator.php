<?php

namespace CognifitSdk\Lib;

class Validator {
	
	const ALPHANUMERIC 	= 'ALPHANUMERIC';
	const DATE 			= 'DATE';
	const EMAIL			= 'EMAIL';
	const LOCALE		= 'LOCALE';
	
	public function isValid($value, $mandatory, $type){
		if(is_array($type)){
			return $this->validateArray($value, $mandatory, $type);
		}
		if($type === self::ALPHANUMERIC){
			return $this->validateAlphanumeric($value, $mandatory);
		}
		if($type === self::DATE){
			return $this->validateDate($value, $mandatory);
		}
		if($type === self::EMAIL){
			return $this->validateEmail($value, $mandatory);
		}
		if($type === self::LOCALE){
			return $this->validateLocale($value, $mandatory);
		}
	}
	
	private function validateAlphanumeric($value, $mandatory){
		if($mandatory && trim($value) === ''){
			return false;
		}
		return true;
	}
	
	private function validateDate($value, $mandatory){
		if($mandatory && trim($value) === ''){
			return false;
		}
		if(trim($value) === ''){
			return true;
		}		
		$format = "Y-m-d";
		$d 		= \DateTime::createFromFormat($format, $value);
		return $d && $d->format($format) == $value;
	}
	
	private function validateEmail($value, $mandatory){
		if($mandatory && trim($value) === ''){
			return false;
		}
		if(trim($value) === ''){
			return true;
		}
		return filter_var($value, FILTER_VALIDATE_EMAIL) ? true : false;
	}
	
	private function validateLocale($value, $mandatory){
		if($mandatory && trim($value) === ''){
			return false;
		}
		if(trim($value) === ''){
			return true;
		}
		return (preg_match("/^[a-z][a-z](_[A-Z][A-Z])?$/", $value) > 0);
	}
	
	private function validateArray($value, $mandatory, $values){
		if(in_array($value, $values)){
			return true;
		}
		if(!$mandatory && !$value){
			return true;
		}
		return false;
	}
	
}
