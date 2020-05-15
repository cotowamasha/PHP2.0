<?php

namespace App\controllers;

use App\models\User;

class UserController extends Controller
{
    public function oneAction()
    {
        $id = 0;
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
        }
        $user = User::getOne($id);
        return $this->render('userOne', ['user' => $user]);
    }

    public function allAction()
    {
        $users = User::getAll();
        return $this->render('userAll', ['users' => $users]);
    }

    public function insertAction()
    {
        $user = new User();

        $user->login = 'admin1';
        $user->password = '1232';
        $user->fio = 'admin1';

        $user->insert();
    }
}