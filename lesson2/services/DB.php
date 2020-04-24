<?php
namespace App\services;
class DB implements DBI, DBII
{
    use TestT;

    public function find(string $sql)
    {
        return $sql . 'find';
    }

    public function findAll(string $sql)
    {
        return $sql . 'findAll';
    }

    public function query(string $sql)
    {
        // TODO: Implement query() method.
    }
}