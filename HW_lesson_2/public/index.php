<?php

use app\models\{Product, User, Order, Feedback};
use app\engine\Db;
use app\engine\Autoload;
include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);

$product = new Product(new Db());
$user = new User(new Db());
$order = new Order(new Db());
$feedback = new Feedback(new Db());



var_dump($product->getOne(5));
var_dump($user->getAll());
var_dump($order->getOne(33));
var_dump($feedback->delete(57));