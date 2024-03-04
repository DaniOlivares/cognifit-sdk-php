<?php

namespace CognifitSdk\Api;

use CognifitSdk\Lib\Request;

class UserStartSession extends Request {

    private $clientHash = '';

    public function __construct(string $clientId, string $clientSecret, $sandbox = false, $clientHash = ''){
        parent::__construct($clientId, $clientSecret, $sandbox);
        $this->clientHash = $clientHash;
    }

    public function getUrlStartCognifit(string $userAccessToken, string $callbackUrl = ''){
        return $this->_getUrl($userAccessToken, $callbackUrl);
    }

    public function getUrlStartCognifitForAssessment(string $userAccessToken, string $callbackUrl = '', string $sessionKey = ''){
        return $this->_getUrl($userAccessToken, $callbackUrl, 'assessment', $sessionKey);
    }

    public function getUrlStartCognifitForAssessmentTask(string $userAccessToken, string $callbackUrl = '', string $sessionKey = ''){
        return $this->getUrlStartCognifitForAssessment($userAccessToken, $callbackUrl, $sessionKey);
    }

    public function getUrlStartCognifitForQuestionnaire(string $userAccessToken, string $callbackUrl = '', string $sessionKey = ''){
        return $this->getUrlStartCognifitForAssessment($userAccessToken, $callbackUrl, $sessionKey);
    }

    public function getUrlStartCognifitForTraining(string $userAccessToken, string $callbackUrl = '', string $sessionKey = ''){
        return $this->_getUrl($userAccessToken, $callbackUrl, 'training', $sessionKey);
    }

    public function getUrlStartCognifitForGame(string $userAccessToken, string $callbackUrl = '', string $sessionKey = ''){
        return $this->_getUrl($userAccessToken, $callbackUrl, 'game', $sessionKey);
    }

    private function _getUrl(string $userAccessToken, string $callbackUrl = '', $sessionType = '', $sessionKey = ''){
        $url = $this->getDomainFrontend() . '/partner/' . $this->clientHash;
        $url .= '?client_id=' . $this->clientId;
        $url .= '&user_token=' . $userAccessToken;

        if($sessionType && $sessionKey){
            if($sessionType === 'game'){
                $url .= '&' . urlencode('setting[tasks][]') . '=' . $sessionKey;
            }elseif(in_array($sessionType, ['assessment', 'training'])){
                $url .= '&setting=[{"type":"'.$sessionType.'","key":"'.$sessionKey.'"}]';
            }
        }

        if($callbackUrl){
            $url .= '&callback_url=' . urlencode($callbackUrl);
        }

        return $url;
    }
	
}
