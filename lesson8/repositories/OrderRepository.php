<?php


namespace App\repositories;

use App\entities\Order;

class OrderRepository extends Repository
{
    protected function getTableName()
    {
        return 'orders';
    }

    protected function getEntityName()
    {
        return Order::class;
    }
}