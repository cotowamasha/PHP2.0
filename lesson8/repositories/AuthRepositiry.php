<?php


namespace App\repositories;


class AuthRepositiry extends Repository
{

    protected function getTableName()
    {
        return 'users';
    }

    protected function getEntityName()
    {
        return Auth::class;
    }
}