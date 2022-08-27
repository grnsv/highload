<?php

namespace App\Services;

use App\Contracts\Sort;
use Illuminate\Support\Facades\Log;

class SortService implements Sort
{
    /**
     * Sort method
     *
     * @param array $array
     * @param string $method
     * @return array
     */
    public function sort(
        array $array = [1, 2, 3, 5, 6, 8, 1, 12, 15, 18, 1, 2, 3, 4, 6, 13, 15, 17],
        string $method = 'quick',
    ): array {

        if (method_exists($this, $method)) {

            $time_start = now();
            Log::info('Начал работать в ' . $time_start);

            $array = call_user_func([$this, $method], $array);

            Log::debug(round(memory_get_usage() / 1024, 2) . ' kilobytes used');
            Log::debug('Peak: ' . round(memory_get_peak_usage() / 1024, 2) . ' kilobytes');

            $time_end = now();
            Log::info('Закончил работать в ' . $time_end);

            return $array;
        } else {
            Log::error('Method ' . $method . ' is not supported');
            return $array;
        }
    }

    /**
     * Bubble sort method
     *
     * @param array $array
     * @return array
     */
    private function bubble(array $array): array
    {
        $size = count($array) - 1;
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size - $i; $j++) {
                $k = $j + 1;
                if ($array[$k] < $array[$j]) {
                    // Swap elements at indices: $j, $k
                    list($array[$j], $array[$k]) = array($array[$k], $array[$j]);
                }
            }
        }
        return $array;
    }

    /**
     * Quick sort method
     *
     * @param array $array
     * @return array
     */
    private function quick(array $array): array
    {
        sort($array);
        return $array;
    }
}
