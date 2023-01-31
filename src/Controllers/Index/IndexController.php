<?php

namespace App\Controllers\Index;

class IndexController
{
    public function index(): void
    {
        echo self::class . '->' . __FUNCTION__ . '()' . PHP_EOL;
    }
}
