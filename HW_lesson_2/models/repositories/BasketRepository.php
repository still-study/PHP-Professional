<?php

namespace app\models\repositories;

use app\engine\Db;
use app\models\entities\Basket;
use app\models\Repository;

class BasketRepository extends Repository
{

    public static function getBasket($session_id)
    {
        $sql = "SELECT basket.id basket_id, products.id prod_id, products.name, products.description, products.price
FROM `basket`,`products` WHERE `session_id` = :session AND basket.product_id = products.id";
        return Db::getInstance()->queryAll($sql, ['session' => $session_id]);
    }

    protected function getEntityClass()
    {
        return Basket::class;
    }

    protected function getTableName()
    {
        return "basket";
    }
}