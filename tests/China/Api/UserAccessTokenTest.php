<?php
namespace China\Api;

use PHPUnit\Framework\TestCase;

use CognifitSdk\Api\UserAccessToken;
use CognifitSdk;

include_once dirname(__FILE__) . '/../../.environment-test.php';

final class UserAccessTokenTest extends TestCase{

    public function testIssueAccessTokenSuccess(){
        $userAccessTokenInstance = new UserAccessToken(getenv('TEST_CLIENT_ID_CHINA'), getenv('TEST_CLIENT_SECRET_CHINA'), true, 'CHINA');
        $response                = $userAccessTokenInstance->issue(getenv('TEST_USER_ID_CHINA'));
        $this->assertInstanceOf(
            CognifitSdk\Lib\Response::class,
            $response
        );
        $this->assertEquals(false, $response->hasError());
        $this->assertIsArray($response->getData());
        $this->assertArrayHasKey('access_token', $response->getData());
    }

    public function testIssueAccessTokenFailWrongUser(){
        $userAccessTokenInstance = new UserAccessToken(getenv('TEST_CLIENT_ID_CHINA'), getenv('TEST_CLIENT_SECRET_CHINA'), true, 'CHINA');
        $response                = $userAccessTokenInstance->issue('FAKE_TOKEN');
        $this->assertInstanceOf(
            CognifitSdk\Lib\Response::class,
            $response
        );
        $this->assertEquals(true, $response->hasError());
        $this->assertEquals('1100', $response->getError());
    }

    public function testIssueAccessTokenFail(){
		$userAccessTokenInstance = new UserAccessToken('FAKE_CLIENT_ID', 'FAKE_SECRET_ID', true, 'CHINA');
		$response                = $userAccessTokenInstance->issue('FAKE_TOKEN');
		$this->assertInstanceOf(
			CognifitSdk\Lib\Response::class,
            $response
		);
		$this->assertEquals(true, $response->hasError());
        $this->assertEquals(404, $response->getError());
	}
	
}
