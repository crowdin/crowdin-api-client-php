<?php

namespace CrowdinApiClient\Http\ResponseDecorator;

/**
 * @package Crowdin\Http\ResponseDecorator
 * @internal
 */
interface ResponseDecoratorInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function decorate($data);
}
