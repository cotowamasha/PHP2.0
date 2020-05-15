<?php


namespace App\controllers;

use App\entities\Order;

class OrderController extends Controller
{
    public function insertAction(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $order = new Order();
            $order->address = $_POST['address'];

            $this->getRepository('Order')->save($order);
            header('Location: /basket' );
            return '';
        }

        $request = $this->app->request;
        $basket = $request->getSession('goods');
        $sumPrice = 0;
        $sumCount = 0;
        foreach ($basket as $item){
            $sumCount += $item['count'];
            $sumPrice += $item['good']->price;
        }
        return $this->render(
            'order',
            [
                'sumPrice' => $sumPrice,
                'sumCount' => $sumCount,
                'menu' => $this->getMenu(),
            ]
        );
    }
}