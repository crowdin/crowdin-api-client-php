<?php

namespace CrowdinApiClient\Tests\Exceptions;

use CrowdinApiClient\Exceptions\ApiValidationException;
use PHPUnit\Framework\TestCase;

class ExceptionsTest extends TestCase
{
    public function testApiValidationExceptionTest()
    {
        $apiValidationException = new ApiValidationException();

        $this->assertInstanceOf(\Exception::class, $apiValidationException);
        $apiValidationException->setErrors([1]);
        $this->assertEquals([1], $apiValidationException->getErrors());
    }

    public function testThrow()
    {
        $this->expectException(\CrowdinApiClient\Exceptions\ApiException::class);
        throw new \CrowdinApiClient\Exceptions\ApiException();
    }

    public function testThrowApiValidationException()
    {
        $this->expectException(\CrowdinApiClient\Exceptions\ApiValidationException::class);
        throw new \CrowdinApiClient\Exceptions\ApiValidationException();
    }

    public function testThrowCrowdinClientException()
    {
        $this->expectException(\CrowdinApiClient\Exceptions\CrowdinClientException::class);
        throw new \CrowdinApiClient\Exceptions\CrowdinClientException();
    }

    public function testThrowHttpException()
    {
        $this->expectException(\CrowdinApiClient\Exceptions\HttpException::class);
        throw new \CrowdinApiClient\Exceptions\HttpException();
    }
}
