<?php


namespace app\interfaces;


interface IModel
{
    public static function getOne($id);
    public static function getAll();
    public function insert();
    public function delete();
}