<?php
use PHPUnit\Framework\TestCase;

use CognifitSdk\Api\UserAccount;
use CognifitSdk\Lib\UserData;
use CognifitSdk\Lib\Error;

include_once dirname(__FILE__) . '/../.environment-test.php';

final class UserAccountTest extends TestCase{

    public function testRegistration(){
        $userAccountInstance    = new UserAccount(getenv('TEST_CLIENT_ID'), getenv('TEST_CLIENT_SECRET'), true);
        $response               = $userAccountInstance->registration(new UserData([
            "user_name" => "Testing Api User",
            "user_lastname" => "First Of His Name",
            "user_email" => "olivaresroza+testingapiuser001@gmail.com",
            "user_password" => "123456",
            "user_birthday" => "1981-07-15",
            "user_sex" => 1,
            "user_locale" => "en"
        ]));
        $this->assertEquals(true, $response->hasError());
        $this->assertEquals(1120, $response->getError());
    }

	public function testRegistrationFail(){
		$this->expectException(Error::class);
		$userAccountInstance = new UserAccount('FAKE_CLIENT_ID', 'FAKE_SECRET_ID');
		$userAccountInstance->registration(new UserData([]));
	}
	
}
