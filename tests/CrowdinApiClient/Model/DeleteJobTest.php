<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\DeleteJob;
use PHPUnit\Framework\TestCase;

class DeleteJobTest extends TestCase
{
    /**
     * @var array
     */
    public $data = [
        'identifier' => '50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
        'status' => 'failed',
        'progress' => 50,
        'attributes' => [
            'fileId' => 44,
        ],
        'createdAt' => '2019-09-23T11:26:54+00:00',
        'updatedAt' => '2019-09-23T11:26:56+00:00',
        'startedAt' => '2019-09-23T11:26:55+00:00',
        'finishedAt' => null,
        'error' => [
            'message' => 'The file could not be deleted.',
        ],
    ];

    public function testLoadData(): void
    {
        $deleteJob = new DeleteJob($this->data);

        $this->assertEquals($this->data['identifier'], $deleteJob->getIdentifier());
        $this->assertEquals($this->data['status'], $deleteJob->getStatus());
        $this->assertEquals($this->data['progress'], $deleteJob->getProgress());
        $this->assertEquals($this->data['attributes'], $deleteJob->getAttributes());
        $this->assertEquals($this->data['createdAt'], $deleteJob->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $deleteJob->getUpdatedAt());
        $this->assertEquals($this->data['startedAt'], $deleteJob->getStartedAt());
        $this->assertEquals($this->data['finishedAt'], $deleteJob->getFinishedAt());
        $this->assertEquals($this->data['error'], $deleteJob->getError());
    }

    public function testLoadPendingData(): void
    {
        $deleteJob = new DeleteJob([
            'identifier' => '50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
            'status' => 'created',
            'progress' => 0,
            'attributes' => [
                'branchId' => 34,
            ],
            'createdAt' => '2019-09-23T11:26:54+00:00',
            'updatedAt' => '2019-09-23T11:26:54+00:00',
            'startedAt' => null,
            'finishedAt' => null,
        ]);

        $this->assertNull($deleteJob->getStartedAt());
        $this->assertNull($deleteJob->getFinishedAt());
        $this->assertNull($deleteJob->getError());
    }
}
