<?php
//general interface of multiton
abstract class FactoryAbstruct
{
    protected static $instances = [];

    final protected static function getClassName()
    {
        return get_called_class();
    }

    public static function getInstance()
    {
        $className = static::getClassName();
        if (@!(self::$instances[$className] instanceof $className)) {
            self::$instances[$className] = new $className();
        }
        return self::$instances[$className];
    }

    public static function deleteInstance()
    {
        $className = static::getClassName();
        if (array_key_exists($className, self::$instances)) {
            unset(self::$instances[$className]);
        }
    }

    protected function __construct(){}
    final protected function __clone(){}
    final protected function __sleep(){}
    final protected function __wakeup(){}
    
}

//interface of multiton (pool of singletons)

abstract class Factory extends FactoryAbstruct
{
    final public static function getInstance()
    {
        return parent::getInstance();
    }

    final public static function deleteInstance()
    {
        parent::deleteInstance();
    }
}

//first singleton
class FirstProd extends Factory
{
    public $prop = [];
}

class SecondProd extends Factory{}

FirstProd::getInstance()->prop[] = 1;
SecondProd::getInstance()->prop[] = 2;
FirstProd::getInstance()->prop[] = 3;
SecondProd::getInstance()->prop[] = 4;

var_dump(FirstProd::getInstance()->prop);
var_dump(SecondProd::getInstance()->prop);
