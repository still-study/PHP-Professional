<?php
//    App::call()->session->sessionStart();
session_start();

use app\engine\App;

require_once '../vendor/autoload.php';
$config = include "../config/config.php";


try {
    App::call()->run($config);
} catch (\Exception $e) {
    var_dump($e);
}
