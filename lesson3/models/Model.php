<?php
namespace App\models;

use App\services\DB;

abstract class Model
{
    protected $db;

    abstract protected function getTableName();

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function getOne($id)
    {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";
        $params = [':id' => $id];
        return $this->db->find($sql, $params);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->getTableName()}";
        return $this->db->findAll($sql);

    }

    public function insert()
    {
        $sql = "INSERT INTO `users` (`login`, `password`, `name`) VALUES (:login, :password, :name)";
        $params = [];
        foreach ($this as $fieldName => $value) {
            if($fieldName == 'db' || $fieldName == 'id'){
                continue;
            }
            $params[":$fieldName"] = $value;
        }

        return $this->db->exec($sql, $params);
    }

    public function update()
    {
        $sql ="UPDATE `users` SET `login` = :login, `password` = :password, `name` = :name WHERE `users`.`id` = :id";
        $params = [];
        foreach ($this as $fieldName => $value) {
            if($fieldName == 'db'){
                continue;
            }
            $params[":$fieldName"] = $value;
        }
        return $this->db->exec($sql, $params);

    }

    public function delete()
    {
        $sql = "DELETE FROM `users` WHERE `users`.`id` = :id";
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