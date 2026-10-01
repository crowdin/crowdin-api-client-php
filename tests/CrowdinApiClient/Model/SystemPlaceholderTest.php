<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\SystemPlaceholder;
use PHPUnit\Framework\TestCase;

class SystemPlaceholderTest extends TestCase
{
    public function testLoadData(): void
    {
        $placeholder = new SystemPlaceholder([
            'id' => 'printfSpecifier',
            'isEnabled' => true,
            'label' => '%s',
            'examples' => ['%s', '%1$d'],
            'description' => 'printf-style format specifiers',
        ]);

        $this->assertSame('printfSpecifier', $placeholder->getId());
        $this->assertTrue($placeholder->isEnabled());
        $this->assertSame('%s', $placeholder->getLabel());
        $this->assertSame(['%s', '%1$d'], $placeholder->getExamples());
        $this->assertSame('printf-style format specifiers', $placeholder->getDescription());
    }
}
