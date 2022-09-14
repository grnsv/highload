<?php

namespace App\Components;

class LemonadeMessage
{
    public function __construct(public string $type, public int $userId)
    {
    }
}
