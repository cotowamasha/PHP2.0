<?php
namespace App\models;

use App\services\DB;

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

    protected static function getDB(): DB
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
    }

    protected function update()
    {
        $columns = [];
        $params = [];
        foreach ($this as $fieldName => $value){
            if ($fieldName == 'db'){
                continue;
            }
            $columns[] = $fieldName;
            $params[":$fieldName"] = $value;
        }
        $tableName = static::getTableName();

        $str = '';
        for($i = 0; $i<count($columns); $i++){
            if($i == count($columns)-1){
                $str .= $columns[$i] . ' = ' . ":$columns[$i]";
                break;
            }
            $str .= $columns[$i] . ' = ' . ":$columns[$i]" . ', ';
        }
        $sql = "UPDATE {$tableName} SET {$str} WHERE users.id = :id";
//        var_dump($sql);
        $this->db->exec($sql, $params);
    }

    public function delete()
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE users.id = :id";
        $params = [':id' => $this->id];
        return $this->db->exec($sql, $params);
    }

    public function save()
    {
        if(empty($this->id)){
            $this->insert();
        }else {
            $this->update();
        }
    }
}