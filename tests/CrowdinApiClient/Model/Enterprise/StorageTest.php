<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\Storage;
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
        'id' => 1
    ];

    public function setUp()
    {
        parent::setUp();
        $this->storage = new Storage($this->data);
    }

    public function testLoadData()
    {
        $this->assertEquals($this->data['id'], $this->storage->getId());

        $this->storage = new Storage();
        $this->storage->setId($this->data['id']);

        $this->assertEquals($this->data['id'], $this->storage->getId());
    }
}
