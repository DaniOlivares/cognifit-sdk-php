<?php

namespace CognifitSdk\Api;

use CognifitSdk\Lib\Request;

class HealthCheck extends Request {

	const RESOURCE_PATH = '/health-check';

    public function getInfo(){
        return $this->doRequest(self::RESOURCE_PATH, [], 'POST');
    }
	
}
