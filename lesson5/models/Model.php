<?php
namespace App\models;

use App\services\DB;

/**
 * Class Model
 * @package App\models
 *
 * @property int $id
 */
abstract class Model
{
    /**
     * @var DB
     */
    protected $db;

    abstract protected static function getTableName();

    public function __construct()
    {
        $this->db = static::getDB();
    }

    protected static function getDB()
    {
        return DB::getInstance();
    }

    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        $params = [':id' => $id];
        return static::getDB()->queryObject($sql, static::class, $params);
    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return static::getDB()->queryObjects($sql, static::class);
    }

    protected function insert()
    {
        //INSERT INTO goods (name, info, price) VALUES (:name, :info, :price)
        $columns = [];
        $params = [];
        foreach ($this as $fieldName => $value) {
            if ($fieldName == 'id' || $fieldName == 'db') {
                continue;
            }
            $columns[] = $fieldName;
            $params[':' . $fieldName] = $value;
        }

        $tableName = static::getTableName();
        $sql = "INSERT INTO {$tableName} 
                    (" . implode(', ', $columns) . ")
                VALUES 
                (" . implode(', ', array_keys($params)) . ")
                ";

        $this->db->exec($sql, $params);
        $this->id =$this->db->lastInsertId();
    }

    protected function update()
    {
        //UPDATE `users` SET `login`=[value-2],`password`=[value-3],`fio`=[value-4] WHERE id = :id
        $placeholders = [];
        $params = [];
        foreach ($this as $fieldName => $value) {
            if ($fieldName == 'db') {
                continue;
            }

            $params[':' . $fieldName] = $value;
            if ($fieldName == 'id') {
                continue;
            }

            $placeholders[] = " $fieldName = :$fieldName";
        }

        $tableName = static::getTableName();
        $sql = "
            UPDATE {$tableName} SET " . implode(', ', $placeholders) ." WHERE id = :id
        ";

        $this->db->exec($sql, $params);
    }

    public function delete()
    {
        $sql = "DELETE FROM `users` WHERE id = :id";
        $this->db->exec($sql, [':id' => $this->id]);
    }

    public function save()
    {
        if (empty($this->id)) {
            $this->insert();
        }
        $this->update();
    }
}