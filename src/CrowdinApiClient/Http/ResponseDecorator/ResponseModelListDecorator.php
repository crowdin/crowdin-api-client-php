<?php

namespace CrowdinApiClient\Http\ResponseDecorator;

/**
 * Class ResponseModelListDecorator
 * @package Crowdin\Http\ResponseDecorator
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
     * @return array
     */
    public function decorate($data): array
    {
        $_items = [];

        foreach ($data as $item) {
            $_items[] = new $this->modelName($item['data']);
        }

        return  $_items;
    }
}
