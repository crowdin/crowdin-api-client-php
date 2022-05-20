<?php

namespace CrowdinApiClient\Tests\Http;

use CrowdinApiClient\Http\ResponseErrorHandler;
use PHPUnit\Framework\TestCase;

class ResponseErrorHandlerTest extends TestCase
{
    public $responseErrorHandler;

    public function setUp(): void
    {
        parent::setUp();
        $this->responseErrorHandler = new ResponseErrorHandler();
    }

    public function testCheckValidationException()
    {
        $this->expectException(\CrowdinApiClient\Exceptions\ApiValidationException::class);
        $this->responseErrorHandler->check([
            'errors' => []
        ]);
    }

    public function testCheckException()
    {
        $this->expectException(\CrowdinApiClient\Exceptions\ApiException::class);
        $this->responseErrorHandler->check([
            'error' => [
                'message' => 'Not found',
                'code' => 404
            ]
        ]);
    }
}
