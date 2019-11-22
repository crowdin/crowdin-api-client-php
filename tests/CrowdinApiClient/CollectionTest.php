<?php

namespace CrowdinApiClient\Tests;

use ArrayAccess;
use Countable;
use CrowdinApiClient\Collection;
use CrowdinApiClient\CollectionIterator;
use IteratorAggregate;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testMain()
    {
        $collection = new Collection();
        $collection->add('test');

        $this->assertInstanceOf(IteratorAggregate::class, $collection);
        $this->assertInstanceOf(ArrayAccess::class, $collection);
        $this->assertInstanceOf(Countable::class, $collection);
        $this->assertInstanceOf(CollectionIterator::class, $collection->getIterator());

        $this->assertFalse($collection->isEmpty());

        $this->assertEquals('test', $collection->offsetGet(0));

        $this->assertNull($collection->offsetGet(1));

        $collection->offsetSet(0, 'test2');
        $this->assertEquals('test2', $collection->offsetGet(0));

        $collection->offsetSet(null, 'test3');
        $collection->offsetUnset(1);
        $this->assertNull($collection->offsetGet(1));
        $this->assertFalse($collection->offsetExists(1));
        $this->assertTrue($collection->offsetExists(0));
    }
}
