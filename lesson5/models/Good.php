<?php
namespace App\models;
/**
 * Class Good
 * @package App\models
 *
 * @method self static function getOne($id)
 */
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