<?php
namespace App\services;

use App\core\Container;
use App\repositories\Repository;

class DB
{
    protected $config = [];
    protected $connection;
    protected $container;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Получение контейнера
     *
     * @param Container $container
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param $repositoryName
     * @return Repository|null
     */
    public function getRepository($repositoryName)
    {
        if (empty($this->container)) {
            return null;
        }
        $repositoryName .= 'Repository';
        return $this->container->$repositoryName;
    }

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

    public function lastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }
}
