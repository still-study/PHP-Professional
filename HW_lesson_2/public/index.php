<?php

use app\models\{Product, User, Order, Feedback};
use app\engine\Db;
use app\engine\Autoload;
//use app\controllers\ProductController;
include "../config/config.php";
include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);

$controllerName = $_GET['c'] ?: 'product';
$actionName = $_GET['a'];

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if(class_exists($controllerClass)) {
    $controller = new $controllerClass();
    $controller->runAction($actionName);
}



/** @var Product $product */

die();
//  **CREATE**
$product = new Product("Кофе", "Колумбийский", 500);
$product->save();

//  **READ**
$product = Product::getOne(52);
$product = Product::getAll();

//  **UPDATE**
$product = Product::getOne(52);
$product->name = 'Бананы';
$product->description = 'Эквадорские';
$product->price = 150;
$product->save();

//  **DELETE**
$product = Product::getOne(52);
$product->delete();


var_dump($product);



