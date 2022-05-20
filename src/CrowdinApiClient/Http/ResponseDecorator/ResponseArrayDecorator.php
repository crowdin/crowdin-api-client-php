<?php

namespace CrowdinApiClient\Http\ResponseDecorator;

/**
 * Class ResponseArrayDecorator
 * @package Crowdin\Http\ResponseDecorator
 * @internal
 */
class ResponseArrayDecorator implements ResponseDecoratorInterface
{
    /**
     * @param $data
     * @return array
     */
    public function decorate($data): array
    {
        return $data;
    }
}
