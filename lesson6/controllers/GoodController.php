<?php

namespace App\controllers;


use App\entities\Good;
use App\repositories\GoodRepository;

class GoodController extends Controller
{
    public function oneAction()
    {
        $id = 0;
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
        }

        $good = (new GoodRepository())->getOne($id);

        return $this->render(
            'goodOne',
            [
                'good' => $good,
                'menu' => $this->getMenu(),
            ]
        );
    }

    public function allAction()
    {
        $goods = (new GoodRepository())->getAll();
        return $this->render(
            'goodAll',
            [
                'goods' => $goods,
                'title' => 'Все товары',
                'menu' => $this->getMenu(),
            ]
        );
    }

    public function insertAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $good = new Good();
            $good->name = $_POST['name'];
            $good->info = $_POST['info'];
            $good->price = $_POST['price'];

            (new GoodRepository())->save($good);
            header('Location: /good/all' );
            return '';
        }

        return $this->render(
            'goodAdd',
            [
                'menu' => $this->getMenu(),
            ]
        );
    }
}