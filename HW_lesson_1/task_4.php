<?php
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo(); // 1
$b1->foo(); // 1
$a1->foo(); // 2
$b1->foo(); // 2

// В данном случае инкрементирование будет происходить в зависимости от экземпляров класса.
// Новый экземпляр создал другую статическую переменныю Х.