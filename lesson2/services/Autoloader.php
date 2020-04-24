<?php
namespace App\services;
class Autoloader
{
    private $dirs = [
        'models', 'services'
    ];

    public function loadClass($className){
        $name = explode('\\', $className);
        $last = array_pop($name);
        foreach ($this->dirs as $dir){
            $file = dirname(__DIR__) . '/' . $dir . '/' . $last . '.php';
            if(file_exists($file)){
                include $file;
                break;
            }
        }
    }
}