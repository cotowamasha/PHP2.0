<?php
namespace App\services;

class Autoloader
{
    public function loadClass($className)
    {
        $file = str_replace(
            ['App\\', '\\'],
            [dirname(__DIR__ ). '/', '/'],
            $className
        ) . '.php';
        if (file_exists($file)) {
            include $file;
        }
    }
}