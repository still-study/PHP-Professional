<?php


namespace app\models\entities;


class OrderProduct extends Model
{

    protected $order_id;
    protected $product_id;
    protected $price;
    protected $quantity;


    protected $props = [
        'order_id' => false,
        'product_id' => false,
        'price' => false,
        'quantity' => false,
    ];

    public function __construct($order_id = null, $product_id = null, $price = null, $quantity = null)
    {
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->price = $price;
        $this->quantity = $quantity;

    }

}