<?php

namespace CognifitSdk\Lib\Products;

class ProductInterface {

    protected $key = '';

    public function getKey(){
        return $this->key;
    }

    public static function buildList($data){
        $products = array();
        foreach ($data as $values){
            $products[$values['key']] = new self($values);
        }
        return $products;
    }

    protected function __construct(array $data){
        $this->key = $data['key'];
    }

}
