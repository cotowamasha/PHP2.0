<?php

namespace App\controllers;

use App\models\User;

class UserController extends Controller
{
    public function insertAction()
    {
        $user = new User();

        $user->login = 'admin1';
        $user->password = '1232';
        $user->fio = 'admin1';

        $user->insert();
    }
}