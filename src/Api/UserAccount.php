<?php

namespace CognifitSdk\Api;

use CognifitSdk\Lib\Request;
use CognifitSdk\Lib\UserData;

class UserAccount extends Request {

	const RESOURCE_PATH = '/registration';

	public function registration(UserData $cognifitSdkUserData){
		return $this->doRequest(self::RESOURCE_PATH, $cognifitSdkUserData->getAttributesForRegistration(), 'POST');
	}
	
}
