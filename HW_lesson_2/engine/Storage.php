<?php


namespace app\engine;


class Storage
{
    protected $items = [];

    public function get($key)
    {
        if (!isset($this->items[$key])) {
            //если при обращении к свойству-методу не существует оъекта, создадим его
            $this->items[$key] = App::call()->createComponent($key);
        }
        return $this->items[$key];
    }
}