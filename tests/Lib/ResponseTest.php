<?php

namespace CognifitSdk\Lib;

use PHPUnit\Framework\TestCase;

final class ResponseTest extends TestCase{
	
	public function testCreateResponseInstance(): void{
        $this->assertInstanceOf(
            Response::class,
            new Response([])
        );
    }	
    
    public function testErrorWithNoMessageResponseInstance(): void{
		$responseInstance = new Response([
			'error' => 1100
		]);
        $this->assertInstanceOf(
            Response::class,
            $responseInstance
        );
        $this->assertEquals(
			true,
			$responseInstance->hasError()
        );
        $this->assertEquals(
			1100,
			$responseInstance->getError()
        );
        $this->assertEquals(
			'',
			$responseInstance->getErrorMessage()
        );
    }	
    
    public function testErrorWithMessageResponseInstance(): void{
		$responseInstance = new Response([
			'error' 		=> 1100,
			'errorMessage'	=> 'THE ERROR MESSAGE'
		]);
        $this->assertInstanceOf(
            Response::class,
            $responseInstance
        );
        $this->assertEquals(
			true,
			$responseInstance->hasError()
        );
        $this->assertEquals(
			1100,
			$responseInstance->getError()
        );
        $this->assertEquals(
			'THE ERROR MESSAGE',
			$responseInstance->getErrorMessage()
        );
    }	
    
    public function testSuccessResponseInstance(): void{
		$responseInstance = new Response([
			'success' 		=> true,
			'key1'			=> 'value1',
			'key2'			=> 'value2',
			'key3'			=> 'value3',
			'errorMessage'	=> 'THE ERROR MESSAGE'
		]);
        $this->assertInstanceOf(
            Response::class,
            $responseInstance
        );
        $this->assertEquals(
			false,
			$responseInstance->hasError()
        );
        $this->assertEquals(
			0,
			$responseInstance->getError()
        );
        $this->assertEquals(
			'',
			$responseInstance->getErrorMessage()
        );
        $this->assertEquals(
			5,
			count($responseInstance->getData())
        );
        $this->assertEquals(
			'value2',
			$responseInstance->get('key2')
        ); 
    }	
}
