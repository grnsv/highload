<?php

namespace App\Http\Controllers;

use App\Contracts\Sort;

class SortController extends Controller
{
    public function bubble()
    {
        return app(Sort::class)->sort(method: 'bubble');
    }

    public function quick()
    {
        return app(Sort::class)->sort(method: 'quick');
    }
}
