<?php


namespace Crowdin\Http;

use Crowdin\Http\Client\CrowdinHttpClientInterface;
use Crowdin\Http\Client\CurlHttpClient;
use InvalidArgumentException;

class ResponseErrorHandlerFactory
{
    /**
     * @param ResponseErrorHandlerInterface|null|mixed $handler
     * @return ResponseErrorHandlerInterface
     */
    public static function make($handler): ResponseErrorHandlerInterface
    {
        if (!$handler)
        {
            return new ResponseErrorHandler();

        }elseif ($handler instanceof ResponseErrorHandlerInterface)
        {
            return  $handler;
        }

        throw new InvalidArgumentException('Response error handler not instanceof ResponseErrorHandlerInterface');
    }
}
