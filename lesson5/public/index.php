<?php


use App\services\renderers\TwigRenderer;

include dirname(__DIR__) . '/vendor/autoload.php';

$controllerName = 'user';
if (!empty($_GET['c'])) {
    $controllerName = $_GET['c'];
}

$actionName = '';
if (!empty($_GET['a'])) {
    $actionName = $_GET['a'];
}

$controllerClass = '\\App\\controllers\\' . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerClass)) {
    /**
     * @var \App\controllers\Controller $controller
     */

    $renderer = new TwigRenderer();
    $controller = new $controllerClass($renderer);
    echo $controller->run($actionName);
}