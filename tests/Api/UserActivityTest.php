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

    public function testGetPlayedGames()
    {
        $healthCheckInstance    = new UserActivity(getenv('TEST_CLIENT_ID'), getenv('TEST_CLIENT_SECRET'), true);
        $response               = $healthCheckInstance->getPlayedGames(getenv('TEST_USER_ID'));
        $this->assertEquals(false, $response->hasError());
        $this->assertIsArray($response->getData());
        $this->assertArrayHasKey('success', $response->getData());
        $this->assertEquals(1, $response->get('success'));
        $this->assertArrayHasKey('historicalPlayedGames', $response->getData());
        $this->assertIsArray($response->get('historicalPlayedGames'));
        $lastPlayedGame = $response->get('historicalPlayedGames')[0];
        $this->assertIsArray($lastPlayedGame);
        $this->assertArrayHasKey('key', $lastPlayedGame);
        $this->assertArrayHasKey('level', $lastPlayedGame);
        $this->assertArrayHasKey('sublevel', $lastPlayedGame);
        $this->assertArrayHasKey('score', $lastPlayedGame);
        $this->assertArrayHasKey('timePlayed', $lastPlayedGame);
        $this->assertArrayHasKey('time', $lastPlayedGame);
        $this->assertRegExp('/^[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9] [0-9][0-9]:[0-9][0-9]:[0-9][0-9]$/', $lastPlayedGame['time']);
        $this->assertArrayHasKey('outReasonKey', $lastPlayedGame);
    }

    public function testGetHistoricalScoreAndSkillsFail()
    {
        $healthCheckInstance = new UserActivity('FAKE_CLIENT_ID', 'FAKE_SECRET_ID');
        $response            = $healthCheckInstance->getHistoricalScoreAndSkills('FAKE_USER_ID');
        $this->assertEquals(true, $response->hasError());
    }

    public function testGetPlayedGamesFail()
    {
        $healthCheckInstance = new UserActivity('FAKE_CLIENT_ID', 'FAKE_SECRET_ID');
        $response = $healthCheckInstance->getPlayedGames('FAKE_USER_ID');
        $this->assertEquals(true, $response->hasError());
    }

}
