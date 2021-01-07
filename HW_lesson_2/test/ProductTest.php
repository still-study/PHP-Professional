<?php

use app\models\entities\Product;

class ProductTest extends \PHPUnit\Framework\TestCase
{
    /** @var Product $fixture*/
    protected $fixture;

    protected function setUp(): void
    {
        $this->fixture = new Product("Чай","Цейлонский","200");
    }
    public function testProduct()
    {
        $this->assertEquals('Чай', $this->fixture->name);
        $this->assertEquals('Цейлонский', $this->fixture->description);
        $this->assertEquals('200', $this->fixture->price);
    }

    protected function tearDown(): void
    {
        $this->fixture = null;
    }
}