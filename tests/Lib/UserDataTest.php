<?php

namespace CognifitSdk\Lib;

use PHPUnit\Framework\TestCase;
use CognifitSdk\Lib\Error;

final class UserDataTest extends TestCase{
	
	public function testCreateUserDataInstance(): void{
        $this->assertInstanceOf(
            UserData::class,
            new UserData([])
        );
    }	
    
    public function testGetAttributesForRegistration(): void{
		$userDataInstance = new UserData($this->getAttributes());
		
		$attributesForRegistration = $userDataInstance->getAttributesForRegistration();
		
		$this->assertEquals(
			'Dani',
			$attributesForRegistration['user_name']
		);
		$this->assertEquals(
			'Olivares',
			$attributesForRegistration['user_lastname']
		);
		$this->assertEquals(
			'test@email.com',
			$attributesForRegistration['user_email']
		);
		$this->assertEquals(
			'123456',
			$attributesForRegistration['user_password']
		);
		$this->assertEquals(
			'1981-07-15',
			$attributesForRegistration['user_birthday']
		);
		$this->assertEquals(
			1,
			$attributesForRegistration['user_sex']
		);
		$this->assertEquals(
			'es',
			$attributesForRegistration['user_locale']
		);
		$this->assertArrayNotHasKey(
			'user_fakeparam',
			$attributesForRegistration
		);
	}
    
	public function testValidateForRegistrationNoName(): void{
		$attributes = $this->getAttributes();
		unset($attributes['user_name']);
		$userDataInstance = new UserData($attributes);
		$this->expectException(Error::class);
		$attributesForRegistration = $userDataInstance->getAttributesForRegistration();
		
	}
	
	public function testValidateForRegistrationNoLastname(): void{
		$attributes = $this->getAttributes();
		unset($attributes['user_lastname']);
		$userDataInstance = new UserData($attributes);
		$this->assertEquals(7, count($userDataInstance->getAttributesForRegistration()));
	}
	
	public function testValidateForRegistrationNoEmail(): void{
		$attributes = $this->getAttributes();
		unset($attributes['user_email']);
		$userDataInstance = new UserData($attributes);
		$this->expectException(Error::class);
		$attributesForRegistration = $userDataInstance->getAttributesForRegistration();
	}
	
	public function testValidateForRegistrationWrongEmail(): void{
		$attributes = $this->getAttributes();
		$attributes['user_email'] = 'a@b';
		$userDataInstance = new UserData($attributes);
		$this->expectException(Error::class);
		$attributesForRegistration = $userDataInstance->getAttributesForRegistration();
	}
	
	public function testValidateForRegistrationNoPassword(): void{
		$attributes = $this->getAttributes();
		unset($attributes['user_password']);
		$userDataInstance = new UserData($attributes);
		$this->expectException(Error::class);
		$attributesForRegistration = $userDataInstance->getAttributesForRegistration();
	}
	
	public function testValidateForRegistrationWrongPassword(): void{
		$attributes = $this->getAttributes();
		$attributes['user_password'] = '';
		$userDataInstance = new UserData($attributes);
		$this->expectException(Error::class);
		$attributesForRegistration = $userDataInstance->getAttributesForRegistration();
	}
	
	public function testValidateForRegistrationNoBirth(): void{
		$attributes = $this->getAttributes();
		unset($attributes['user_birthday']);
		$userDataInstance = new UserData($attributes);
		$this->expectException(Error::class);
		$attributesForRegistration = $userDataInstance->getAttributesForRegistration();
	}
	
	public function testValidateForRegistrationWrongBirth(): void{
		$attributes = $this->getAttributes();
		$attributes['user_birthday'] = '0000-00-00';
		$userDataInstance = new UserData($attributes);
		$this->expectException(Error::class);
		$attributesForRegistration = $userDataInstance->getAttributesForRegistration();
	}
	
	public function testValidateForRegistrationNoSex(): void{
		$attributes = $this->getAttributes();
		unset($attributes['user_sex']);
		$userDataInstance = new UserData($attributes);
		$attributesForRegistration = $userDataInstance->getAttributesForRegistration();
		$this->assertEquals(-1, $attributesForRegistration['user_sex']);
	}
	
	public function testValidateForRegistrationWrongSex(): void{
		$attributes = $this->getAttributes();
		$attributes['user_sex'] = 4;
		$userDataInstance = new UserData($attributes);
		$this->expectException(Error::class);
		$attributesForRegistration = $userDataInstance->getAttributesForRegistration();
	}
	
	private function getAttributes(){
		return [
			'user_name'		=> 'Dani',
			'user_lastname' => 'Olivares',
			'user_email' 	=> 'test@email.com',
			'user_password' => '123456',
			'user_birthday' => '1981-07-15',
			'user_sex' 		=> 1,
			'user_locale'	=> 'es',
			'user_fakeparam'=> 'user_fakeparamvalue'
		];
	}

}
