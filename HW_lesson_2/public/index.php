<?php

use app\models\{Product, User, Order, Feedback};
use app\engine\Db;
use app\engine\Autoload;
include "../config/config.php";
include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);


//CREATE
$product = new Product("Чай", "Цейлонский", 123);
$product->insert();


