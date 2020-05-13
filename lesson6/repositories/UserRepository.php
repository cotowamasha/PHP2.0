<?php
namespace App\repositories;

use App\entities\User;

class UserRepository extends Repository
{
    protected function getTableName()
    {
        return 'users';
    }

    protected function getEntityName()
    {
        return User::class;
    }
}