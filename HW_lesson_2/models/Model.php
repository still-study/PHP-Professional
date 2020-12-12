<?php


namespace app\models;
use app\interfaces\IModel;

abstract class Model implements IModel
{
    public function __set($name, $value)
    {
        if (isset($this->$name)) {
            $this->props[$name] = true;
            $this->$name = $value;
        } else echo "Не существует поля: {$name}";

    }

    public function __get($name)
    {
        if (isset($this->$name)) {
            return $this->$name;
        }
    }

    public function __isset($name)
    {
        return isset($this->$name);
    }

    abstract protected static function getTableName();
}