<?php


namespace app\models;
use app\interfaces\IModel;
use app\engine\Db;
abstract class Model implements IModel
{
    protected $tableName = "";

    protected $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

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
        $sql = "SELECT FROM {$this->getTableName()} WHERE id = {$id}";
        return $this->db->queryOne($sql);
    }

    public function getAll()
    {
        $sql = "SELECT FROM {$this->getTableName()}";
        return $this->db->queryAll($sql);
    }

    public function insert()
    {
        $sql = "INSERT ...";
        $this->db->query($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->getTableName()} WHERE id = {$id}";
        return $this->db->query($sql);
    }

    abstract protected function getTableName();
}