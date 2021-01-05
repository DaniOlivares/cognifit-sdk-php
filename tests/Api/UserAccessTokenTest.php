<?php
use PHPUnit\Framework\TestCase;
use CognifitSdk\Api\UserAccessToken;

final class UserAccessTokenTest extends TestCase{
	
	public function testIssueA(){
		$userAccessTokenInstance = new UserAccessToken('FAKE_CLIENT_ID', 'FAKE_SECRET_ID');
		$this->assertInstanceOf(
			CognifitSdk\Lib\Response::class,
			$userAccessTokenInstance->issue('FAKE_TOKEN')
		);
	}
	
}
