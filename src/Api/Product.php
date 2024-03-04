<?php

namespace CognifitSdk\Api;

use CognifitSdk\Lib\Products\Questionnaire;
use CognifitSdk\Lib\Request;
use CognifitSdk\Lib\Products\Assessment;
use CognifitSdk\Lib\Products\Training;
use CognifitSdk\Lib\Products\Game;

class Product extends Request {

    const RESOURCE_PATH_ASSESSMENT      = '/programs/assessments';
    const RESOURCE_PATH_QUESTIONNAIRE   = '/programs/questionnaires';
    const RESOURCE_PATH_TRAINING        = '/programs/trainings';
    const RESOURCE_PATH_GAME            = '/programs/tasks';

    public function __construct(string $clientId, $sandbox = false){
        parent::__construct($clientId, '', $sandbox);
    }

    public function getAssessments($locales = array()){
        $resource = self::RESOURCE_PATH_ASSESSMENT . '?client_id=' . $this->clientId;
        $resource .= $this->urlEncodeLocales($locales);
        $response = $this->doRequest($resource, array(), 'GET');
        return Assessment::buildList((!$response->hasError()) ? $response->getData() : array());
    }

    public function getQuestionnaires($locales = array()){
        $resource = self::RESOURCE_PATH_QUESTIONNAIRE . '?client_id=' . $this->clientId;
        $resource .= $this->urlEncodeLocales($locales);
        $response = $this->doRequest($resource, array(), 'GET');
        return Questionnaire::buildList((!$response->hasError()) ? $response->getData() : array());
    }

    public function getTraining($locales = array()){
        $resource = self::RESOURCE_PATH_TRAINING . '?client_id=' . $this->clientId;
        $resource .= $this->urlEncodeLocales($locales);
        $response = $this->doRequest($resource, array(), 'GET');
        return Training::buildList((!$response->hasError()) ? $response->getData() : array());
    }

    public function getGames($locales = array()){
        $resource = self::RESOURCE_PATH_GAME . '?client_id=' . $this->clientId;
        $resource .= $this->urlEncodeLocales($locales);
        $response = $this->doRequest($resource, array(), 'GET');
        return Game::buildList((!$response->hasError()) ? $response->getData() : array());
    }

}
