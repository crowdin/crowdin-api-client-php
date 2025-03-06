<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 * @ignore No documentation will be generated for this class
 */
class BaseModel implements ModelInterface
{
    /**
     * @var array
     */
    protected $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return null|mixed
     */
    public function getDataProperty(string $property)
    {
        return $this->data[$property] ?? null;
    }

    public function getProperties(): array
    {
        return get_object_vars($this);
    }
}
