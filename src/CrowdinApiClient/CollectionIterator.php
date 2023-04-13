<?php

namespace CrowdinApiClient;

use Iterator;

/**
 * Class CollectionIterator
 * @package CrowdinApiClient\Http
 * @internal
 */
class CollectionIterator implements Iterator
{
    /**
     * @var array
     */
    protected $_items;

    /**
     * CollectionIterator constructor.
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->_items = $items;
    }

    /**
     * Return the current element
     * @link https://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    #[\ReturnTypeWillChange]
    public function current()
    {
        $var = current($this->_items);
        return $var;
    }

    /**
     * Move forward to next element
     * @link https://php.net/manual/en/iterator.next.php
     * @return mixed Next item
     * @since 5.0.0
     */
    #[\ReturnTypeWillChange]
    public function next()
    {
        $var = next($this->_items);
        return $var;
    }

    /**
     * Return the key of the current element
     * @link https://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    #[\ReturnTypeWillChange]
    public function key()
    {
        $var = key($this->_items);
        return $var;
    }

    /**
     * Checks if current position is valid
     * @link https://php.net/manual/en/iterator.valid.php
     * @return bool The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    #[\ReturnTypeWillChange]
    public function valid()
    {
        $key = key($this->_items);
        $var = ($key !== null && $key !== false);
        return $var;
    }

    /**
     * Rewind the Iterator to the first element
     * @link https://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    #[\ReturnTypeWillChange]
    public function rewind()
    {
        reset($this->_items);
    }
}
