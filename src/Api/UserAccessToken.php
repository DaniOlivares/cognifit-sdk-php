<?php

namespace CognifitSdk\Api;

use CognifitSdk\Lib\Request;

class UserAccessToken extends Request {

	const RESOURCE_PATH = '/issue-access-token';

	public function issue(string $userId){
		return $this->doRequest(self::RESOURCE_PATH, ['user_token' => $userId], 'POST');
	}
	
}
