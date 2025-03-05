<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\PreTranslation;
use PHPUnit\Framework\TestCase;

class PreTranslationTest extends TestCase
{
    public $data = [
        'identifier' => '9e7de270-4f83-41cb-b606-2f90631f26e2',
        'status' => 'created',
        'progress' => 90,
        'attributes' => [
            'languageIds' => [
                'uk',
            ],
            'fileIds' => [
                10,
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
    ];

    public function testLoadData(): void
    {
        $preTranslation = new PreTranslation($this->data);

        $this->assertEquals($this->data['identifier'], $preTranslation->getIdentifier());
        $this->assertEquals($this->data['status'], $preTranslation->getStatus());
        $this->assertEquals($this->data['progress'], $preTranslation->getProgress());
        $this->assertEquals($this->data['attributes'], $preTranslation->getAttributes());
        $this->assertEquals($this->data['createdAt'], $preTranslation->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $preTranslation->getUpdatedAt());
        $this->assertEquals($this->data['startedAt'], $preTranslation->getStartedAt());
        $this->assertEquals($this->data['finishedAt'], $preTranslation->getFinishedAt());
    }

    public function testSetData(): void
    {
        $preTranslation = new PreTranslation($this->data);
        $preTranslation->setStatus('canceled');

        $this->assertSame('canceled', $preTranslation->getStatus());
    }
}
