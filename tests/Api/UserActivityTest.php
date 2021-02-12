<?php

use PHPUnit\Framework\TestCase;

use CognifitSdk\Api\UserActivity;

class UserActivityTest extends TestCase {

    public function testGetHistoricalScoreAndSkills()
    {
        $this->expectException(Error::class);
        $healthCheckInstance = new UserActivity('FAKE_CLIENT_ID', 'FAKE_SECRET_ID');
        $healthCheckInstance->getHistoricalScoreAndSkills();
    }

    public function testGetPlayedGames()
    {
        $this->expectException(Error::class);
        $healthCheckInstance = new UserActivity('FAKE_CLIENT_ID', 'FAKE_SECRET_ID');
        $healthCheckInstance->getPlayedGames();
    }

}
