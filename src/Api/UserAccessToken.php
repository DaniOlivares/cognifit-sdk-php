<?php

namespace CognifitSdk\Api;

use CognifitSdk\Lib\Request;

class UserAccessToken extends Request {

	const RESOURCE_PATH = '/issue-access-token';

	public function issue(string $userId, string $locale = ''){
	    $params = ['user_token' => $userId];
	    if($locale){
	        $params['locale'] = $locale;
        }
		return $this->doRequest(self::RESOURCE_PATH, $params, 'POST');
	}
	
}
