<?php


namespace app\models;
use app\interfaces\IModel;
use app\engine\Db;

abstract class Model implements IModel
{
    public function __set($name, $value)
    {
        $this->props[$name] = true;
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    abstract protected static function getTableName();
}