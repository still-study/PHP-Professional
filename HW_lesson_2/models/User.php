<?php

namespace app\models;

use app\engine\Session;

class User extends DbModel
{
    protected $id;
    protected $login;
    protected $pass;

    public static function isAdmin()
    {
        return static::getName() == 'Admin';
    }

    public static function auth($login, $pass)
    {
        $user = User::getOneWhere('login', $login);
        if (password_verify($pass, $user->pass)) {
            $_SESSION['login'] = $login;
//            new Session('login', $login);
            $_SESSION['id'] = $user->id;
//            new Session('id', $user->id);
//            var_dump($_SESSION);
            return true;
        } else {
            return false;
        }
    }

    public static function isAuth()
    {
        return isset($_SESSION['login']);
    }

    public static function getName()
    {
        return $_SESSION['login'];
    }

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