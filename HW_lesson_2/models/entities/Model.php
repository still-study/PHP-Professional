<?php


namespace app\models\entities;


abstract class Model
{
    public function __set($name, $value)
    {
        if (isset($this->$name) || !isset($this->id)) {  // во время добавления товара id приходил null
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

}