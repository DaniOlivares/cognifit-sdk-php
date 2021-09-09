<?php

namespace CognifitSdk\Lib;

use CognifitSdk\Lib\Licenses;
use CognifitSdk\Lib\Validator;

class UserData {

	private array       $attributes;
	private array       $changesAttributes = array();
	private string      $userToken         = '';
	private Licenses    $licenses;

	public function __construct(array $data){
		$this->attributes = $this->initAttributes();
		foreach($this->attributes as $attributeKey => $attributeValues){
			if(isset($data[$attributeKey])){
			    $this->changesAttributes[] = $attributeKey;
				$this->attributes[$attributeKey]['value'] = $data[$attributeKey];
			}
		}
	}

    public static function loadUser(array $data): self{
	    $object = new self($data);
        $object->userToken  = $data['user_token'];
        $object->licenses   = new Licenses($data['licenses']);
	    return $object;
    }

    public function getUserToken(): string{
        return $this->userToken;
    }

    public function getLicenses(): Licenses{
        return $this->licenses;
    }

    public function getAttributesForRegistration(){
        $validator 	= new Validator();
        $keysValues = [];
        foreach($this->attributes as $key => $values){
            if(!$validator->isValid($values['value'], $values['mandatory'], $values['type'])){
                throw new Error("UserData object could not be create. Incorrect values for " . $key);
            }
            $keysValues[$key] = $values['value'];
        }
        return $keysValues;
    }

    public function getAttributesForUpdate(){
        $validator 	= new Validator();
        $keysValues = [];
        foreach($this->attributes as $key => $values){
            if(in_array($key, $this->changesAttributes)){
                if(!$validator->isValid($values['value'], $values['mandatory'], $values['type'])){
                    throw new Error("UserData object could not be create. Incorrect values for " . $key);
                }
                $keysValues[$key] = $values['value'];
            }
        }
        return $keysValues;
    }

    public function getValue($attributeKey){
	    return $this->attributes[$attributeKey]['value'];
    }

    private function initAttributes(){
	    $this->changesAttributes = array();
		return [
		    'user_name'		=> $this->initAttribute('', true,	Validator::ALPHANUMERIC),
			'user_lastname'	=> $this->initAttribute('', false, 	Validator::ALPHANUMERIC),
			'user_email'	=> $this->initAttribute('', true,	Validator::EMAIL),
			'user_password'	=> $this->initAttribute('', true,	Validator::ALPHANUMERIC),
			'user_birthday'	=> $this->initAttribute('', true,	Validator::DATE),
			'user_sex'		=> $this->initAttribute(-1, true, 	[-1, 0, 1]),
			'user_locale'	=> $this->initAttribute('', false, 	Validator::LOCALE),
		];
	}
	
	private function initAttribute($defaultValue, $isMandatoryForRegistration, $validationType){
		return [
			'value' 	=> $defaultValue,
			'mandatory'	=> $isMandatoryForRegistration,
			'type'		=> $validationType
		];
	}
	
}
