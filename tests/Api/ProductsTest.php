<?php

use PHPUnit\Framework\TestCase;

use CognifitSdk\Api\Product;

class ProductsTest extends TestCase {

    public function testGetAssessments()
    {
        $product     = new Product('341972f281d4a507255b15e9cc050eb7', 'FAKE_SECRET_ID', true);
        $assessments = $product->getAssessments();
        $this->assertArrayHasKey('GENERAL_ASSESSMENT', $assessments);
        foreach ($assessments as $assessmentKey => $assessment){
            $this->assertEquals($assessmentKey, $assessment->getKey());
        }
    }

    public function testGetTraning()
    {
        $product   = new Product('341972f281d4a507255b15e9cc050eb7', 'FAKE_SECRET_ID', true);
        $trainings = $product->getTraining();
        $this->assertArrayHasKey('NORMAL', $trainings);
        foreach ($trainings as $trainingKey => $training){
            $this->assertEquals($trainingKey, $training->getKey());
        }
    }

    public function testGetGames()
    {
        $product    = new Product('341972f281d4a507255b15e9cc050eb7', 'FAKE_SECRET_ID', true);
        $games      = $product->getGames();
        $this->assertArrayHasKey('MAHJONG', $games);
        foreach ($games as $gameKey => $game){
            $this->assertEquals($gameKey, $game->getKey());
        }
    }

}
