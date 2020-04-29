<?php
namespace App\services;

use App\traits\SingletonT;

class DB
{
    use SingletonT;

    protected $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'dbname' => 'php2',
        'charset' => 'UTF8',
        'username' => 'root',
        'password' => '',
    ];

    protected $connection;

    protected function getConnection()
    {
        if (!empty($this->connection)) {
            return $this->connection;
        }

        $this->connection = new \PDO(
            $this->getSdnString(),
            $this->config['username'],
            $this->config['password']
        );

        $this->connection->setAttribute(
            \PDO::ATTR_DEFAULT_FETCH_MODE,
            \PDO::FETCH_ASSOC
        );

        return $this->connection;
    }

    protected function getSdnString()
    {
        //mysql:host=localhost;dbname=DB;charset=UTF8
        return sprintf(
            '%s:host=%s;dbname=%s;charset=%s',
            $this->config['driver'],
            $this->config['host'],
            $this->config['dbname'],
            $this->config['charset']
        );
    }

    protected function query(string $sql, array $params = [])
    {
        $PDOStatement = $this->getConnection()->prepare($sql);
        $PDOStatement->execute($params);
        return $PDOStatement;
    }

    public function find(string $sql, array $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }

    public function findAll(string $sql, array $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function queryObject(string $sql, $class, array $params = [])
    {
        $PDOStatement = $this->query($sql, $params);
        $PDOStatement->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $PDOStatement->fetch();
    }

    public function queryObjects(string $sql, $class, array $params = [])
    {
        $PDOStatement = $this->query($sql, $params);
        $PDOStatement->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $PDOStatement->fetchAll();
    }

    public function exec(string $sql, array $params = [])
    {
        $this->query($sql, $params);
    }
}
