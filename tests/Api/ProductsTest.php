<?php

use PHPUnit\Framework\TestCase;

use CognifitSdk\Api\Product;

include_once dirname(__FILE__) . '/../.environment-test.php';

class ProductsTest extends TestCase {

    public function testGetAssessments()
    {
        $product     = new Product(getenv('TEST_CLIENT_ID'), true);
        $assessments = $product->getAssessments();
        $this->assertArrayHasKey('GENERAL_ASSESSMENT', $assessments);
        foreach ($assessments as $assessmentKey => $assessment){
            $this->assertEquals($assessmentKey, $assessment->getKey());
        }
    }

    public function testGetTraning()
    {
        $product   = new Product(getenv('TEST_CLIENT_ID'), true);
        $trainings = $product->getTraining();
        $this->assertArrayHasKey('NORMAL', $trainings);
        foreach ($trainings as $trainingKey => $training){
            $this->assertEquals($trainingKey, $training->getKey());
        }
    }

    public function testGetGames()
    {
        $product    = new Product(getenv('TEST_CLIENT_ID'), true);
        $games      = $product->getGames();
        $this->assertArrayHasKey('MAHJONG', $games);
        foreach ($games as $gameKey => $game){
            $this->assertEquals($gameKey, $game->getKey());
        }
    }

}
