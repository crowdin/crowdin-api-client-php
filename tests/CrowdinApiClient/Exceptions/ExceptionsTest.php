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

    /**
     * @expectedException \CrowdinApiClient\Exceptions\ApiException
     */
    public function testThrow()
    {
        throw new \CrowdinApiClient\Exceptions\ApiException();
    }

    /**
     * @expectedException \CrowdinApiClient\Exceptions\ApiValidationException
     */
    public function testThrowApiValidationException()
    {
        throw new \CrowdinApiClient\Exceptions\ApiValidationException();
    }

    /**
     * @expectedException \CrowdinApiClient\Exceptions\CrowdinClientException
     */
    public function testThrowCrowdinClientException()
    {
        throw new \CrowdinApiClient\Exceptions\CrowdinClientException();
    }

    /**
     * @expectedException \CrowdinApiClient\Exceptions\HttpException
     */
    public function testThrowHttpException()
    {
        throw new \CrowdinApiClient\Exceptions\HttpException();
    }
}
