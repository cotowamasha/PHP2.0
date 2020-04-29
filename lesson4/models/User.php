<?php
namespace App\models;

class User extends Model
{
    public  $id;
    public  $login;
    public  $password;
    public  $fio;

    protected static function getTableName()
    {
        return 'users';
    }
}