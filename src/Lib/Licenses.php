<?php

namespace CognifitSdk\Lib;

use phpDocumentor\Reflection\Types\Boolean;

class Licenses {

    const ASSESSMENT    = 'assessment';
    const TRAINING      = 'training';

    private array $data;

    public function __construct(array $licensesData){
        $this->data = $licensesData;
    }

    public function getPendingAssessmentLicenses(){
        $pending = array();
        foreach ($this->data['assessment'] as $assessmentKey => $assessmentLicenses){
            if($assessmentLicenses['unused']){
                $pending[$assessmentKey] = $assessmentLicenses['unused'];
            }
        }
        return $pending;
    }

    public function getUsedAssessmentLicenses(){
        $pending = array();
        foreach ($this->data['assessment'] as $assessmentKey => $assessmentLicenses){
            if($assessmentLicenses['used']){
                $pending[$assessmentKey] = $assessmentLicenses['used'];
            }
        }
        return $pending;
    }

    public function isActiveTrainingLicense(): bool{
        return (isset($this->data['training']['active_renewal'])
            && isset($this->data['training']['expiration_date'])
            && $this->data['training']['active_renewal']
            && $this->data['training']['expiration_date'] >= date("Y-m-d")
        );
    }

    public function getTrainingExpirationDate(): string{
        return (isset($this->data['training']['expiration_date'])) ? $this->data['training']['expiration_date'] : '';
    }

}
