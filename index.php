<?php

//class Human {
//    public $name;
//    public $health;
//
//    public function __construct($name = null, $health = null)
//    {
//        $this->name = $name;
//        $this->health = $health;
//    }
//
//    function say()
//    {
//        echo "My name is {$this->name} and I have {$this->health} lives<br>";
//    }
//}
//
//class Warrior extends Human {
//    public $damage;
//
//    public function __construct($name = null, $health = null, $damage = null)
//    {
//        parent::__construct($name, $health);
//        $this->damage = $damage;
//    }
//
//    public function attack(Human $unit)
//    {
//        $unit->health -= $this->damage;
//        echo "{$this->name} attack {$unit->name}<br>";
//        echo "Health = {$unit->health}";
//    }
//
//    public function say()
//    {
//        parent::say();
//        echo "I can attack with damage {$this->damage}";
//    }
//
//}
//
//$human = new Human('Alex', 100);
//$human->say();
//
//$warrior = new Warrior('Conan', 200, 20);
//$warrior->say();
//
//$warrior->attack($human);
//
//
//
////var_dump($human);
////var_dump($warrior);

class Bake
{

}

class ElectricBake extends Bake
{
    public function work()
    {
        echo 'Use Electric';
    }
}

class GazBake extends Bake
{
    public function work()
    {
        echo 'Use Gaz';
    }
}

class Baker
{
    public function toBake(Bake $bake)
    {
        $bake->work();
    }
}

$gaz = new GazBake();
$elect = new ElectricBake();
$worker = new Baker();

$worker->toBake($gaz);
$worker->toBake($elect);