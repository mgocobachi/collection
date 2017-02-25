<?php
declare(strict_types=1);

if (!function_exists('collection')) {
    /**
     * Create an instance of the Collection class using the array as values
     *
     * @param array $elements The elements to be used on the collection
     *
     * @return \Gocobachi\Collection
     */
    function collection(array $elements = [])
    {
        return new \Gocobachi\Collection($elements);
    }
}
