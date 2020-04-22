<?php
/**
 * задания 1-4
 */

class Cart {
    public $isEmpty;
    public $dateCreate;

    public function pushToCart(){
        //добавление item в корзину
    }

    public function clearCart(){
        //удаление items из корзины
    }
}

class CartItem extends Cart {
    public $count;
    public $id;
    public $name;
    public $price;

    public function deleteFromCart(){
        //удаление item
    }

    public function increaseCount(){
        //увеличение количества товара в корзине
    }
}

/**
 * задания 5-6
 */

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();

var_dump($a1->foo());
var_dump($a2->foo());
var_dump($a1->foo());
var_dump($a2->foo());
//1 2 3 4, тк статичесские переменные принадлежат классу, а не экземплярам
//каждый раз вызвывая f foo(), мы меняем одну и ту же переменную

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

var_dump($a1->foo());
var_dump($b1->foo());
var_dump($a1->foo());
var_dump($b1->foo());

//тут мы уже создаем новую статичную переменную в новом классе, поэтому 1 1 2 2
