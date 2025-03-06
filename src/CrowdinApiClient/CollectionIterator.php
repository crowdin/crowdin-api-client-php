<?php

namespace CrowdinApiClient;

use Iterator;

/**
 * @package CrowdinApiClient\Http
 * @ignore No documentation will be generated for this class
 */
class CollectionIterator implements Iterator
{
    /**
     * @var array
     */
    protected $_items;

    public function __construct(array $items)
    {
        $this->_items = $items;
    }

    /**
     * @return mixed
     * @TODO Remove the 'ReturnTypeWillChange' suppression on next major version
     */
    #[\ReturnTypeWillChange]
    public function current()
    {
        return current($this->_items);
    }

    /**
     * @return mixed
     * @TODO Remove the 'ReturnTypeWillChange' suppression on next major version
     */
    #[\ReturnTypeWillChange]
    public function next()
    {
        return next($this->_items);
    }

    /**
     * @return mixed
     * @TODO Remove the 'ReturnTypeWillChange' suppression on next major version
     */
    #[\ReturnTypeWillChange]
    public function key()
    {
        return key($this->_items);
    }

    /**
     * @TODO Remove the 'ReturnTypeWillChange' suppression on next major version
     */
    #[\ReturnTypeWillChange]
    public function valid(): bool
    {
        $key = key($this->_items);
        return ($key !== null && $key !== false);
    }

    /**
     * @TODO Remove the 'ReturnTypeWillChange' suppression on next major version
     */
    #[\ReturnTypeWillChange]
    public function rewind(): void
    {
        reset($this->_items);
    }
}
