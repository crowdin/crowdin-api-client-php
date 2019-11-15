<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Vendor;
use PHPUnit\Framework\TestCase;

/**
 * Class VendorTest
 * @package Crowdin\Tests\Model
 */
class VendorTest extends TestCase
{
    public $vendor;

    public $data = [
        'id' => 52760,
        'name' => 'John Smith Translation Agency',
        'description' => 'John Smith Translation Agency provides services for software and game localization as well as translation into 70+ languages.',
        'status' => 'pending',
    ];

    public function setUp()
    {
        parent::setUp();
        $this->vendor = new Vendor($this->data);
    }

    public function testLoadData()
    {
        $this->assertEquals($this->data['id'], $this->vendor->getId());
        $this->assertEquals($this->data['name'], $this->vendor->getName());
        $this->assertEquals($this->data['description'], $this->vendor->getDescription());
        $this->assertEquals($this->data['status'], $this->vendor->getStatus());
    }
}
