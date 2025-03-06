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
    public function testMain(): void
    {
        $collection = new Collection();

        $this->assertTrue($collection->isEmpty());

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

    public function testCollectionToArray(): void
    {
        $collection = new Collection();
        $collection->add('foo');
        $collection->add('bar');
        $collection->add('baz');

        $this->assertIsArray($collection->__toArray());
        $this->assertCount(3, $collection->__toArray());
    }
}
