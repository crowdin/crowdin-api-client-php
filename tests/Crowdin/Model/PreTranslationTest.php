<?php

namespace Crowdin\Tests\Model;

use Crowdin\Model\PreTranslation;
use PHPUnit\Framework\TestCase;

/**
 * Class PreTranslationTest
 * @package Crowdin\Tests\Model
 */
class PreTranslationTest extends TestCase
{
    /**
     * @var PreTranslation
     */
    public $preTranslation;

    /**
     * @var array
     */
    public $data = [
        'identifier' => '9e7de270-4f83-41cb-b606-2f90631f26e2',
        'status' => 'created',
        'progress' => 90,
        'attributes' =>
            [
                'languageIds' =>
                    [
                        0 => 'uk',
                    ],
                'fileIds' =>
                    [
                        0 => 0,
                    ],
                'method' => 'tm',
                'autoApproveOption' => 'all',
                'duplicateTranslations' => true,
                'translateUntranslatedOnly' => true,
                'translateWithPerfectMatchOnly' => true,
                'organizationId' => 200000299,
                'projectId' => 2,
                'userId' => 6,
            ],
        'createdAt' => '2019-09-20T14:05:50+00:00',
        'updatedAt' => '2019-09-20T14:05:50+00:00',
        'startedAt' => '2019-11-14T09:29:32Z',
        'finishedAt' => '2019-11-14T09:29:32Z',
        'eta' => '10 seconds',
    ];

    public function setUp()
    {
        parent::setUp();
        $this->preTranslation = new PreTranslation($this->data);
    }

    public function testLoadData()
    {
        $this->assertEquals($this->data['identifier'], $this->preTranslation->getIdentifier());
        $this->assertEquals($this->data['status'], $this->preTranslation->getStatus());
        $this->assertEquals($this->data['progress'], $this->preTranslation->getProgress());
        $this->assertEquals($this->data['attributes'], $this->preTranslation->getAttributes());
        $this->assertEquals($this->data['createdAt'], $this->preTranslation->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->preTranslation->getUpdatedAt());
        $this->assertEquals($this->data['startedAt'], $this->preTranslation->getStartedAt());
        $this->assertEquals($this->data['finishedAt'], $this->preTranslation->getFinishedAt());
        $this->assertEquals($this->data['eta'], $this->preTranslation->getEta());
    }
}
