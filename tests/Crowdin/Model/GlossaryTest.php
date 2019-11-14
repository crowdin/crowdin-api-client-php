<?php


namespace Crowdin\Tests\Model;


use Crowdin\Model\Glossary;
use PHPUnit\Framework\TestCase;

class GlossaryTest extends TestCase
{
    /**
     * @var Glossary
     */
    public $glossary;

    /**
     * @var array
     */
    public $data = [
        'id' => 2,
        'name' => 'Be My Eyes iOS\'s Glossary',
        'groupId' => 2,
        'userId' => 2,
        'terms' => 25,
        'languageIds' => ['ro'],
        'projectIds' =>[6],
        'createdAt' => '2019-09-16T13:42:04+00:00',
    ];


    public function setUp()
    {
        parent::setUp();
        $this->glossary = new Glossary($this->data);
    }

    /**
     * @test
     */
    public function testLoadData()
    {
        $this->assertEquals($this->data['id'], $this->glossary->getId());
        $this->assertEquals($this->data['name'], $this->glossary->getName());
        $this->assertEquals($this->data['groupId'], $this->glossary->getGroupId());
        $this->assertEquals($this->data['userId'], $this->glossary->getUserId());
        $this->assertEquals($this->data['terms'], $this->glossary->getTerms());
        $this->assertEquals($this->data['languageIds'], $this->glossary->getLanguageIds());
        $this->assertEquals($this->data['projectIds'], $this->glossary->getProjectIds());
        $this->assertEquals($this->data['createdAt'], $this->glossary->getCreatedAt());
    }
}
