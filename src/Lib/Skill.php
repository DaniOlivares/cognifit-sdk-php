<?php

namespace CognifitSdk\Lib;

class Skill {

    protected $key = '';
    protected $assets = [];

    public function getKey(){
        return $this->key;
    }

    public function getAssets(){
        return $this->assets;
    }

    public static function buildList($data){
        $products = array();
        foreach ($data as $values){
            $products[$values['key']] = new static($values);
        }
        return $products;
    }

    protected function __construct(array $data){
        $this->key      = $data['key'];
        $this->assets   = $data['assets'];
    }

}
