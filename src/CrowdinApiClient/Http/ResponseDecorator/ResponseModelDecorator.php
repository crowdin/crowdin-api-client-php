<?php

namespace CrowdinApiClient\Http\ResponseDecorator;

use CrowdinApiClient\Model\ModelInterface;

/**
 * Class ResponseModelDecorator
 * @package Crowdin\Http\ResponseDecorator
 * @internal
 */
class ResponseModelDecorator implements ResponseDecoratorInterface
{
    /**
     * @var string
     */
    protected $modelName;

    /**
     * @param string $modelName
     */
    public function __construct(string $modelName)
    {
        $this->modelName = $modelName;
    }

    /**
     * @param $data
     * @return ModelInterface
     */
    public function decorate($data): ModelInterface
    {
        return new $this->modelName($data);
    }
}
