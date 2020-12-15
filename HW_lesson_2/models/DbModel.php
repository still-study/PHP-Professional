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

    public static function getLimit($page)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT ?";
        return Db::getInstance()->queryLimit($sql, $page);
    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public static function getOneWhere($name, $value)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$name}` = :{$name}";
        return Db::getInstance()->queryObject($sql, [":{$name}" => $value], static::class);
    }

    public static function getCountWhere($name, $value)
    {
        $tableName = static::getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `{$name}` = :{$name}";
        return Db::getInstance()->queryOne($sql, [":{$name}" => $value])['count'];
    }

    public static function getSumWhere($name)
    {
        $tableName = static::getTableName();
        $sql = "SELECT SUM(price) FROM {$tableName} WHERE name = :name";
        return Db::getInstance()->execute($sql, [":name" => $name]);
    }

    protected function insert()
    {
        $tableName = static::getTableName();
        $fields = [];
        $params = [];

        foreach ($this->props as $key => $value){

            $params[":{$key}"] = $this->$key;
            $fields[] = "`$key`";

        }

        $val = implode(', ', array_keys($params));
        $fields = implode(', ', $fields);

        $sql = "INSERT INTO {$tableName} ({$fields}) VALUES ({$val})";

        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertId();
        return $this;
    }

    protected function update()
    {
        $tableName = static::getTableName();
        $params = [":id" => $this->id];
        $fields = [];

        foreach ($this->props as $key => $value){
            if (!$value) continue;
            $params[":{$key}"] = $this->{$key};
            $fields[] .= "`{$key}` = :{$key}";
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