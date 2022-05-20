<?php

namespace CrowdinApiClient\Tests\Http;

use CrowdinApiClient\Http\ResponseErrorHandler;
use CrowdinApiClient\Http\ResponseErrorHandlerFactory;
use CrowdinApiClient\Http\ResponseErrorHandlerInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class ResponseErrorHandlerFactoryTest
 * @package CrowdinApiClient\Tests\Http
 */
class ResponseErrorHandlerFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function testFactory()
    {
        $this->assertInstanceOf(ResponseErrorHandler::class, ResponseErrorHandlerFactory::make());
        $this->assertInstanceOf(ResponseErrorHandlerInterface::class, ResponseErrorHandlerFactory::make());
        $this->assertInstanceOf(ResponseErrorHandlerInterface::class, ResponseErrorHandlerFactory::make(new ResponseErrorHandler()));
    }

    public function testException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->assertInstanceOf(ResponseErrorHandlerInterface::class, ResponseErrorHandlerFactory::make('none'));
    }
}
