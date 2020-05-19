<?php

namespace App\services;

class Request
{
    private $queryString;
    private $controllerName;
    private $actionName;
    private $params;
    private $id;

    public function __construct()
    {
        session_start();
        $this->queryString = $_SERVER['REQUEST_URI'];
        $this->prepareRequest();
    }

    protected function prepareRequest()
    {
        $this->params = [
            'post' => $_POST,
            'get' => $_GET,
        ];

        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";
        if (preg_match_all($pattern, $this->queryString, $matches)) {
            $this->controllerName = $matches['controller'][0];
            $this->actionName = $matches['action'][0];
        }

        if (!empty($_GET['id'])) {
            $this->id = (int)$_GET['id'];
        }
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getSession($key = null)
    {
        if (empty($key)) {
            return $_SESSION;
        }

        if (empty($_SESSION[$key])) {
            return [];
        }

        return $_SESSION[$key];
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function sessionDestroy()
    {
        session_destroy();
    }

    public function redirectApp($msg = '')
    {
        if (!empty($msg)) {
            $this->setSession('msg', $msg);
        }
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }
}
