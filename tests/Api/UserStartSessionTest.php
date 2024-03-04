<?php
namespace Api;

use CognifitSdk\Api\UserStartSession;
use PHPUnit\Framework\TestCase;

include_once dirname(__FILE__) . '/../.environment-test.php';

class UserStartSessionTest extends TestCase
{

    private string $userToken      = 'USER_ACCESS_TOKEN';
    private string $clientHash     = 'CLIENT_HASH';
    private string $callbackUrl    = 'http://www.callback.test/testing';

    public function testGetUrlStartCognifit(){

        $userStartSession   = new UserStartSession(getenv('TEST_CLIENT_ID'), '', true, $this->clientHash);
        $urlToStartSession  = $userStartSession->getUrlStartCognifit($this->userToken, $this->callbackUrl);

        $this->assertStringContainsString(getenv('TEST_CLIENT_ID'), $urlToStartSession);
        $this->assertStringContainsString($this->clientHash, $urlToStartSession);
        $this->assertStringContainsString($this->userToken, $urlToStartSession);
        $this->assertStringContainsString(urlencode($this->callbackUrl), $urlToStartSession);

    }

    public function testGetUrlStartCognifitForAssessment(){

        $userStartSession   = new UserStartSession(getenv('TEST_CLIENT_ID'), '', true, $this->clientHash);
        $urlToStartSession  = $userStartSession->getUrlStartCognifitForAssessment($this->userToken, $this->callbackUrl, 'DRIVING_ASSESSMENT');

        $this->assertStringContainsString(getenv('TEST_CLIENT_ID'), $urlToStartSession);
        $this->assertStringContainsString($this->clientHash, $urlToStartSession);
        $this->assertStringContainsString($this->userToken, $urlToStartSession);
        $this->assertStringContainsString(urlencode($this->callbackUrl), $urlToStartSession);

    }

    public function testGetUrlStartCognifitForQuestionnaire(){

        $userStartSession   = new UserStartSession(getenv('TEST_CLIENT_ID'), '', true, $this->clientHash);
        $urlToStartSession  = $userStartSession->getUrlStartCognifitForQuestionnaire($this->userToken, $this->callbackUrl, 'PCPTSD5_QUESTIONNAIRE_ASSESSMENT');

        $this->assertStringContainsString(getenv('TEST_CLIENT_ID'), $urlToStartSession);
        $this->assertStringContainsString($this->clientHash, $urlToStartSession);
        $this->assertStringContainsString($this->userToken, $urlToStartSession);
        $this->assertStringContainsString(urlencode($this->callbackUrl), $urlToStartSession);

    }

    public function testGetUrlStartCognifitForTraining(){

        $userStartSession   = new UserStartSession(getenv('TEST_CLIENT_ID'), '', true, $this->clientHash);
        $urlToStartSession  = $userStartSession->getUrlStartCognifitForTraining($this->userToken, $this->callbackUrl, 'DRIVING');

        $this->assertStringContainsString(getenv('TEST_CLIENT_ID'), $urlToStartSession);
        $this->assertStringContainsString($this->clientHash, $urlToStartSession);
        $this->assertStringContainsString($this->userToken, $urlToStartSession);
        $this->assertStringContainsString(urlencode($this->callbackUrl), $urlToStartSession);

    }

    public function testGetUrlStartCognifitForGame(){

        $userStartSession   = new UserStartSession(getenv('TEST_CLIENT_ID'), '', true, $this->clientHash);
        $urlToStartSession  = $userStartSession->getUrlStartCognifitForGame($this->userToken, $this->callbackUrl, 'MAHJONG');

        $this->assertStringContainsString(getenv('TEST_CLIENT_ID'), $urlToStartSession);
        $this->assertStringContainsString($this->clientHash, $urlToStartSession);
        $this->assertStringContainsString($this->userToken, $urlToStartSession);
        $this->assertStringContainsString(urlencode($this->callbackUrl), $urlToStartSession);

    }

}
