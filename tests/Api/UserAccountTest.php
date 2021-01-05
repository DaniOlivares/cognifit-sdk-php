<?php
use PHPUnit\Framework\TestCase;

use CognifitSdk\Api\UserAccount;
use CognifitSdk\Lib\UserData;
use CognifitSdk\Lib\Error;

final class UserAccountTest extends TestCase{
	
	public function testRegistration(){
		$this->expectException(Error::class);
		$userAccountInstance = new UserAccount('FAKE_CLIENT_ID', 'FAKE_SECRET_ID');
		$userAccountInstance->registration(new UserData([]));
	}
	
}
