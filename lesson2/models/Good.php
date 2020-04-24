<?php
namespace App\models;
use App\services\TestT;
use App\services\DBII;
class Good extends Model implements DBII
{
    use TestT;

    protected function getTableName()
    {
        return 'goods';
    }
}