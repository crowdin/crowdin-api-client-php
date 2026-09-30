<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\ProjectPlaceholder;
use PHPUnit\Framework\TestCase;

class ProjectPlaceholderTest extends TestCase
{
    public function testLoadData(): void
    {
        $placeholder = new ProjectPlaceholder([
            'id' => 5,
            'customPlaceholderId' => 3,
            'type' => 'high',
            'index' => 1,
            'isBlocking' => true,
            'formats' => ['docbook', 'adoc'],
        ]);

        $this->assertSame(5, $placeholder->getId());
        $this->assertSame(3, $placeholder->getCustomPlaceholderId());
        $this->assertSame('high', $placeholder->getType());
        $this->assertSame(1, $placeholder->getIndex());
        $this->assertTrue($placeholder->getIsBlocking());
        $this->assertSame(['docbook', 'adoc'], $placeholder->getFormats());
    }

    public function testLoadDataWithoutOptionalFields(): void
    {
        $placeholder = new ProjectPlaceholder([]);

        $this->assertNull($placeholder->getId());
        $this->assertNull($placeholder->getCustomPlaceholderId());
        $this->assertNull($placeholder->getType());
        $this->assertNull($placeholder->getIndex());
        $this->assertNull($placeholder->getIsBlocking());
        $this->assertSame([], $placeholder->getFormats());
    }

    public function testSetData(): void
    {
        $placeholder = new ProjectPlaceholder();
        $placeholder->setType('low');
        $placeholder->setIndex(2);
        $placeholder->setIsBlocking(false);
        $placeholder->setFormats(['json']);

        $this->assertSame('low', $placeholder->getType());
        $this->assertSame(2, $placeholder->getIndex());
        $this->assertFalse($placeholder->getIsBlocking());
        $this->assertSame(['json'], $placeholder->getFormats());
    }
}
