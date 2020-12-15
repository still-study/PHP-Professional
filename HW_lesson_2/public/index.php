<?php
//(new Session())->sessionStart();
session_start();

use app\models\{Product, User, Basket, Feedback};
use app\engine\Autoload;
use app\engine\Render;
use app\engine\TwigRender;
use app\engine\Request;
use app\engine\Session;
include "../config/config.php";
include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);
require_once '../vendor/autoload.php';

$request = new Request();

$controllerName = $request->getControllerName() ?: 'product';
$actionName = $request->getActionName();

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if(class_exists($controllerClass)) {
//    $controller = new $controllerClass(new Render());
    $controller = new $controllerClass(new TwigRender());
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



