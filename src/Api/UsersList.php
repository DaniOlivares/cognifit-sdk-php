<?php

namespace CognifitSdk\Api;

use CognifitSdk\Lib\Request;

class UsersList extends Request {

    const RESOURCE_PATH = '/get-users-list';

    public function get(int $initialValue = 0, int $totalPoints = 50){
        return $this->doRequest(self::RESOURCE_PATH, [
            'initial_value' => $initialValue,
            'total_points'  => $totalPoints
        ], 'POST');
    }

}
