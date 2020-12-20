<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Storage;
use PHPUnit\Framework\TestCase;

/**
 * Class StorageTest
 * @package Crowdin\Tests\Model
 */
class StorageTest extends TestCase
{
    /**
     * @var Storage
     */
    public $storage;

    /**
     * @var array
     */
    public $data = [
        'id' => 1,
        'fileName' => 'tps-tm.tmx'
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->storage = new Storage($this->data);
    }

    public function testLoadData()
    {
        $this->assertEquals($this->data['id'], $this->storage->getId());
        $this->assertEquals($this->data['fileName'], $this->storage->getFileName());
    }
}
