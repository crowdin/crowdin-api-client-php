<?php

namespace CrowdinApiClient\Http\ResponseDecorator;

/**
 * @package Crowdin\Http\ResponseDecorator
 * @ignore No documentation will be generated for this class
 */
interface ResponseDecoratorInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function decorate($data);
}
