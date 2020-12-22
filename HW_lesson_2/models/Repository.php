<?php


namespace app\models;


use app\engine\Db;
use app\interfaces\IModel;
use app\models\entities\Model;

abstract class Repository implements IModel
{
    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject($sql, [":id" => $id], $this->getEntityClass());
    }

    public function getLimit($page)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT ?";
        return Db::getInstance()->queryLimit($sql, $page);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public function getOneWhere($name, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$name}` = :{$name}";
        return Db::getInstance()->queryObject($sql, [":{$name}" => $value], $this->getEntityClass());
    }

    public function getCountWhere($name, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `{$name}` = :{$name}";
        return Db::getInstance()->queryOne($sql, [":{$name}" => $value])['count'];
    }

    public function getSumWhere($name)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT SUM(price) FROM {$tableName} WHERE name = :name";
        return Db::getInstance()->execute($sql, [":name" => $name]);
    }

    protected function insert(Model $entity)
    {
        $tableName = $this->getTableName();
        $fields = [];
        $params = [];

        foreach ($entity->props as $key => $value){

            $params[":{$key}"] = $entity->$key;
            $fields[] = "`$key`";

        }

        $val = implode(', ', array_keys($params));
        $fields = implode(', ', $fields);

        $sql = "INSERT INTO {$tableName} ({$fields}) VALUES ({$val})";

        Db::getInstance()->execute($sql, $params);
        $entity->id = Db::getInstance()->lastInsertId();

    }

    protected function update(Model $entity)
    {
        $tableName = $this->getTableName();
        $params = [":id" => $this->id];
        $fields = [];

        foreach ($entity->props as $key => $value){
            if (!$value) continue;
            $params[":{$key}"] = $entity->{$key};
            $fields[] .= "`{$key}` = :{$key}";
            $entity->props[$key] = false;
        }

        $val = implode(', ', $fields);

        $sql = "UPDATE {$tableName} SET {$val} WHERE id = :id";
        Db::getInstance()->execute($sql, $params);
    }

    public function delete(Model $entity)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, [":id" => $entity->id])->RowCount();
    }

    public function save($entity)
    {
        if(is_null($entity->id)) {
            $this->insert($entity);
        } else $this->update($entity);
    }

    abstract protected function getEntityClass();
    abstract protected function getTableName();


}