<?php
namespace China\Api;

use PHPUnit\Framework\TestCase;

use CognifitSdk\Api\Product;

include_once dirname(__FILE__) . '/../../.environment-test.php';

class ProductsTest extends TestCase {

    public function testGetAssessments()
    {
        $product     = new Product(getenv('TEST_CLIENT_ID_CHINA'), true, 'CHINA');
        $assessments = $product->getAssessments();
        $this->assertArrayHasKey('GENERAL_ASSESSMENT', $assessments);
        $this->assertArrayNotHasKey('VISUAL_EPISODIC_TASK_ASSESSMENT', $assessments);
        foreach ($assessments as $assessmentKey => $assessment){
            $this->assertInstanceOf('CognifitSdk\Lib\Products\Assessment', $assessment);
            $this->assertEquals($assessmentKey, $assessment->getKey());
            $this->assertIsArray($assessment->getSkills());
            $this->assertIsArray($assessment->getAssets());
            $this->assertIsInt($assessment->getEstimatedTime());
            $this->assertIsArray($assessment->getTasks());
            $this->_validateTitlesAndDescriptionOnlyEnglish($assessment);
            $this->assertArrayHasKey('images', $assessment->getAssets());
            $this->assertArrayHasKey('scareIconZodiac', $assessment->getAssets()['images']);
            $this->assertGreaterThan(0, $assessment->getEstimatedTime());
            $this->assertIsString($assessment->getTasks()[0]);
            $this->assertNotEquals('', $assessment->getTasks()[0]);
        }
    }

    public function testGetAssessmentTasks()
    {
        $product     = new Product(getenv('TEST_CLIENT_ID_CHINA'), true, 'CHINA');
        $assessments = $product->getAssessmentTasks();
        // TODO Add assessment task for China
        $this->assertCount(0, $assessments);
        /*
        $this->assertArrayHasKey('VISUAL_EPISODIC_TASK_ASSESSMENT', $assessments);
        $this->assertArrayNotHasKey('GENERAL_ASSESSMENT', $assessments);
        foreach ($assessments as $assessmentKey => $assessment){
            $this->assertInstanceOf('CognifitSdk\Lib\Products\Assessment', $assessment);
            $this->assertEquals($assessmentKey, $assessment->getKey());
            $this->assertIsArray($assessment->getSkills());
            $this->assertIsArray($assessment->getAssets());
            $this->assertIsInt($assessment->getEstimatedTime());
            $this->assertIsArray($assessment->getTasks());
            $this->_validateTitlesAndDescriptionOnlyEnglish($assessment);
            $this->assertArrayHasKey('images', $assessment->getAssets());
            $this->assertArrayHasKey('scareIconZodiac', $assessment->getAssets()['images']);
            $this->assertGreaterThan(0, $assessment->getEstimatedTime());
            $this->assertIsString($assessment->getTasks()[0]);
            $this->assertNotEquals('', $assessment->getTasks()[0]);
        }
        */
    }

    public function testGetTraining()
    {
        $product   = new Product(getenv('TEST_CLIENT_ID_CHINA'), true, 'CHINA');
        $trainings = $product->getTraining();
        $this->assertArrayHasKey('NORMAL', $trainings);
        foreach ($trainings as $trainingKey => $training){
            $this->assertInstanceOf('CognifitSdk\Lib\Products\Training', $training);
            $this->assertEquals($trainingKey, $training->getKey());
            $this->assertIsString($training->getName());
            $this->assertNotEquals('', $training->getName());
            $this->assertIsArray($training->getTasks());
            $this->assertIsArray($training->getSkills());
            $this->assertIsArray($training->getAssets());
            $this->_validateTitlesAndDescriptionOnlyEnglish($training);
            $this->assertArrayHasKey('images', $training->getAssets());
            $this->assertArrayHasKey('scareIconZodiac', $training->getAssets()['images']);
        }
    }

    public function testGetGames()
    {
        $product    = new Product(getenv('TEST_CLIENT_ID_CHINA'), true, 'CHINA');
        $games      = $product->getGames();
        $this->assertArrayHasKey('MAHJONG', $games);
        foreach ($games as $gameKey => $game){
            $this->assertInstanceOf('CognifitSdk\Lib\Products\Game', $game);
            $this->assertEquals($gameKey, $game->getKey());
            $this->assertIsArray($game->getSkills());
            $this->assertIsArray($game->getAssets());
            $this->_validateTitlesAndDescriptionOnlyEnglish($game);
            $this->assertArrayHasKey('images', $game->getAssets());
            $this->assertArrayHasKey('icon', $game->getAssets()['images']);
        }
    }

    public function testGetQuestionnaires()
    {
        $product        = new Product(getenv('TEST_CLIENT_ID_CHINA'), true, 'CHINA');
        $questionnaires = $product->getQuestionnaires();
        // TODO Add questionnaire for China
        $this->assertCount(0, $questionnaires);
        /*
        $this->assertArrayHasKey('PHQ2_QUESTIONNAIRE_ASSESSMENT', $questionnaires);
        foreach ($questionnaires as $questionnaireKey => $questionnaire){
            $this->assertInstanceOf('CognifitSdk\Lib\Products\Questionnaire', $questionnaire);
            $this->assertEquals($questionnaireKey, $questionnaire->getKey());
            $this->assertIsArray($questionnaire->getSkills());
            $this->assertIsArray($questionnaire->getAssets());
            $this->_validateTitlesAndDescriptionOnlyEnglish($questionnaire);
            $this->assertArrayHasKey('images', $questionnaire->getAssets());
            $this->assertArrayHasKey('scareIconZodiac', $questionnaire->getAssets()['images']);
        }
        */
    }

    public function testGetAssessmentsWithLocales()
    {
        $product     = new Product(getenv('TEST_CLIENT_ID_CHINA'), true, 'CHINA');
        $assessments = $product->getAssessments($this->_getTestingLocales());
        $this->assertArrayHasKey('GENERAL_ASSESSMENT', $assessments);
        $this->assertArrayNotHasKey('VISUAL_EPISODIC_TASK_ASSESSMENT', $assessments);
        foreach ($assessments as $assessmentKey => $assessment){
            $this->assertInstanceOf('CognifitSdk\Lib\Products\Assessment', $assessment);
            $this->assertEquals($assessmentKey, $assessment->getKey());
            $this->assertIsArray($assessment->getSkills());
            $this->assertIsArray($assessment->getAssets());
            $this->assertIsInt($assessment->getEstimatedTime());
            $this->assertIsArray($assessment->getTasks());
            $this->_validateTitlesAndDescriptionTestingLocales($assessment);
            $this->assertArrayHasKey('images', $assessment->getAssets());
            $this->assertArrayHasKey('scareIconZodiac', $assessment->getAssets()['images']);
            $this->assertGreaterThan(0, $assessment->getEstimatedTime());
            $this->assertIsString($assessment->getTasks()[0]);
            $this->assertNotEquals('', $assessment->getTasks()[0]);
        }
    }

    public function testGetAssessmentTasksWithLocales()
    {
        $product     = new Product(getenv('TEST_CLIENT_ID_CHINA'), true, 'CHINA');
        $assessments = $product->getAssessmentTasks($this->_getTestingLocales());
        // TODO Add assessment task for China
        $this->assertCount(0, $assessments);
        /*
        $this->assertArrayHasKey('VISUAL_EPISODIC_TASK_ASSESSMENT', $assessments);
        $this->assertArrayNotHasKey('GENERAL_ASSESSMENT', $assessments);
        foreach ($assessments as $assessmentKey => $assessment){
            $this->assertInstanceOf('CognifitSdk\Lib\Products\Assessment', $assessment);
            $this->assertEquals($assessmentKey, $assessment->getKey());
            $this->assertIsArray($assessment->getSkills());
            $this->assertIsArray($assessment->getAssets());
            $this->assertIsInt($assessment->getEstimatedTime());
            $this->assertIsArray($assessment->getTasks());
            $this->_validateTitlesAndDescriptionTestingLocales($assessment);
            $this->assertArrayHasKey('images', $assessment->getAssets());
            $this->assertArrayHasKey('scareIconZodiac', $assessment->getAssets()['images']);
            $this->assertGreaterThan(0, $assessment->getEstimatedTime());
            $this->assertIsString($assessment->getTasks()[0]);
            $this->assertNotEquals('', $assessment->getTasks()[0]);
        }
        */
    }

    public function testGetQuestionnairesWithLocales()
    {
        $product        = new Product(getenv('TEST_CLIENT_ID_CHINA'), true, 'CHINA');
        $questionnaires = $product->getQuestionnaires($this->_getTestingLocales());
        // TODO Add questionnaire for China
        $this->assertCount(0, $questionnaires);
        /*
        $this->assertArrayHasKey('PCPTSD5_QUESTIONNAIRE_ASSESSMENT', $questionnaires);
        foreach ($questionnaires as $questionnaireKey => $questionnaire){
            $this->assertInstanceOf('CognifitSdk\Lib\Products\Questionnaire', $questionnaire);
            $this->assertEquals($questionnaireKey, $questionnaire->getKey());
            $this->assertIsArray($questionnaire->getAssets());
            $this->_validateTitlesAndDescriptionTestingLocales($questionnaire);
            $this->assertArrayHasKey('images', $questionnaire->getAssets());
            $this->assertArrayHasKey('scareIconZodiac', $questionnaire->getAssets()['images']);
        }
        */
    }

    public function testGetTrainingWithLocales()
    {
        $product   = new Product(getenv('TEST_CLIENT_ID_CHINA'), true, 'CHINA');
        $trainings = $product->getTraining($this->_getTestingLocales());
        $this->assertArrayHasKey('NORMAL', $trainings);
        foreach ($trainings as $trainingKey => $training){
            $this->assertInstanceOf('CognifitSdk\Lib\Products\Training', $training);
            $this->assertEquals($trainingKey, $training->getKey());
            $this->assertIsString($training->getName());
            $this->assertNotEquals('', $training->getName());
            $this->assertIsArray($training->getTasks());
            $this->assertIsArray($training->getSkills());
            $this->assertIsArray($training->getAssets());
            $this->_validateTitlesAndDescriptionTestingLocales($training);
            $this->assertArrayHasKey('images', $training->getAssets());
            $this->assertArrayHasKey('scareIconZodiac', $training->getAssets()['images']);
        }
    }

    public function testGetGamesWithLocales()
    {
        $product    = new Product(getenv('TEST_CLIENT_ID_CHINA'), true, 'CHINA');
        $games      = $product->getGames($this->_getTestingLocales());
        $this->assertArrayHasKey('MAHJONG', $games);
        foreach ($games as $gameKey => $game){
            $this->assertInstanceOf('CognifitSdk\Lib\Products\Game', $game);
            $this->assertEquals($gameKey, $game->getKey());
            $this->assertIsArray($game->getSkills());
            $this->assertIsArray($game->getAssets());
            $this->_validateTitlesAndDescriptionTestingLocales($game);
            $this->assertArrayHasKey('images', $game->getAssets());
            $this->assertArrayHasKey('icon', $game->getAssets()['images']);
        }
    }

    public function testGetAssessmentsError()
    {
        $product     = new Product('MAKE_CLIENT_ID', true, 'CHINA');
        $assessments = $product->getAssessments();
        $this->assertEmpty($assessments);
    }

    public function testGetAssessmentTaskssError()
    {
        $product     = new Product('MAKE_CLIENT_ID', true, 'CHINA');
        $assessments = $product->getAssessmentTasks();
        $this->assertEmpty($assessments);
    }

    public function testGetQuestionnairesError()
    {
        $product        = new Product('MAKE_CLIENT_ID', true, 'CHINA');
        $questionnaires = $product->getQuestionnaires();
        $this->assertEmpty($questionnaires);
    }

    public function testGetTrainingError()
    {
        $product   = new Product('MAKE_CLIENT_ID', true, 'CHINA');
        $trainings = $product->getTraining();
        $this->assertEmpty($trainings);
    }

    public function testGetGamesError()
    {
        $product    = new Product('MAKE_CLIENT_ID', true, 'CHINA');
        $games      = $product->getGames();
        $this->assertEmpty($games);
    }

    private function _validateTitlesAndDescriptionOnlyEnglish($element){
        $this->assertArrayHasKey('titles', $element->getAssets());
        $this->assertCount(1, $element->getAssets()['titles']);
        $this->assertArrayHasKey('en', $element->getAssets()['titles']);
        $this->assertArrayHasKey('descriptions', $element->getAssets());
        $this->assertCount(1, $element->getAssets()['descriptions']);
        $this->assertArrayHasKey('en', $element->getAssets()['descriptions']);

    }

    private function _validateTitlesAndDescriptionTestingLocales($element){
        $localesCount = count($this->_getTestingLocales());
        $this->assertArrayHasKey('titles', $element->getAssets());
        $this->assertCount($localesCount, $element->getAssets()['titles']);
        $this->assertArrayHasKey('descriptions', $element->getAssets());
        $this->assertCount($localesCount, $element->getAssets()['descriptions']);
        foreach ($this->_getTestingLocales() as $locale){
            $this->assertArrayHasKey($locale, $element->getAssets()['titles']);
            $this->assertArrayHasKey($locale, $element->getAssets()['descriptions']);
        }
    }

    private function _getTestingLocales(): array{
        return ['fr', 'es', 'pt_BR'];
    }

}
