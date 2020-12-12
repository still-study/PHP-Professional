<?php

namespace app\models;

class User extends DbModel
{
    protected $id;
    protected $login;
    protected $pass;

    public function __construct($login = null, $pass = null)
    {
        $this->login = $login;
        $this->pass = $pass;
    }

    protected static function getTableName()
    {
        return "users";
    }
}