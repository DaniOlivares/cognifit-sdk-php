<?php
use PHPUnit\Framework\TestCase;
use CognifitSdk\Lib\Error;

final class ErrorTest extends TestCase{
	
	
	public function testCreateErrorInstance(): void{
        $this->assertInstanceOf(
            Error::class,
            new Error('The error', 500, 'Error message', '{error: 500}')
        );
    }
    
    public function testGettersErrorInstance(): void{
		$errorInstance = new Error('The error', 500, 'Error message', '{error: 500}');
        $this->assertEquals(
            'The error',
            $errorInstance->getMessage()
        );
        
        $this->assertEquals(
            500,
            $errorInstance->getHttpStatus()
        );
        
        $this->assertEquals(
            'Error message',
            $errorInstance->getHttpBody()
        );
        
        $this->assertEquals(
            '{error: 500}',
            $errorInstance->getJsonBody()
        );
    }
	
	
}
