<?php

namespace CognifitSdk\Api;

use CognifitSdk\Lib\Request;
use CognifitSdk\Lib\Skill;

class Skills extends Request {

    const RESOURCE_PATH  = '/skills';

    public function __construct(string $clientId, $sandbox = false, $projectRegion = 'US'){
        parent::__construct($clientId, '', $sandbox, $projectRegion);
    }

    public function getSkills($locales = array()){
        $resource = self::RESOURCE_PATH . '?client_id=' . $this->clientId;
        $resource .= $this->urlEncodeLocales($locales);
        $response = $this->doRequest($resource, array(), 'GET');
        return Skill::buildList((!$response->hasError()) ? $response->getData() : array());
    }

}
