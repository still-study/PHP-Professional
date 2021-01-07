<?php


namespace app\models\entities;


class Basket extends Model
{

    protected $id;
    protected $session_id;
    protected $product_id;
    protected $quantity;


    protected $props = [
        'session_id' => false,
        'product_id' => false,
        'quantity' => false,
    ];

    public function __construct($session_id = null, $product_id = null, $quantity = null)
    {
        $this->session_id = $session_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }

}