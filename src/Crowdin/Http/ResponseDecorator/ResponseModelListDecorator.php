<?php

namespace Crowdin\Http\ResponseDecorator;

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
     * ResponseModelDecorator constructor.
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
    public function decorate($data):array
    {
        //TODO collections
        $_items = [];

        foreach ($data as $item)
        {
            $_items[] = new $this->modelName($item['data']);
        }

        return  $_items;
    }
}
