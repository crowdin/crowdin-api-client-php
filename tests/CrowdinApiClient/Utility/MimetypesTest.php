<?php

namespace CrowdinApiClient\Tests\Utility;

use CrowdinApiClient\Utility\Mimetypes;
use PHPUnit\Framework\TestCase;

/**
 * Class MimetypesTest
 * @package CrowdinApiClient\Tests\Utility
 */
class MimetypesTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(Mimetypes::class, Mimetypes::getInstance());
    }

    public function testGetsFromExtension()
    {
        $this->assertEquals('text/x-php', Mimetypes::getInstance()->fromExtension('php'));
        $this->assertEquals('text/csv', Mimetypes::getInstance()->fromExtension('csv'));
        $this->assertEquals('application/x-tbx', Mimetypes::getInstance()->fromExtension('tbx'));
        $this->assertEquals('application/x-tmx', Mimetypes::getInstance()->fromExtension('tmx'));
    }

    public function testFromFilename()
    {
        $this->assertEquals('text/x-php', Mimetypes::getInstance()->fromFilename(__FILE__));
    }

    public function testGetsFromCaseInsensitiveFilename()
    {
        $this->assertEquals('text/x-php', Mimetypes::getInstance()->fromFilename(strtoupper(__FILE__)));
    }

    public function testReturnsNullWhenNoMatchFound()
    {
        $this->assertNull(Mimetypes::getInstance()->fromExtension('foobar'));
    }
}
