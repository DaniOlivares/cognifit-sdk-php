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

    public function testGetAssessmentsError()
    {
        $product     = new Product('MAKE_CLIENT_ID', true);
        $assessments = $product->getAssessments();
        $this->assertEmpty($assessments);
    }

    public function testGetTraningError()
    {
        $product   = new Product('MAKE_CLIENT_ID', true);
        $trainings = $product->getTraining();
        $this->assertEmpty($trainings);
    }

    public function testGetGamesError()
    {
        $product    = new Product('MAKE_CLIENT_ID', true);
        $games      = $product->getGames();
        $this->assertEmpty($games);
    }

}
