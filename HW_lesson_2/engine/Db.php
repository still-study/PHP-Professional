<?php

namespace app\engine;

use app\traits\TSingleton;

final class Db
{
    protected $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'login' => 'root',
        'password' => 'root',
        'database' => 'shop',
        'charset' => 'utf8',
    ];

    use TSingleton;

    protected $connection = null;



    protected function getConnection()
    {
        if (is_null($this->connection)) {
            $this->connection = new \PDO($this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']
            );
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }



    protected function prepareDsnString()
    {
        return sprintf("%s:host=%s;dbname=%s; charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }



    protected function query($sql, $params)
    {
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }



    public function lastInsertId()
    {
        $stmt = $this->getConnection();
        return $stmt->lastInsertId();
    }



    public function queryObject($sql, $params = [], $class)
    {
        $stmt = $this->query($sql, $params);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $class);
        //TODO
        return $stmt->fetch();
    }



    public function execute($sql, $params = [])
    {
        return $this->query($sql, $params)->rowCount();
    }



    public function queryOne($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }



    public function queryAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }


}