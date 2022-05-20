<?php

namespace CrowdinApiClient\Http\ResponseDecorator;

use CrowdinApiClient\ModelCollection;

/**
 * Class ResponseModelListDecorator
 * @package Crowdin\Http\ResponseDecorator
 * @internal
 */
class ResponseModelListDecorator implements ResponseDecoratorInterface
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
     * @return ModelCollection
     */
    public function decorate($data): ModelCollection
    {
        $modelCollection = new ModelCollection();

        foreach ($data['data'] as $item) {
            $modelCollection->add(new $this->modelName($item['data']));
        }

        $modelCollection->setPagination($data['pagination']);

        return  $modelCollection;
    }
}
