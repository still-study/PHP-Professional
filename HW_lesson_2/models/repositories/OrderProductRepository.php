<?php


namespace app\models\repositories;


use app\models\entities\OrderProduct;
use app\models\Repository;

class OrderProductRepository extends Repository
{
    protected function getEntityClass()
    {
        return OrderProduct::class;
    }

    protected function getTableName()
    {
        return "order_product";
    }
}