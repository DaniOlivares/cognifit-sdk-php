<?php

use PHPUnit\Framework\TestCase;

use CognifitSdk\Api\HealthCheck;

class HealthCheckTest extends TestCase {

    public function testRegistration()
    {
        $this->expectException(Error::class);
        $healthCheckInstance = new HealthCheck('FAKE_CLIENT_ID', 'FAKE_SECRET_ID');
        $healthCheckInstance->info();
    }
	
}
