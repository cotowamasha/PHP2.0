<?php


namespace App\controllers;

use App\entities\Order;

class OrderController extends Controller
{
    public function insertAction(){
        if(empty($_SESSION['goods'])){
            return "Добавьте товары в корзину <a href='/basket'>Назад</a>";
        }
        if(empty($_SESSION['user'])){
            return "Чтобы создать заказ авторизуйтесь <a href='/auth'>Log in</a>";
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $order = new Order();
            $order->user_id = $_SESSION['user']['id'];
            $order->address = $_POST['address'];

            $this->getRepository('Order')->save($order);

            for($i = 1; $i <= count($_SESSION['goods']); $i++){
                $order_id = $order->id;
                $good_id = $_SESSION['goods'][$i]['good']->id;
                $count = $_SESSION['goods'][$i]['count'];
                $price =  $_SESSION['goods'][$i]['good']->price;
                $this->getRepository('Order')->saveOrderItems($order_id, $good_id, $count, $price);
            }
            unset($_SESSION['goods']);
            return $this->render('basket',
                [
                    'msg' => 'Заказ оформлен',
                    'menu' => $this->getMenu()
                ]);
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