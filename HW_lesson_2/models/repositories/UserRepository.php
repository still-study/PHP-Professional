<?php


namespace app\models\repositories;

use app\engine\App;
use app\engine\Session;
use app\models\entities\User;
use app\models\Repository;

class UserRepository extends Repository
{
    public function isAdmin()
    {
        return $this->getName() == 'admin';
    }

    public function classMenu()
    {
        if($this->isAdmin()) {
            return 'menu_admin';
        } else return 'menu';
    }

    public function auth($login, $pass)
    {
        $user = App::call()->userRepository->getOneWhere('login', $login);
        $session = new Session();

        if (password_verify($pass, $user->pass)) {
            $session->setSession('login', $login);
            $session->setSession('id', $user->id);
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