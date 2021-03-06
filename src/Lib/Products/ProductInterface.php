<?php

namespace CognifitSdk\Lib\Products;

class ProductInterface {

    protected $key = '';
    protected $skills = [];
    protected $assets = [];

    public function getKey(){
        return $this->key;
    }

    public function getSkills(){
        return $this->skills;
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
        $this->skills   = $data['skills'];
        $this->assets   = $data['assets'];
    }

}
