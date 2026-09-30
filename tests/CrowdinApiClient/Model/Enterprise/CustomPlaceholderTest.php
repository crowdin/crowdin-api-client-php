<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\CustomPlaceholder;
use PHPUnit\Framework\TestCase;

class CustomPlaceholderTest extends TestCase
{
    public function testLoadData(): void
    {
        $placeholder = new CustomPlaceholder([
            'id' => 3,
            'description' => 'URL',
            'definition' => 'start, then "http", end',
            'argumentDelimiter' => '"',
        ]);

        $this->assertSame(3, $placeholder->getId());
        $this->assertSame('URL', $placeholder->getDescription());
        $this->assertSame('start, then "http", end', $placeholder->getDefinition());
        $this->assertSame('"', $placeholder->getArgumentDelimiter());
    }

    public function testLoadDataWithoutDescription(): void
    {
        $this->assertNull((new CustomPlaceholder(['id' => 3, 'definition' => 'start, end']))->getDescription());
    }

    public function testSetData(): void
    {
        $placeholder = new CustomPlaceholder();
        $placeholder->setDescription('Web link');
        $placeholder->setDefinition('start, end');
        $placeholder->setArgumentDelimiter("'");

        $this->assertSame('Web link', $placeholder->getDescription());
        $this->assertSame('start, end', $placeholder->getDefinition());
        $this->assertSame("'", $placeholder->getArgumentDelimiter());
    }
}
