<?php

namespace App\traits;

trait SingletonT
{
    private static $items;

    protected function __construct() {}
    protected function __clone() {}
    protected function __wakeup() {}

    public static function getInstance()
    {
        if (empty(static::$items)) {
            static::$items = new static();
        }
        return static::$items;
    }
}
