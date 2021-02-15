<?php

namespace CognifitSdk\Api;

use CognifitSdk\Lib\Request;
use CognifitSdk\Lib\Products\Assessment;
use CognifitSdk\Lib\Products\Training;
use CognifitSdk\Lib\Products\Game;

class Product extends Request {

    const RESOURCE_PATH_ASSESSMENT  = '/programs/assessments';
    const RESOURCE_PATH_TRAINING    = '/programs/trainings';
    const RESOURCE_PATH_GAME        = '/programs/tasks';

    public function __construct(string $clientId, $sandbox = false){
        parent::__construct($clientId, '', $sandbox);
    }

    public function getAssessments(){
        $resource = self::RESOURCE_PATH_ASSESSMENT . '?client_id=' . $this->clientId;
        $response = $this->doRequest($resource, array(), 'GET');
        return Assessment::buildList((!$response->hasError()) ? $response->getData() : array());
    }

    public function getTraining(){
        $resource = self::RESOURCE_PATH_TRAINING . '?client_id=' . $this->clientId;
        $response = $this->doRequest($resource, array(), 'GET');
        return Training::buildList((!$response->hasError()) ? $response->getData() : array());
    }

    public function getGames(){
        $resource = self::RESOURCE_PATH_GAME . '?client_id=' . $this->clientId;
        $response = $this->doRequest($resource, array(), 'GET');
        return Game::buildList((!$response->hasError()) ? $response->getData() : array());
    }

}
