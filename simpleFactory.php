<?php

class SimpleFactory {
    public function createBicycle() {
        return new Bicycle();
    }
}

class Bicycle {
    public function drive($destination) {}
}

$factory = new SimpleFactory();

$bicycles = [];
const BICYCLE_GROUP = 10;

for ($i = 1; $i <= BICYCLE_GROUP; $i++) {
    $bicycles[] = $factory->createBicycle();
}

var_dump($bicycles);