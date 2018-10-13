<?php
/**
 * Created by PhpStorm.
 * User: olegrasskazov
 * Date: 11.10.2018
 * Time: 17:55
 */

class A {
	public function foo() {
		static $x = 0;
		echo ++$x;
	}
}
class B extends A {
}
$a1 = new A;
$b1 = new B;
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();