<?php


namespace Crowdin\Model;

/**
 * Class BaseModel
 * @package Crowdin\Model
 */
class BaseModel implements ModelInterface
{

    /**
     * @var string
     */
    protected $pk = 'id';

    /**
     * Model Data
     *
     * @var array
     */
    protected $data;

    /**
     * Create a new Model instance
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getPk()
    {
        return $this->{$this->pk};
    }

    /**
     * Get the Model data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get Data Property
     *
     * @param  string $property
     *
     * @return mixed
     */
    public function getDataProperty($property)
    {
        return isset($this->data[$property]) ? $this->data[$property] : null;
    }

    /**
     * @return array
     */
    public function getProperties()
    {
        return get_object_vars($this);
    }
}
