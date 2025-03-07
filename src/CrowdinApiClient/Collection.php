<?php

namespace CrowdinApiClient;

use ArrayAccess;
use Countable;
use IteratorAggregate;

/**
 * @package CrowdinApiClient
 * @ignore No documentation will be generated for this class
 */
class Collection implements IteratorAggregate, ArrayAccess, Countable
{
    /**
     * @var array
     */
    protected $_items = [];

    /**
     * Count elements of an object
     * @TODO Remove the 'ReturnTypeWillChange' suppression on next major version
     */
    #[\ReturnTypeWillChange]
    public function count(): int
    {
        return sizeof($this->_items);
    }

    /**
     * Retrieve an external iterator
     * @TODO Remove the 'ReturnTypeWillChange' suppression on next major version
     */
    #[\ReturnTypeWillChange]
    public function getIterator(): CollectionIterator
    {
        return new CollectionIterator($this->_items);
    }

    /**
     * @param mixed $offset
     * @TODO Remove the 'ReturnTypeWillChange' suppression on next major version
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($offset): bool
    {
        return isset($this->_items[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed
     * @TODO Remove the 'ReturnTypeWillChange' suppression on next major version
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        if (isset($this->_items[$offset]) === false) {
            return null;
        }

        return $this->_items[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @TODO Remove the 'ReturnTypeWillChange' suppression on next major version
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value): void
    {
        if ($offset === null) {
            $offset = max(array_keys($this->_items)) + 1;
        }

        $this->_items[$offset] = $value;
    }

    /**
     * @param mixed $offset
     * @TODO Remove the 'ReturnTypeWillChange' suppression on next major version
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset): void
    {
        unset($this->_items[$offset]);
    }

    public function isEmpty(): bool
    {
        return empty($this->_items);
    }

    public function add($item): void
    {
        $this->_items[] = $item;
    }

    public function __toArray(): array
    {
        return $this->_items;
    }
}
