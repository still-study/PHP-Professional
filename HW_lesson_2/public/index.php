<?php
//    App::call()->session->sessionStart();
session_start(); //ПОЧЕМУ ТО НЕ ПОЛУЧИЛОСЬ ПЕРЕДЕЛАТЬ НА App::

use app\engine\App;

require_once '../vendor/autoload.php';
$config = include "../config/config.php";


try {
    App::call()->run($config);
} catch (\Exception $e) {
    var_dump($e);
}
