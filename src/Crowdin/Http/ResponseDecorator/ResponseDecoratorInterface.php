<?php

namespace Crowdin\Http\ResponseDecorator;

/**
 * Interface ResponseDecoratorInterface
 * @package Crowdin\Http\ResponseDecorator
 */
interface ResponseDecoratorInterface
{
    public function decorate($data);
}
