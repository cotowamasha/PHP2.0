<?php

namespace App\controllers;

use App\models\Good;
use Twig\Loader\ArrayLoader;

class GoodController extends Controller
{
    public function oneAction()
    {
        $id = 0;
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
        }
        $good = Good::getOne($id);

        return $this->render('goodOne', ['good' => $good]);
    }

    public function allAction()
    {
        $users = Good::getAll();
        return $this->render('goodAll', ['goods' => $users]);
    }

//    public function insertAction()
//    {
//        $user = new \App\models\User();
//
//        $user->login = 'admin1';
//        $user->password = '1232';
//        $user->fio = 'admin1';
//
//        $user->insert();
//    }
}