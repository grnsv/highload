<?php

namespace App\Contracts;

interface Sort
{
    /**
     * Sort method
     *
     * @param array $array
     * @param string $method
     * @return array
     */
    public function sort(array $array, string $method): array;
}
