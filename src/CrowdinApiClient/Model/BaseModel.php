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

    /**
     * Returns the property cast to bool, or null when it is missing or null.
     */
    protected function nullableBool(string $property): ?bool
    {
        return $this->getDataProperty($property) !== null ? (bool)$this->getDataProperty($property) : null;
    }

    /**
     * Returns the property cast to int, or null when it is missing or null.
     */
    protected function nullableInt(string $property): ?int
    {
        return $this->getDataProperty($property) !== null ? (int)$this->getDataProperty($property) : null;
    }

    /**
     * Returns the property cast to float, or null when it is missing or null.
     */
    protected function nullableFloat(string $property): ?float
    {
        return $this->getDataProperty($property) !== null ? (float)$this->getDataProperty($property) : null;
    }

    /**
     * Returns the property cast to string, or null when it is missing or null.
     */
    protected function nullableString(string $property): ?string
    {
        return $this->getDataProperty($property) !== null ? (string)$this->getDataProperty($property) : null;
    }
}
