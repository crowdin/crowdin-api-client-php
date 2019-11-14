<?php


namespace Crowdin\Tests\Model;


use Crowdin\Model\MachineTranslationEngine;
use PHPUnit\Framework\TestCase;

class MachineTranslationEngineTest extends TestCase
{
    public $machineTranslationEngine;

    public $data = [
        'id' => 2,
        'groupId' => 2,
        'name' => 'Crowdin Translate (beta)',
        'type' => 'crowdin',
        'credentials' => [
                'crowdin_nmt' => 1,
                'crowdin_nmt_multi_translations' => 1,
            ],
        'projectIds' => [1],
    ];

    public function setUp()
    {
        parent::setUp();
        $this->machineTranslationEngine = new MachineTranslationEngine($this->data);
    }

    public function testLoadData()
    {
        $this->assertEquals($this->data['id'], $this->machineTranslationEngine->getId());
        $this->assertEquals($this->data['groupId'], $this->machineTranslationEngine->getGroupId());
        $this->assertEquals($this->data['name'], $this->machineTranslationEngine->getName());
        $this->assertEquals($this->data['type'], $this->machineTranslationEngine->getType());
        $this->assertEquals($this->data['credentials'], $this->machineTranslationEngine->getCredentials());
        $this->assertEquals($this->data['projectIds'], $this->machineTranslationEngine->getProjectIds());
    }
}
