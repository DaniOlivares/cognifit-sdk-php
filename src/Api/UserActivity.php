<?php

namespace CognifitSdk\Api;

use CognifitSdk\Lib\Request;

class UserActivity extends Request {

    const RESOURCE_PATH = '/get-historical-score-and-skills';
    const RESOURCE_PATH_PLAYED_GAMES = '/get-historical-played-games';

    public function getHistoricalScoreAndSkills(string $userId){
        return $this->doRequest(self::RESOURCE_PATH, ['user_token' => $userId], 'POST');
    }

    public function getPlayedGames(string $userId){
        return $this->doRequest(self::RESOURCE_PATH_PLAYED_GAMES, ['user_token' => $userId], 'POST');
    }

}
