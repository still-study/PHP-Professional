<?php


namespace app\models;


class Order extends DbModel
{

    public $id;
    public $user_id;
    public $items;
    public $status;
    public $fullName;
    public $address;
    public $commentOrder;
    public $paymentMethod;
    public $dateOrder;
    public $totalPrice;

    protected static function getTableName()
    {
        return "Order";
    }

}