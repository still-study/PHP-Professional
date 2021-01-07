<?php

namespace app\models\repositories;

use app\engine\App;
use app\models\entities\Basket;
use app\models\Repository;

class BasketRepository extends Repository
{

    public static function getBasket($session_id)
    {
        $sql = "SELECT basket.id basket_id, products.id prod_id, products.name, products.description,
basket.quantity, products.price * basket.quantity as amount
FROM `basket`,`products` WHERE `session_id` = :session AND basket.product_id = products.id";
        return App::call()->db->queryAll($sql, [':session' => $session_id, ]);
    }

    public function getBasketPrice($id)
    {
        $sql = "SELECT products.price FROM basket, products
WHERE session_id = :session AND basket.id = :id AND basket.product_id = products.id";
        return App::call()->db->queryOne($sql, [
            ':session' => session_id(),
            ':id' => $id
        ])['price'];
    }

    public function getBasketItem($name, $value)
    {
        $sql = "SELECT basket.id, basket.session_id, basket.product_id, basket.quantity
FROM basket, products WHERE session_id = :session AND `{$name}` = :{$name}";
        return App::call()->db->queryObject($sql, [
            ':session' => session_id(),
            ":{$name}" => $value
            ], $this->getEntityClass());
    }

    public function getTotalQuantity($session_id)
    {
        $sql = "SELECT SUM(quantity) as count FROM basket WHERE session_id = :session";
        return App::call()->db->queryOne($sql, [':session' => $session_id])['count'];
    }

    public function getTotalSum($session_id)
    {
        $sql = "SELECT SUM(basket.quantity * products.price) as sum FROM basket, products
WHERE session_id = :session AND basket.product_id = products.id";
        return App::call()->db->queryOne($sql, [':session' => $session_id])['sum'];
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