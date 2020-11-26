<?php

class Human
{
    public $name;
    public $money;

    public function __construct($name, $money)
    {
        $this->name = $name;
        $this->money = $money;
    }


}

class Driver extends Human
{

    public function driveBus(Bus $bus)
    {
        echo "{$this->name} ведет {$bus->color} {$bus->type} автобус <br>";
    }
}

class Bus
{
    public $color;
    public $type;

    public function __construct($color, $type)
    {
        $this->color = $color;
        $this->type = $type;
    }
}

class Conductor extends Human
{
    public $price;

    public function __construct($name, $money, $price)
    {
        parent::__construct($name, $money);
        $this->price = $price;
    }

    public function getMoney(Passenger $passengers)
    {
        echo "{$this->name} получает от {$passengers->name} оплату за проезд {$this->price} рублей <br>";
        $this->money += $this->price;
        $passengers->money -= $this->price;
    }
}

class Passenger extends Human
{

}

$driver = new Driver('Боб (водитель)', 150);
$conductor = new Conductor('Анна (кондуктор)', 3000, 20);
$passenger = new Passenger('Ник (пассажир)', 50);
$busPass = new Bus('красный', 'пассажирский');

echo "У водителя - {$driver->money} рублей <br>
У кондуктора - {$conductor->money} рублей <br>
У пассажира - {$passenger->money} рублей <br><br>";

$driver->driveBus($busPass);;
$conductor->getMoney($passenger);

echo "<br>Остаток у водителя - {$driver->money} рублей <br>
Остаток у кондуктора - {$conductor->money} рублей <br>
Остаток у пассажира - {$passenger->money} рублей <br><br>";