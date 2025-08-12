<?php
namespace China\Api;

use PHPUnit\Framework\TestCase;

use CognifitSdk\Api\UserAccount;
use CognifitSdk\Lib\UserData;
use CognifitSdk\Lib\Error;

include_once dirname(__FILE__) . '/../../.environment-test.php';

final class UserAccountTest extends TestCase{

    private UserAccount $userAccountInstance;

    public function setUp(): void{
        $this->userAccountInstance = new UserAccount(getenv('TEST_CLIENT_ID_CHINA'), getenv('TEST_CLIENT_SECRET_CHINA'), true);
        $this->userAccountInstance->setChinaProjectRegion();
    }

    public function testRegistrationUserExists(){
        $response = $this->userAccountInstance->registration(new UserData([
            "user_name" => "Testing Api User",
            "user_lastname" => "First Of His Name",
            "user_email" => "olivaresroza+testingapiuser001@gmail.com",
            "user_password" => "1234567*aA",
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

    public function testRegistrationUser(){
        $email    = time() . '-test@cognifit.test';
        $response = $this->userAccountInstance->registration(new UserData([
            "user_name" => "Testing Api User",
            "user_lastname" => "First Of His Name",
            "user_email" => $email,
            "user_password" => "1234567*aA",
            "user_birthday" => "1981-07-15",
            "user_sex" => 1,
            "user_locale" => "en"
        ]));
        $this->assertEquals(false, $response->hasError());
        $this->assertNotEmpty($response->get('user_token'));

        return $response->get('user_token');
    }

    /**
     * @depends testRegistrationUser
     */
    public function testUpdateUser($userToken){
        $newName  = 'I will be deleted';
        $response = $this->userAccountInstance->update($userToken, new UserData([
            'user_name' => $newName
        ]));
        $this->assertEquals(false, $response->hasError());
    }

    /**
     * @depends testRegistrationUser
     */
    public function testDeleteUser($userToken){
        $response  = $this->userAccountInstance->delete($userToken);
        $this->assertEquals(false, $response->hasError());

        $response  = $this->userAccountInstance->delete($userToken);
        $this->assertEquals(true, $response->hasError());
        $this->assertEquals(1150, $response->getError());
    }

}
