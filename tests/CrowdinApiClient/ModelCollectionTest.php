<?php

namespace CrowdinApiClient\Tests;

use CrowdinApiClient\Collection;
use CrowdinApiClient\ModelCollection;
use PHPUnit\Framework\TestCase;

class ModelCollectionTest extends TestCase
{
    public function test(): void
    {
        $modelCollection = new ModelCollection();
        $this->assertInstanceOf(Collection::class, $modelCollection);

        $modelCollection->setPagination([1]);
        $this->assertEquals([1], $modelCollection->getPagination());
    }
}
