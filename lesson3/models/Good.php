<?php
namespace App\models;

class Good extends Model
{
    public  $id;
    public  $name;
    public  $price;
    public  $info;

    protected function getTableName()
    {
        return 'goods';
    }
}