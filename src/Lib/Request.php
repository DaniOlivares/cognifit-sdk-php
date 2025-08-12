<?php

namespace CognifitSdk\Lib;

class Request {
	
	protected   string $clientId;
    private     string $clientSecret;
	private     string $sandbox;
    private     string $projectRegion;

	public function __construct(string $clientId, string $clientSecret, $sandbox = false, string $projectRegion = 'US'){
		$this->clientId 	= $clientId;
		$this->clientSecret = $clientSecret;
		$this->sandbox 		= $sandbox;
        $this->projectRegion = $projectRegion;
	}
	
	protected function doRequest($resourcePath, $bodyParams, $method = 'POST'){
		
		$curl = curl_init();

		$headers = [
			"Content-Type: application/json",
			"cache-control: no-cache",
			"User-Agent: Cognifit SDK"
		];

		$domain = $this->getDomain();

		curl_setopt_array($curl, [
		  CURLOPT_URL 				=> $domain . $resourcePath,
		  CURLOPT_RETURNTRANSFER 	=> true,
		  CURLOPT_ENCODING 			=> '',
		  CURLOPT_MAXREDIRS 		=> 10,
		  CURLOPT_TIMEOUT 			=> 30,
		  CURLOPT_HTTP_VERSION 		=> CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST 	=> $method,
		  CURLOPT_HTTPHEADER 		=> $headers
		]);

        if($method !== 'GET'){
            $bodyParams['client_id'] 		= $this->clientId;
            $bodyParams['client_secret'] 	= $this->clientSecret;
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($bodyParams));
        }
		
		$response 	= curl_exec($curl);
		$err 		= curl_error($curl);
		$status		= curl_getinfo($curl, CURLINFO_HTTP_CODE);
		
		curl_close($curl);

		if ($err) {
			return new Response([
				'error' 		=> $err,
				'errorMessage'	=> 'Curl Error #:' . $err
			]);
		}
		
		if ($status !== 200) {
			return new Response([
				'error' 		=> $status,
				'errorMessage'	=> 'Curl status error #:' . $status
			]);
		}
		
		return new Response(json_decode($response, true));
		
		
	}

    protected function getDomain(){
        if($this->projectRegion === 'CHINA'){
            return 'https://api.braintraining.cn';
        }

        if($this->sandbox){
            return 'https://preapi.cognifit.com';
        }

        return 'https://api.cognifit.com';
    }

    protected function getDomainFrontend(){

        if($this->projectRegion === 'CHINA'){
            return 'https://www.braintraining.cn';
        }

        if($this->sandbox){
            return 'https://preprod.cognifit.com';
        }

        return 'https://www.cognifit.com';
    }

    protected function urlEncodeLocales($locales){
        $str = '';
        if($locales){
            foreach ($locales as $locale){
                $str .= '&locales[]=' . $locale;
            }
        }
        return $str;
    }

}
