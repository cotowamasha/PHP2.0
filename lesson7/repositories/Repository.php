<?php

namespace App\repositories;

use App\core\Container;
use App\entities\Entity;
use App\services\DB;

abstract class Repository
{
    /**
     * @var DB
     */
    protected $db;

    /**
     * @var Container
     */
    protected $container;

    abstract protected function getTableName();
    abstract protected function getEntityName();

    public function setContainer(Container $container)
    {
        $this->container = $container;
        $this->setDB();
    }

    private function setDB()
    {
        $this->db = $this->container->db;
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        $params = [':id' => $id];
        return $this->db->queryObject($sql, $this->getEntityName(), $params);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->queryObjects($sql, $this->getEntityName());
    }

    protected function insert(Entity $entity)
    {
        //INSERT INTO goods (name, info, price) VALUES (:name, :info, :price)
        $columns = [];
        $params = [];
        foreach ($entity as $fieldName => $value) {
            if ($fieldName == 'id') {
                continue;
            }
            $columns[] = $fieldName;
            $params[':' . $fieldName] = $value;
        }

        $tableName = $this->getTableName();
        $sql = "INSERT INTO {$tableName} 
                    (" . implode(', ', $columns) . ")
                VALUES 
                (" . implode(', ', array_keys($params)) . ")
                ";

        $this->db->exec($sql, $params);
        $entity->id =$this->db->lastInsertId();
    }

    protected function update(Entity $entity)
    {
        //UPDATE `users` SET `login`=[value-2],`password`=[value-3],`fio`=[value-4] WHERE id = :id
        $placeholders = [];
        $params = [];
        foreach ($entity as $fieldName => $value) {
            $params[':' . $fieldName] = $value;
            if ($fieldName == 'id') {
                continue;
            }

            $placeholders[] = " $fieldName = :$fieldName";
        }

        $tableName = $this->getTableName();
        $sql = "
            UPDATE {$tableName} SET " . implode(', ', $placeholders) ." WHERE id = :id
        ";

        $this->db->exec($sql, $params);
    }

    public function delete(Entity $entity)
    {
        $sql = "DELETE FROM `users` WHERE id = :id";
        $this->db->exec($sql, [':id' => $entity->id]);
    }

    public function save(Entity $entity)
    {
        if (empty($entity->id)) {
            $this->insert($entity);
        }
        $this->update($entity);
    }
}