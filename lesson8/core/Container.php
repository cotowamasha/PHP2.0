<?php

namespace App\core;

class Container
{
    protected $components = [];
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->components)) {
            return $this->components[$name];
        }

        if (!array_key_exists($name, $this->config)) {
            return null;
        }

        $className = $this->config[$name]['class'];

        if (!class_exists($className)) {
            return null;
        }

        if (array_key_exists('config', $this->config[$name])) {
            $class = new $className($this->config[$name]['config']);
        } else {
            $class = new $className();
        }

        if (method_exists($class, 'setContainer')) {
            $class->setContainer($this);
        }

        $this->components[$name] = $class;

        return $class;
    }
}
