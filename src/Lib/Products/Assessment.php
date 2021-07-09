<?php

namespace CognifitSdk\Lib\Products;

class Assessment extends ProductInterface{

    private $estimatedTime  = 0;
    private $tasks          = [];

    public function getEstimatedTime(){
        return $this->estimatedTime;
    }

    public function getTasks(){
        return $this->tasks;
    }

    protected function __construct(array $data){
        parent::__construct($data);
        $this->tasks            = $data['tasks'];
        $this->estimatedTime    = $data['estimatedTime'];
    }

}
