<?php

namespace CrowdinApiClient\Http\ResponseDecorator;

use CrowdinApiClient\Model\ModelInterface;

/**
 * @package Crowdin\Http\ResponseDecorator
 * @internal
 */
class ResponseModelDecorator implements ResponseDecoratorInterface
{
    /**
     * @var string
     */
    protected $modelName;

    public function __construct(string $modelName)
    {
        $this->modelName = $modelName;
    }

    public function decorate($data): ModelInterface
    {
        return new $this->modelName($data);
    }
}
