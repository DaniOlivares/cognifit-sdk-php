<?php

namespace CognifitSdk\Api;

use CognifitSdk\Lib\Request;
use CognifitSdk\Lib\UserData;

class UserAccount extends Request {

    const RESOURCE_PATH                 = '/registration';
    const RESOURCE_PATH_UPDATE          = '/update-user';
    const RESOURCE_PATH_DELETE          = '/patient/deactivate';
    const RESOURCE_PATH_ASSOCIATE       = '/user-authenticate';
    const RESOURCE_PATH_ACTIVATE        = '/patient/activate';
    const RESOURCE_PATH_DEACTIVATE      = '/patient/deactivate';
    const RESOURCE_PATH_GRANT_TRAINING  = '/subscription/set';
    const RESOURCE_PATH_REVOKE_TRAINING = '/subscription/remove';



	public function registration(UserData $cognifitSdkUserData){
		return $this->doRequest(self::RESOURCE_PATH, $cognifitSdkUserData->getAttributesForRegistration(), 'POST');
	}

	public function update(string $userToken, UserData $cognifitSdkUserData){
	    $params                 = $cognifitSdkUserData->getAttributesForUpdate();
	    $params['user_token']   = $userToken;
        return $this->doRequest(self::RESOURCE_PATH_UPDATE, $params, 'POST');
    }

    public function activate(string $userToken){
        return $this->doRequest(self::RESOURCE_PATH_ACTIVATE, array(
            'user_token' => $userToken
        ), 'POST');
    }

    public function deactivate(string $userToken){
        return $this->doRequest(self::RESOURCE_PATH_DEACTIVATE, array(
            'user_token' => $userToken
        ), 'POST');
    }

    public function grantTrainingLicense(string $userToken){
        return $this->doRequest(self::RESOURCE_PATH_GRANT_TRAINING, array(
            'user_token' => $userToken
        ), 'POST');
    }

    public function revokeTrainingLicense(string $userToken){
        return $this->doRequest(self::RESOURCE_PATH_REVOKE_TRAINING, array(
            'user_token' => $userToken
        ), 'POST');
    }

    public function delete(string $userToken){
        return $this->doRequest(self::RESOURCE_PATH_DELETE, array(
            'user_token' => $userToken
        ), 'DELETE');
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
