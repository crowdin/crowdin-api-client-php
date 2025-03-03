<?php

namespace CrowdinApiClient\Http\ResponseDecorator;

/**
 * @package Crowdin\Http\ResponseDecorator
 * @internal
 */
class ResponseArrayDecorator implements ResponseDecoratorInterface
{
    public function decorate($data): array
    {
        return $data;
    }
}
