<?php

abstract class Prototype {
    protected $prop;
    protected $child;

    abstract public function __clone();

    public function getProp() {
        return $this->prop;
    }

    public function setProp($val) {
        $this->prop = $val;
    }
}

class FirstChild extends Prototype {
    protected $child = __CLASS__;

    public function __clone() {}
}

class SecondChild extends Prototype {
    protected $child = __CLASS__;

    public function __clone() {}
}

$arr = [];
$firstChild = new FirstChild();
$secondChild = new SecondChild();

for ($i = 0; $i < 5; $i++) {
    $firstChildClone = clone $firstChild;
    $firstChildClone->setProp($i);
    $arr[] = $firstChildClone;
}

foreach ($arr as $obj) {
    var_dump($obj);
}

for ($i = 0; $i < 4; $i++) {
    $isTheSameObject = $arr[$i] == $arr[$i + 1];
    var_dump($isTheSameObject);
}

