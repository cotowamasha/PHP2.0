<?php
use App\services\renderers\TmplRenderer;

include dirname(__DIR__) . '/vendor/autoload.php';


$request = new \App\services\Request();

try {
    $request->getError();
} catch (\App\services\ErrorTest $exception) {
    $exception->getLocation();
}

$controllerName = $request->getControllerName();
$actionName = $request->getActionName();

//\App\controllers\UserController
$controllerClass = '\\App\\controllers\\' . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerClass)) {
    /**
     * @var \App\controllers\Controller $controller
     */

    $renderer = new \App\services\renderers\TwigRenderer();
    $controller = new $controllerClass($renderer);
    echo $controller->run($actionName);
}