<?php
namespace China\Api;

use PHPUnit\Framework\TestCase;

use CognifitSdk\Api\HealthCheck;

include_once dirname(__FILE__) . '/../../.environment-test.php';

class HealthCheckTest extends TestCase {

    public function testRegistrationError()
    {
        $healthCheckInstance = new HealthCheck('FAKE_CLIENT_ID', 'FAKE_SECRET_ID', false, 'CHINA');
        $response            = $healthCheckInstance->getInfo();
        $this->assertEquals(true, $response->hasError());
    }

    public function testRegistrationSuccess()
    {
        $healthCheckInstance = new HealthCheck(getenv('TEST_CLIENT_ID_CHINA'), getenv('TEST_CLIENT_SECRET_CHINA'), true, 'CHINA');
        $response            = $healthCheckInstance->getInfo();
        $this->assertEquals(false, $response->hasError());
        $this->assertIsArray($response->getData());
        $this->assertArrayHasKey('client_id', $response->getData());
    }
	
}
