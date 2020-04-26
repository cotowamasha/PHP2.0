<?php
namespace App\models;

class User extends Model
{
    public  $id;
    public  $login;
    public  $password;
    public  $name;
    protected function getTableName()
    {
        return 'users';
    }
}