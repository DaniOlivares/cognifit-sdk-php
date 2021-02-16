<?php

use PHPUnit\Framework\TestCase;

use CognifitSdk\Api\UserActivity;

include_once dirname(__FILE__) . '/../.environment-test.php';

class UserActivityTest extends TestCase {

    public function testGetHistoricalScoreAndSkills()
    {
        $healthCheckInstance    = new UserActivity(getenv('TEST_CLIENT_ID'), getenv('TEST_CLIENT_SECRET'), true);
        $response               = $healthCheckInstance->getHistoricalScoreAndSkills(getenv('TEST_USER_ID'));
        $this->assertEquals(false, $response->hasError());
        $this->assertIsArray($response->getData());
        $this->assertArrayHasKey('success', $response->getData());
        $this->assertEquals(1, $response->get('success'));
        $this->assertArrayHasKey('historicalScoreAndSkills', $response->getData());
        $this->assertIsArray($response->get('historicalScoreAndSkills'));
    }

    /*
    public function testGetPlayedGames()
    {
        $healthCheckInstance    = new UserActivity(getenv('TEST_CLIENT_ID'), getenv('TEST_CLIENT_SECRET'), true);
        $response               = $healthCheckInstance->getPlayedGames(getenv('TEST_USER_ID'));
    }*/

    public function testGetHistoricalScoreAndSkillsFail()
    {
        $healthCheckInstance = new UserActivity('FAKE_CLIENT_ID', 'FAKE_SECRET_ID');
        $response            = $healthCheckInstance->getHistoricalScoreAndSkills('FAKE_USER_ID');
        $this->assertEquals(true, $response->hasError());
    }

    public function testGetPlayedGamesFail()
    {
        $this->expectException(Error::class);
        $healthCheckInstance = new UserActivity('FAKE_CLIENT_ID', 'FAKE_SECRET_ID');
        $healthCheckInstance->getPlayedGames('FAKE_USER_ID');
    }

}
