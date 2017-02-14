<?php

interface IBuilder {
    public function createVehicle();
    public function addWheel();
    public function addEngine();
    public function getVehicle();
}

abstract class Vehicle {
    private $data = [];

    public function setPart($key, $value) {
        $this->data[$key] = $value;
    }
}

class Truck extends Vehicle {}
class Car extends Vehicle {}

class Engine {}
class Wheel {}

class TruckBuilder implements IBuilder {
    private $truck;

    public function createVehicle() {
        $this->truck = new Truck();
    }

    public function addEngine() {
        $this->truck->setPart('truckEngine', new Engine());
    }

    public function addWheel() {
        for ($i = 1; $i < 7; $i++) {
            $this->truck->setPart("wheel$i", new Wheel());
        }
    }

    public function getVehicle() {
        return $this->truck;
    }
}

class CarBuilder implements IBuilder {
    private $car;

    public function createVehicle() {
        $this->car = new Car();
    }

    public function addEngine() {
        $this->car->setPart('carEngine', new Engine());
    }

    public function addWheel() {
        $wheels = ['wheelFL', 'wheelFR', 'wheelRL', 'wheelRR'];
        foreach ($wheels as $wheel) {
            $this->car->setPart($wheel, new Wheel());
        }
    }

    public function getVehicle() {
        return $this->car;
    }
}

class Creator {
    public function build(IBuilder $builder) {
        $builder->createVehicle();
        $builder->addWheel();
        $builder->addEngine();
        
        return $builder->getVehicle();
    }
}

$creator = new Creator();

$car = $creator->build(new CarBuilder());
$truck = $creator->build(new TruckBuilder());

var_dump($car);
var_dump($truck);