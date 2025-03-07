<?php

namespace CrowdinApiClient\Http\ResponseDecorator;

use CrowdinApiClient\Model\ModelInterface;

/**
 * @package Crowdin\Http\ResponseDecorator
 * @ignore No documentation will be generated for this class
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
