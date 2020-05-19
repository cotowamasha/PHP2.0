<?php


namespace App\controllers;


class AuthController extends Controller
{
    protected $defaultAction = 'my';

    public function myAction($str = '')
    {
        return $this->render(
            'auth',
            [
                'title' => $this->app->getConfig('title'),
                'menu' => $this->getMenu(),
                'warn' => $str
            ]
        );
    }

    public function loginAction()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $login = $_POST['login'];
            $password = $_POST['password'];

            $user = $this->getRepository('Auth')->auth($login);
            if (!$user){
                return $this->myAction('Не верный логин или пароль');
            }
            $userAuth = [
                'id' => $user['id'],
                'login' => $user['login'],
                'is_admin' => $user['is_admin']
            ];
            $request = $this->app->request;
            if(password_verify($password, $user['password'])){
                $request->setSession('user', $userAuth);
            } else {
                return $this->myAction('Не верный логин или пароль');
            }

        }
        if(empty($_SESSION['user'])){
            return $this->myAction();
        }

        if($_SESSION['user']['is_admin']){
            return $this->render(
                'admin',
                [
                    'title' => $this->app->getConfig('title'),
                    'menu' => $this->getMenu(),
                    'login' => $_SESSION['user']['login']
                ]
            );
        }
        if($_SESSION['user']['is_admin'] == null){
            return $this->render(
                'simpleUser',
                [
                    'title' => $this->app->getConfig('title'),
                    'menu' => $this->getMenu(),
                    'login' => $_SESSION['user']['login']
                ]
            );
        }
    }
    public function logoutAction(){
        session_destroy();
        header('location: /good');
    }
}