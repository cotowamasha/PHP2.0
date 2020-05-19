<?php

namespace App\controllers;

use App\entities\Good;
use App\repositories\GoodRepository;

class BasketController extends Controller
{
    protected $defaultAction = 'my';

    public function addAction()
    {
        $request = $this->app->request;
        /**@var GoodRepository $goodRepository*/
        $goodRepository = $this->getRepository('Good');
        $hasAdd = $this->app->basketServices->add($request, $goodRepository);

        if (!$hasAdd) {
            return $this->render('404');
        }

        $request->redirectApp('Товар добавлен в корзину');
        return '';
    }

    public function myAction()
    {
        $request = $this->app->request;
        $basket = $request->getSession('goods');
        return $this->render(
            'basket',
            [
                'basket' => $basket,
                'title' => $this->app->getConfig('title'),
                'menu' => $this->getMenu(),
            ]
        );
    }
    public function removeAction()
    {
        $request = $this->app->request;
        $hasRemove = $this->app->basketServices->remove($request);

        if (!$hasRemove) {
            return $this->render('404');
        }
        $request->redirectApp('Товар добавлен удален из корзины');
        return '';
    }


}