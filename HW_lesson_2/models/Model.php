<?php


namespace app\models;
use app\interfaces\IModel;
use app\engine\Db;
abstract class Model implements IModel
{
    public function __set($name, $value)
    {
        return $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function getOne($id)
    {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";
        return Db::getInstance()->queryOne($sql, ["id" => $id], static::class);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->getTableName()}";
        return Db::getInstance()->queryAll($sql);
    }

    public function insert()
    {
        $field = [];
        $val = [];
        $params = [];

        foreach ($this as $key => $value){
            if ($key == 'id') continue;
            array_push($field, $key);
            array_push($val, str_replace($key, ':' . $key, $key));
            $params[$key] = $value;
        }

        $val = implode(', ', $val);
        $field = implode(', ', $field);

        $sql = "INSERT INTO {$this->getTableName()} ({$field}) VALUES ({$val})";
        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertId();
    }

    public function update()
    {
        $sql = "UPDATE ...";
        Db::getInstance()->execute($sql);

    }

    public function delete()
    {
        $sql = "DELETE FROM {$this->getTableName()} WHERE id = :id";
        Db::getInstance()->execute($sql, ["id" => $this->id]);
    }

    abstract protected function getTableName();
}