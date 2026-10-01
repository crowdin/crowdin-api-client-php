<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\StringTranslation;
use PHPUnit\Framework\TestCase;

class StringTranslationTest extends TestCase
{
    /**
     * @var StringTranslation
     */
    public $stringTranslation;

    /**
     * @var array
     */
    public $data = [
        'id' => 190695,
        'text' => 'Цю стрічку перекладено',
        'pluralCategoryName' => 'few',
        'user' =>
            [
                'id' => 19,
                'login' => 'john_doe',
            ],
        'rating' => 10,
        'createdAt' => '2019-09-19T12:42:12+00:00'
    ];

    public function testLoadData()
    {
        $this->stringTranslation = new StringTranslation($this->data);
        $this->stringTranslation->setId($this->data['id']);
        $this->stringTranslation->setText($this->data['text']);
        $this->stringTranslation->setPluralCategoryName($this->data['pluralCategoryName']);
        $this->stringTranslation->setUser($this->data['user']);
        $this->stringTranslation->setRating($this->data['rating']);
        $this->stringTranslation->setCreatedAt($this->data['createdAt']);
        $this->checkData();
    }

    public function testLoadSearchData(): void
    {
        $stringTranslation = new StringTranslation([
            'projectId' => 2,
            'stringId' => 2814,
            'languageId' => 'uk',
        ]);

        $this->assertEquals(2, $stringTranslation->getProjectId());
        $this->assertEquals(2814, $stringTranslation->getStringId());
        $this->assertEquals('uk', $stringTranslation->getLanguageId());
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->stringTranslation->getId());
        $this->assertEquals($this->data['text'], $this->stringTranslation->getText());
        $this->assertEquals($this->data['pluralCategoryName'], $this->stringTranslation->getPluralCategoryName());
        $this->assertEquals($this->data['user'], $this->stringTranslation->getUser());
        $this->assertEquals($this->data['rating'], $this->stringTranslation->getRating());
        $this->assertEquals($this->data['createdAt'], $this->stringTranslation->getCreatedAt());
    }

    public function testLoadAdditionalFields(): void
    {
        $model = new StringTranslation([
            'isPreTranslated' => true,
            'matchRate' => 7,
            'matchType' => 'value',
            'provider' => 'value',
            'providerId' => 7,
            'url' => 'value',
            'workflowStepId' => 7,
        ]);

        $this->assertSame(true, $model->isPreTranslated());
        $this->assertSame(7, $model->getMatchRate());
        $this->assertSame('value', $model->getMatchType());
        $this->assertSame('value', $model->getProvider());
        $this->assertSame(7, $model->getProviderId());
        $this->assertSame('value', $model->getUrl());
        $this->assertSame(7, $model->getWorkflowStepId());
    }

    public function testAdditionalFieldsWhenMissing(): void
    {
        $model = new StringTranslation([]);

        $this->assertSame(false, $model->isPreTranslated());
        $this->assertNull($model->getMatchRate());
        $this->assertNull($model->getMatchType());
        $this->assertNull($model->getProvider());
        $this->assertNull($model->getProviderId());
        $this->assertNull($model->getUrl());
        $this->assertNull($model->getWorkflowStepId());
    }

    public function testCreatedAtIsHydrated(): void
    {
        $model = new StringTranslation(['createdAt' => '2026-01-01T00:00:00+00:00']);

        $this->assertSame('2026-01-01T00:00:00+00:00', $model->getCreatedAt());
    }
}
