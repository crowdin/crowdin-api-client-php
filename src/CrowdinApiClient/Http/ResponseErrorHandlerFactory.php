<?php

namespace CrowdinApiClient\Http;

use InvalidArgumentException;

class ResponseErrorHandlerFactory
{
    /**
     * @param ResponseErrorHandlerInterface|null|mixed $handler
     * @return ResponseErrorHandlerInterface
     */
    public static function make($handler = null): ResponseErrorHandlerInterface
    {
        if ($handler === null) {
            return new ResponseErrorHandler();
        }

        if ($handler instanceof ResponseErrorHandlerInterface) {
            return  $handler;
        }

        throw new InvalidArgumentException('Response error handler not instanceof ResponseErrorHandlerInterface');
    }
}
