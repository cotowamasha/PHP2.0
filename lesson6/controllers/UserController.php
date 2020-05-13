<?php

namespace App\controllers;

use App\models\User;
use App\repositories\UserRepository;

class UserController extends Controller
{
    public function oneAction()
    {
        $id = 0;
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
        }
        $user = (new UserRepository())->getOne($id);
        return $this->render(
            'userOne',
            [
                'user' => $user,
                'menu' => $this->getMenu(),
            ]
        );
    }

    public function allAction()
    {
        $users = (new UserRepository())->getAll();
        return $this->render(
            'userAll',
            [
                'users' => $users,
                'title' => 'Все товары',
                'menu' => $this->getMenu(),
            ]
        );
    }
}