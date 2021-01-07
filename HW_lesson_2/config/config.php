<?php

use app\engine\Db;
use app\engine\Request;
use app\engine\Session;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;
use app\models\repositories\BasketRepository;
use app\models\repositories\FeedbackRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\OrderProductRepository;

return [
    'root_dir' => dirname(__DIR__),
    'templates_dir' => dirname(__DIR__) . "/views/",
    'controllers_namespaces' => 'app\controllers\\',
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root',
            'password' => 'root',
            'database' => 'shop',
            'charset' => 'utf8'
        ],
        'request' => [
            'class' => Request::class
        ],
        'basketRepository' => [
            'class' => BasketRepository::class
        ],
        'productRepository' => [
            'class' => ProductRepository::class
        ],
        'userRepository' => [
            'class' => UserRepository::class
        ],
        'feedbackRepository' => [
            'class' => FeedbackRepository::class
        ],
        'session' => [
            'class' => Session::class
        ],
        'orderRepository' => [
            'class' => OrderRepository::class
        ],
        'orderProductRepository' => [
            'class' => OrderProductRepository::class
        ],


    ]
];