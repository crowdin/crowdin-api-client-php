<?php

namespace CrowdinApiClient\Http;

use InvalidArgumentException;

/**
 * @package CrowdinApiClient\Http
 * @ignore No documentation will be generated for this class
 */
class ResponseErrorHandlerFactory
{
    /**
     * @param ResponseErrorHandlerInterface|null|mixed $handler
     */
    public static function make($handler = null): ResponseErrorHandlerInterface
    {
        if ($handler === null) {
            return new ResponseErrorHandler();
        }

        if ($handler instanceof ResponseErrorHandlerInterface) {
            return $handler;
        }

        throw new InvalidArgumentException('Response error handler not instanceof ResponseErrorHandlerInterface');
    }
}
