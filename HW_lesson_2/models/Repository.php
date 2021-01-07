<?php


namespace app\models;

use app\engine\App;
use app\interfaces\IModel;
use app\models\entities\Model;

abstract class Repository implements IModel
{
    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return App::call()->db->queryObject($sql, [":id" => $id], $this->getEntityClass());
    }

    public function getLimit($page)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT ?";
        return App::call()->db->queryLimit($sql, $page);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return App::call()->db->queryAll($sql);
    }

    public function getOneWhere($name, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$name}` = :{$name}";
        return App::call()->db->queryObject($sql, [":{$name}" => $value], $this->getEntityClass());
    }

    public function getCountWhere($name, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `{$name}` = :{$name}";
        return App::call()->db->queryOne($sql, [":{$name}" => $value])['count'];
    }

    public function getSumWhere($name, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT SUM(price) as sum FROM {$tableName} WHERE `{$name}` = :{$name}";
        return App::call()->db->queryOne($sql, [":{$name}" => $value])['sum'];
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

        App::call()->db->execute($sql, $params);
        $entity->id = App::call()->db->lastInsertId();

    }

    protected function update(Model $entity)
    {
        $tableName = $this->getTableName();
        $params = [":id" => $entity->id];
        $fields = [];
        foreach ($entity->props as $key => $value){
            if (!$value) continue;
            $params[":{$key}"] = $entity->{$key};
            $fields[] .= "`{$key}` = :{$key}";
            $entity->props[$key] = false;
        }

        $val = implode(', ', $fields);

        $sql = "UPDATE {$tableName} SET {$val} WHERE id = :id";
        App::call()->db->execute($sql, $params);
    }

    public function delete(Model $entity)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return App::call()->db->execute($sql, [":id" => $entity->id]);
    }

    public function save($entity)
    {
        if(is_null($entity->id)) {
            $this->insert($entity);
        } else {
            $this->update($entity);
        }
    }

    abstract protected function getEntityClass();
    abstract protected function getTableName();


}