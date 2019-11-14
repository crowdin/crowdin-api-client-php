<?php

namespace Crowdin\Http\ResponseDecorator;

/**
 * Class ResponseArrayDecorator
 * @package Crowdin\Http\ResponseDecorator
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
