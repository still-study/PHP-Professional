<?php


namespace app\models;


use app\engine\Db;

abstract class DbModel extends Model
{
    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject($sql, [":id" => $id], static::class);
    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public function insert()
    {
        $tableName = static::getTableName();
        $fields = [];
        $params = [];

        foreach ($this->props as $key => $value){

            $params[":{$key}"] = $this->{$key};
            $fields[] = "`$key`";

        }

        $val = implode(', ', array_keys($params));
        $fields = implode(', ', $fields);

        $sql = "INSERT INTO {$tableName} ({$fields}) VALUES ({$val})";

        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertId();
        return $this;
    }

    public function update()
    {
        $tableName = static::getTableName();
        $params = [":id" => $this->id];
        $fields = [];

        foreach ($this->props as $key => $value){
            $params[":{$key}"] = $this->{$key};
            array_push($fields, "`$key`" . ' = ' . ":{$key}");
            if ($value)
                $this->props[$key] = false;
        }

        $val = implode(', ', $fields);

        $sql = "UPDATE {$tableName} SET {$val} WHERE id = :id";
        Db::getInstance()->execute($sql, $params);

    }

    public function delete()
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, [":id" => $this->id]);
    }

    public function save()
    {
        if(is_null($this->id)) {
            $this->insert();
        } else $this->update();
    }
}