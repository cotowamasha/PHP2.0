<?php
namespace App\models;

class Good extends Model
{
    public $id;
    public $info;
    public $price;
    public $name;

    protected static function getTableName()
    {
        return 'goods';
    }
}