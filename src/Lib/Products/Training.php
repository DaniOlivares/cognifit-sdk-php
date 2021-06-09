<?php

namespace CognifitSdk\Lib\Products;

class Training extends ProductInterface{

    private $name   = '';
    private $tasks = [];

    public function getName(){
        return $this->name;
    }

    public function getTasks(){
        return $this->tasks;
    }

    protected function __construct(array $data){
        parent::__construct($data);
        $this->name     = $data['name'];
        $this->tasks    = $data['tasks'];
    }

}
