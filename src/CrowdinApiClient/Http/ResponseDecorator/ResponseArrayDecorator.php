<?php

namespace CrowdinApiClient\Http\ResponseDecorator;

/**
 * @package Crowdin\Http\ResponseDecorator
 * @ignore No documentation will be generated for this class
 */
class ResponseArrayDecorator implements ResponseDecoratorInterface
{
    public function decorate($data): array
    {
        return $data;
    }
}
