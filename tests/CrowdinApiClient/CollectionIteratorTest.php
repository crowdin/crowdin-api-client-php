<?php

namespace CrowdinApiClient\Tests;

use CrowdinApiClient\CollectionIterator;
use Iterator;
use PHPUnit\Framework\TestCase;

class CollectionIteratorTest extends TestCase
{
    public function testInit()
    {
        $collection = new CollectionIterator(['one', 'two']);

        $this->assertInstanceOf(Iterator::class, $collection);
        $this->assertEquals('one', $collection->current());
        $this->assertEquals(0, $collection->key());
        $this->assertTrue($collection->valid());
        $this->assertEquals('two', $collection->next());
        $collection->rewind();
        $this->assertEquals('one', $collection->current());
    }
}
