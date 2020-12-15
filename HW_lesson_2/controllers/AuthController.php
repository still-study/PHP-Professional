<?php


namespace app\controllers;


use app\engine\Request;
use app\models\User;
use app\engine\Session;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $login = (new Request())->getParams()['login'];
        $pass = (new Request())->getParams()['pass'];
        if (User::auth($login, $pass)) {
            header("location:" . (new Request())->getRefererPage());
        } else {
            die("Неверный логин пароль");
        }

    }

    public function actionLogout()
    {
        session_destroy();
//        (new Session())->sessionStop();
        header("location:" . (new Request())->getRefererPage());
        die;
    }
}