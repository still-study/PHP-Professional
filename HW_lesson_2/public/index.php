<?php

use app\models\{Product, User, Basket, Feedback};
use app\engine\Autoload;
use app\engine\Render;

include "../config/config.php";
include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);
require_once '../../vendor/autoload.php';

$url = explode('/', $_SERVER['REQUEST_URI']);

$controllerName = $url[1] ?: 'product';
$actionName = $url[2];

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if(class_exists($controllerClass)) {
//    $controller = new $controllerClass(new Render());
    $controller = new $controllerClass(new \app\engine\TwigRender());
    $controller->runAction($actionName);
}
















die();

/** @var Product $product */

//  **CREATE**
$product = new Product("Кофе", "Колумбийский", 500);
$product->save();

//  **READ**
$product = Product::getOne(52);
$product = Product::getAll();

//  **UPDATE**
$product = Product::getOne(53);
$product->name = 'Кофе';
$product->description = 'Эквадорские';
$product->price = 300;
$product->save();

//  **DELETE**
$product = Product::getOne(52);
$product->delete();


var_dump($product);



