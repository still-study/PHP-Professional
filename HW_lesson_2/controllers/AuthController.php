<?php


namespace app\controllers;


use app\engine\Request;
use app\models\repositories\UserRepository;
use app\models\User;
use app\engine\Session;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $request = new Request();
        $login = $request->getParams()['login'];
        $pass = $request->getParams()['pass'];
        if ((new UserRepository())->auth($login, $pass)) {
            header("location:" . $request->getRefererPage());
        } else {
            die("Неверный логин пароль");
        }

    }

    public function actionLogout()
    {
        $session = new Session();
        $session->sessionRegenerate();
        $session->sessionStop();
        header("location:" . (new Request())->getRefererPage());
        die;
    }
}