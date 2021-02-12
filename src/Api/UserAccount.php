<?php

namespace CognifitSdk\Api;

use CognifitSdk\Lib\Request;
use CognifitSdk\Lib\UserData;

class UserAccount extends Request {

    const RESOURCE_PATH = '/registration';
    const RESOURCE_PATH_ASSOCIATE = '/user-authenticate';

	public function registration(UserData $cognifitSdkUserData){
		return $this->doRequest(self::RESOURCE_PATH, $cognifitSdkUserData->getAttributesForRegistration(), 'POST');
	}

	public function getAssociateExistingUserAccountUrl(string $userAccountEmail, string $callback, string $stateHash){
        return $this->getDomain()
            . self::RESOURCE_PATH_ASSOCIATE
            . '?client_id=' . $this->clientId
            . '&user_email=' . $userAccountEmail
            . '&callback_url=' . $callback
            . '&state=' . $stateHash;
    }
	
}
