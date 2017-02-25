<?php
namespace Gocobachi;

use ArrayIterator;

/**
 * A Collection class to manipulate the arrays with enriched routines
 * and the ability of executing them in chain
 *
 * @author Miguel Gocobachi <miguel@gocobachi.mx>
 */
class Collection extends ArrayIterator
{
    /**
     * Return an native array of this object and its items
     *
     * @return array
     */
    public function all(): array
    {
        return (array) $this;
    }

    /**
     * Return the first element of the array
     *
     * @return mixed
     */
    public function first()
    {
        return current($this->all());
    }

    /**
     * Walk thru the elements of the array and apply a function to each
     *
     * @return self
     */
    public function each(callable $callback)
    {
        foreach ($this->all() as $key => $value) {
            $callback($key, $value);
        }

        return $this;
    }

    /**
     * Applies the callback to the elements of the array
     *
     * @param callback $callback Callback function to run for each element
     *
     * @return self
     */
    public function map(callable $callback): self
    {
        return new static(
            array_map($callback, $this->all())
        );
    }

    /**
     * Filters elements of the array
     *
     * @param callback $callback The callback function to use
     *
     * @return self
     */
    public function filter(callable $callback): self
    {
        return new static(
            array_filter($this->all(), $callback)
        );
    }

    /**
     * Iteratively reduce the array to a single value
     *
     * @param callable $callback The function to be executed to reduce it
     * @param mixed    $initial  Will be used at the beginning of the process
     *
     * @return self
     */
    public function reduce(callable $callback, $initial = null): self
    {
        return new static(
          (array) array_reduce($this->all(), $callback, $initial)
        );
    }

    /**
     * Return an array with elements in reverse order
     *
     * @param bool $keep_keys If set to TRUE numeric keys are preserved
     *
     * @return self
     */
    public function reverse(callable $callback, bool $keep_keys = false): self
    {
        return new static(
            array_reverse($this->all(), $keep_keys)
        );
    }
}
