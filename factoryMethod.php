<?php

interface IFactory {
    public function getProduct();
}

interface IProduct {
    public function getName();
}

class FirstFactory implements IFactory {
    public function getProduct() {
        return new FirstProduct();
    }
}

class SecondFactory implements IFactory {
    public function getProduct() {
        return new SecondProduct();
    }
}

class FirstProduct implements IProduct {
    public function getName() {
        return 'first prod';
    }
}

class SecondProduct implements IProduct {
    public function getName() {
        return 'second product';
    }
}

$arr = ['FirstFactory', 'SecondFactory'];
for ($i = 0; $i < count($arr); $i++) {
    $factory = new $arr[$i]();
    $product = $factory->getProduct();
    var_dump($product->getName());
}