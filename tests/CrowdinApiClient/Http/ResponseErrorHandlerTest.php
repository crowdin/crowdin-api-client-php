<?php

namespace CrowdinApiClient\Tests\Http;

use CrowdinApiClient\Http\ResponseErrorHandler;
use PHPUnit\Framework\TestCase;

class ResponseErrorHandlerTest extends TestCase
{
    public $responseErrorHandler;

    public function setUp()
    {
        parent::setUp();
        $this->responseErrorHandler = new ResponseErrorHandler();
    }

    /**
     * @expectedException \CrowdinApiClient\Exceptions\ApiValidationException
     */
    public function testCheckValidationException()
    {
        $this->responseErrorHandler->check([
            'errors' => []
        ]);
    }

    /**
     * @expectedException \CrowdinApiClient\Exceptions\ApiException
     */
    public function testCheckException()
    {
        $this->responseErrorHandler->check([
            'error' => [
                'message' => 'Not found',
                'code' => 404
            ]
        ]);
    }
}
