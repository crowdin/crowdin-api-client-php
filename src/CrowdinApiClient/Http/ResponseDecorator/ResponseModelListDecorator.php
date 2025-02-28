<?php

namespace CrowdinApiClient\Http\ResponseDecorator;

use CrowdinApiClient\ModelCollection;

/**
 * @package Crowdin\Http\ResponseDecorator
 * @internal
 */
class ResponseModelListDecorator implements ResponseDecoratorInterface
{
    /**
     * @var string
     */
    protected $modelName;

    public function __construct(string $modelName)
    {
        $this->modelName = $modelName;
    }

    public function decorate($data): ModelCollection
    {
        $modelCollection = new ModelCollection();

        foreach ($data['data'] as $item) {
            $modelCollection->add(new $this->modelName($item['data']));
        }

        $modelCollection->setPagination($data['pagination']);

        return $modelCollection;
    }
}
