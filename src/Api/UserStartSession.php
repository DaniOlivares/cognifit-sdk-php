<?php

namespace CognifitSdk\Api;

use CognifitSdk\Lib\Request;

class UserStartSession extends Request {

    private $clientHash = '';

    public function __construct(string $clientId, string $clientSecret, $sandbox = false, $clientHash = ''){
        parent::__construct($clientId, $clientSecret, $sandbox);
        $this->clientHash = $clientHash;
    }

    public function getUrl(string $userAccessToken, string $callbackUrl = ''){

	    $url = $this->getDomainFrontend() . '/partner/' . $this->clientHash;
        $url .= '?client_id=' . $this->clientId;
        $url .= '&user_token=' . $userAccessToken;
        if($callbackUrl){
            $url .= '&callback_url=' . urlencode($callbackUrl);
        }
        return $url;
	}
	
}
