<?php


namespace app\controllers;

use app\engine\App;
use app\models\User;
use app\engine\Session;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $request = App::call()->request;
        $login = $request->getParams()['login'];
        $pass = $request->getParams()['pass'];
        if (App::call()->userRepository->auth($login, $pass)) {
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
        header("location:" . App::call()->request->getRefererPage());
        die;
    }
}