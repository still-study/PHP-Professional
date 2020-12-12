<?php


namespace app\models;


class Basket extends DbModel
{

    protected $id;
    protected $session_id;
    protected $product_id;

    public function getBasket($session_id)
    {
        $sql = "SELECT basket.id basket_id, products.id prod_id, products.name, products.description, products.price
FROM `basket`,`products` WHERE `session_id` = '111' AND basket.product_id = products.id";
        return [];
    }

    protected static function getTableName()
    {
        return "basket";
    }

}