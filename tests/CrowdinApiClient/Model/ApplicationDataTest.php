<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\ApplicationData;
use PHPUnit\Framework\TestCase;

class ApplicationDataTest extends TestCase
{
    protected $model;

    protected function setUp(): void
    {
        $this->model = new ApplicationData([
            'key' => 'value',
            'count' => 42,
            'nested' => ['a' => 1],
        ]);
    }

    public function testGetData(): void
    {
        $this->assertEquals([
            'key' => 'value',
            'count' => 42,
            'nested' => ['a' => 1],
        ], $this->model->getData());
    }

    public function testGetDataProperty(): void
    {
        $this->assertEquals('value', $this->model->getDataProperty('key'));
        $this->assertEquals(42, $this->model->getDataProperty('count'));
        $this->assertEquals(['a' => 1], $this->model->getDataProperty('nested'));
        $this->assertNull($this->model->getDataProperty('missing'));
    }
}
