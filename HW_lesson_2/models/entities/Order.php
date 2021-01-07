<?php


namespace app\models\entities;


class Order extends Model
{
    protected $id;
    protected $first_name;
    protected $last_name;
    protected $address;
    protected $tel;


    protected $props = [
        'first_name' => false,
        'last_name' => false,
        'address' => false,
        'tel' => false
    ];


    public function __construct($first_name = null, $last_name = null, $address = null, $tel = null)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->address = $address;
        $this->tel = $tel;
    }


}