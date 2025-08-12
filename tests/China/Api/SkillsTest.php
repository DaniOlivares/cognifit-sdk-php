<?php
namespace China\Api;

use PHPUnit\Framework\TestCase;

use CognifitSdk\Api\Skills;

include_once dirname(__FILE__) . '/../../.environment-test.php';

class SkillsTest extends TestCase {

    public function testGetSkills()
    {
        $skills     = new Skills(getenv('TEST_CLIENT_ID'), true, 'CHINA');
        $skillList  = $skills->getSkills();
        $this->assertIsArray($skillList);
        foreach ($skillList as $skill){
            $this->assertInstanceOf('CognifitSdk\Lib\Skill', $skill);
            $this->assertIsString($skill->getKey());
            $this->assertNotEquals('', $skill->getKey());
            $this->assertIsArray($skill->getAssets());
            $this->_validateTitlesAndDescriptionOnlyEnglish($skill);
            $this->assertArrayHasKey('images', $skill->getAssets());
            $this->assertArrayHasKey('whiteIcon', $skill->getAssets()['images']);
            $this->assertArrayHasKey('transparentIcon', $skill->getAssets()['images']);
        }
    }

    public function testGetSkillsWithLocales()
    {
        $skills     = new Skills(getenv('TEST_CLIENT_ID_CHINA'), true, 'CHINA');
        $skillList  = $skills->getSkills($this->_getTestingLocales());
        $this->assertIsArray($skillList);
        foreach ($skillList as $skill){
            $this->assertInstanceOf('CognifitSdk\Lib\Skill', $skill);
            $this->assertIsString($skill->getKey());
            $this->assertNotEquals('', $skill->getKey());
            $this->assertIsArray($skill->getAssets());
            $this->_validateTitlesAndDescriptionTestingLocales($skill);
            $this->assertArrayHasKey('images', $skill->getAssets());
            $this->assertArrayHasKey('whiteIcon', $skill->getAssets()['images']);
            $this->assertArrayHasKey('transparentIcon', $skill->getAssets()['images']);
        }
    }

    public function testGetSkillsError()
    {
        $skills     = new Skills(getenv('FAKE_CLIENT_ID'), true, 'CHINA');
        $skillList  = $skills->getSkills($this->_getTestingLocales());
        $this->assertEmpty($skillList);
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
