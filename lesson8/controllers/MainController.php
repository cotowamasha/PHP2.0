<?php


namespace App\controllers;


class MainController extends Controller
{
    protected $defaultAction = 'my';

    public function myAction()
    {
        return $this->render(
            'main',
            [
                'title' => $this->app->getConfig('title'),
                'menu' => $this->getMenu(),
            ]
        );
    }
}