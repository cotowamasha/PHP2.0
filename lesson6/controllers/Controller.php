<?php

namespace App\controllers;

use App\services\renderers\IRenderer;
use App\services\renderers\TmplRenderer;

abstract class Controller
{
    protected $defaultAction = 'all';

    /**
     * @var TmplRenderer
     */
    protected $renderer;

    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function run($actionName)
    {
        $action = $this->defaultAction;
        if (!empty($actionName)) {
            $action = $actionName;
            if (!method_exists($this, $action . 'Action')) {
                $action = $this->defaultAction;
            }
        }
        $action .= 'Action';
        return $this->$action();
    }

    protected function render($template, $params)
    {
        return $this->renderer->render($template, $params);
    }

    protected function getMenu()
    {
        return [
            [
                'name' => 'Пользователи',
                'href' => '/user/all',
            ],
            [
                'name' => 'Товары',
                'href' => '/good/all',
            ],
            [
                'name' => 'Добавить товар',
                'href' => '/good/insert',
            ],

        ];
    }
}