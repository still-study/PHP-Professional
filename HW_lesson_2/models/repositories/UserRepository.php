<?php


namespace app\models\repositories;

use app\models\entities\User;
use app\models\Repository;

class UserRepository extends Repository
{
    public function isAdmin()
    {
        return $this->getName() == 'admin';
    }

    public function auth($login, $pass)
    {
        $user = (new UserRepository())->getOneWhere('login', $login);
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

    public function isAuth()
    {
        return isset($_SESSION['login']);
    }

    public function getName()
    {
        return $_SESSION['login'];
    }

    protected function getEntityClass()
    {
        return User::class;
    }

    protected function getTableName()
    {
        return "users";
    }

}