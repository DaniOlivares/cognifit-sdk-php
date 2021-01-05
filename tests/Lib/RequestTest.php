<?php

namespace CognifitSdk\Lib;

use PHPUnit\Framework\TestCase;

final class RequestTest extends TestCase{
	
	public function testCreateRequestInstance(): void{
        $this->assertInstanceOf(
            Request::class,
            new Request('TEST_CLIENT_ID', 'TEST_SECRET_ID')
        );
    }	
	
}
