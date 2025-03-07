<?php

namespace CrowdinApiClient\Http\ResponseDecorator;

use CrowdinApiClient\ModelCollection;

/**
 * @package Crowdin\Http\ResponseDecorator
 * @ignore No documentation will be generated for this class
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
