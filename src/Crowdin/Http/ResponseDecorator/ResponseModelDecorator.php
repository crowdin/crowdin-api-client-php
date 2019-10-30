<?php

namespace Crowdin\Http\ResponseDecorator;

use Crowdin\Model\ModelInterface;

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

    public function decorate($data): ModelInterface
    {
        return new $this->modelName($data);
    }
}
