# cognifit-sdk-php

## Description

## Reference

### Health Check

```PHP
use CognifitSdk\Api\HealthCheck;

$cognifitApiHealthCheck = new HealthCheck(
    env('COGNIFIT_CLIENT_ID'),
    env('COGNIFIT_CLIENT_SECRET'),
    env('COGNIFIT_API_SANDBOX')
);
$response = $cognifitApiHealthCheck->getInfo();

if(!$response->hasError()){
    
}
```

### User registration



#### Create new user account

```PHP
use CognifitSdk\Api\UserAccount;
use CognifitSdk\Lib\UserData;

$userName               = 'Joe';
$userEmail              = 'joe@example.com';
$userBirth              = '1981-07-15';
$locale                 = 'en';
$userPassword           = 'RANDOM_PASSWORD_OR_USER_KNOWN_PASSWORD';
$cognifitApiUserAccount = new UserAccount(
    env('COGNIFIT_CLIENT_ID'),
    env('COGNIFIT_CLIENT_SECRET'),
    env('COGNIFIT_API_SANDBOX')
);
$response = $cognifitApiUserAccount->registration(new UserData([
    'user_name'     => $userName,
    'user_email'    => $userEmail,
    'user_birthday' => $userBirth,
    'user_locale'   => $locale,
    'user_password' => $userPassword 
]));

if(!$response->hasError()){
    $cognifitUserToken = $response->get('user_token');
    if($cognifitUserToken){
        // Save this user_token for future requests 
    }
}
```

#### User registration/Associate existing user account

```PHP
use CognifitSdk\Api\UserAccessToken;

$cognifitUserToken          = 'USER_TOKEN';
$cognifitApiUserAccessToken = new UserAccessToken(
    env('COGNIFIT_CLIENT_ID'),
    env('COGNIFIT_CLIENT_SECRET'),
    env('COGNIFIT_API_SANDBOX')
);
$response = $cognifitApiUserAccessToken->issue($cognifitUserToken);
if(!$response->hasError()){
    return $response->get('access_token');
}
```

### User authentication

#### Issue user access token



#### Use access token to access CogniFit


### User manager

#### Update user account
#### User activation
#### User deactivation
#### User grant training subscription
#### User cancel training subscription
#### User account deletion


### Cognitive assessments

#### Assessments list


### Brain training Programs

#### Training list


### Brain Games
#### Brain Game list


### Set training program
#### Login & Launch


### Set tasks program
#### Login & Launch


### Activity and evolution report
#### Get Historical Skills

```PHP
use CognifitSdk\Api\UserActivity;

$cognifitUserToken       = 'USER_TOKEN';
$cognifitApiUserActivity = new UserActivity(
    env('COGNIFIT_CLIENT_ID'),
    env('COGNIFIT_CLIENT_SECRET'),
    env('COGNIFIT_API_SANDBOX')
);
$response = $cognifitApiUserActivity->getHistoricalScoreAndSkills($cognifitUserToken);
if(!$response->hasError()){
    
}

```

#### Get Played Games

```PHP
use CognifitSdk\Api\UserActivity;

$cognifitUserToken       = 'USER_TOKEN';
$cognifitApiUserActivity = new UserActivity(
    env('COGNIFIT_CLIENT_ID'),
    env('COGNIFIT_CLIENT_SECRET'),
    env('COGNIFIT_API_SANDBOX')
);
$response = $cognifitApiUserActivity->getPlayedGames($cognifitUserToken);
if(!$response->hasError()){
    
}
```

