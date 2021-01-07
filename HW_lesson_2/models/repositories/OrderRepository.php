<?php


namespace app\models\repositories;


use app\engine\App;
use app\models\entities\Order;
use app\models\Repository;

class OrderRepository extends Repository
{
    public function getOrderProducts($id)
    {
        $sql = "SELECT products.name, products.description, order_product.quantity FROM order_product, orders, products
WHERE order_id = :id AND orders.id = :id AND order_product.product_id = products.id";
        return App::call()->db->queryAll($sql, [":id" => $id]);
    }

    protected function getEntityClass()
    {
        return Order::class;
    }

    protected function getTableName()
    {
        return "orders";
    }
}