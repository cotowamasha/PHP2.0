<?php


namespace App\services;


use Throwable;

class ErrorTest extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
    public function getLocation(){
        header('location: /good/all');
    }
}