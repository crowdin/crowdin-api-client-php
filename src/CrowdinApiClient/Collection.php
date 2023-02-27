<?php

namespace CrowdinApiClient;

use ArrayAccess;
use Countable;
use IteratorAggregate;

/**
 * Class Collection
 * @package CrowdinApiClient
 * @internal
 */
class Collection implements IteratorAggregate, ArrayAccess, Countable
{

    /**
     * @var array
     */
    protected $_items = [];

    /**
     * Count elements of an object
     * @link https://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return sizeof($this->_items);
    }

    /**
     * Retrieve an external iterator
     * @link https://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return CollectionIterator
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        return new CollectionIterator($this->_items);
    }

    /**
     * Whether a offset exists
     * @link https://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return bool true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return isset($this->_items[$offset]);
    }

    /**
     * Offset to retrieve
     * @link https://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        if (isset($this->_items[$offset]) === false) {
            return null;
        }
        return $this->_items[$offset];
    }

    /**
     * Offset to set
     * @link https://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            $offset = max(array_keys($this->_items)) + 1;
        }
        $this->_items[$offset] = $value;
    }

    /**
     * Offset to unset
     * @link https://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->_items[$offset]);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->_items);
    }

    /**
     * @param $item
     */
    public function add($item)
    {
        $this->_items[] = $item;
    }

    /**
     * Return collection items as PHP array
     */
    public function __toArray(): array
    {
        return $this->_items;
    }
}
