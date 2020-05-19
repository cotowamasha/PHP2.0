<?php
include dirname(__DIR__) . '/vendor/autoload.php';
$config = include dirname(__DIR__) . '/config/main.php';
(new \App\core\App())->run($config);
