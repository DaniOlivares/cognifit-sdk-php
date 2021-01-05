<?php

namespace CognifitSdk\Lib;

use PHPUnit\Framework\TestCase;

final class ValidatorTest extends TestCase{
	
	public function testCreateRequestInstance(): void{
        $this->assertInstanceOf(
            Validator::class,
            new Validator()
        );
    }	
    
    public function testAlphanumeric(): void{
        $validator = new Validator();
        
        $this->assertEquals(
			true,
			$validator->isValid('', false, Validator::ALPHANUMERIC)
        );
        $this->assertEquals(
			true,
			$validator->isValid('String', false, Validator::ALPHANUMERIC)
        );
        $this->assertEquals(
			false,
			$validator->isValid('', true, Validator::ALPHANUMERIC)
        );
        $this->assertEquals(
			true,
			$validator->isValid('String', false, Validator::ALPHANUMERIC)
        );
    }	
    
    public function testDate(): void{
        $validator = new Validator();
        
        $this->assertEquals(
			true,
			$validator->isValid('', false, Validator::DATE)
        );
        $this->assertEquals(
			true,
			$validator->isValid('2002-01-23', false, Validator::DATE)
        );
        $this->assertEquals(
			false,
			$validator->isValid('2002-33-33', false, Validator::DATE)
        );
        
        $this->assertEquals(
			false,
			$validator->isValid('', true, Validator::DATE)
        );
        $this->assertEquals(
			true,
			$validator->isValid('2002-01-23', true, Validator::DATE)
        );
        $this->assertEquals(
			false,
			$validator->isValid('2002-33-33', true, Validator::DATE)
        );
       
    }	
    
    public function testEmail(): void{
        $validator = new Validator();
        
        $this->assertEquals(
			true,
			$validator->isValid('', false, Validator::EMAIL)
        );
        $this->assertEquals(
			false,
			$validator->isValid('test@testito', false, Validator::EMAIL)
        );
        $this->assertEquals(
			true,
			$validator->isValid('test@testito.com', false, Validator::EMAIL)
        );
        
        $this->assertEquals(
			false,
			$validator->isValid('', true, Validator::EMAIL)
        );
        $this->assertEquals(
			false,
			$validator->isValid('test@testito', true, Validator::EMAIL)
        );
        $this->assertEquals(
			true,
			$validator->isValid('test@testito.com', true, Validator::EMAIL)
        );
       
    }	
    
    public function testLocale(): void{
        $validator = new Validator();
        
        $this->assertEquals(
			true,
			$validator->isValid('', false, Validator::LOCALE)
        );
        $this->assertEquals(
			false,
			$validator->isValid('e', false, Validator::LOCALE)
        );
        $this->assertEquals(
			false,
			$validator->isValid('e_r', false, Validator::LOCALE)
        );
        $this->assertEquals(
			false,
			$validator->isValid('ee_RRi', false, Validator::LOCALE)
        );
        
        $this->assertEquals(
			false,
			$validator->isValid('', true, Validator::LOCALE)
        );
        $this->assertEquals(
			true,
			$validator->isValid('es', true, Validator::LOCALE)
        );
        $this->assertEquals(
			true,
			$validator->isValid('es_MX', true, Validator::LOCALE)
        );
       
    }	
    
    
    
    /*
     * 
     * 
     * const ALPHANUMERIC 	= 'ALPHANUMERIC';
	const DATE 			= 'DATE';
	const EMAIL			= 'EMAIL';
	const LOCALE		= 'LOCALE';
	
	public function isValid($value, $mandatory, $type){
     * 
     */
    
    
	
}
