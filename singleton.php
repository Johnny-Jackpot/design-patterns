<?php
//to be sure that only one instance will be created
final class Singleton
{
    private static $instance;

    public $prop;

    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct(){}
    private function __clone(){}
    private function __sleep(){}
    private function __wakeup(){}
    
}

$insOne = Singleton::getInstance();
$insOne->prop = 'hello';

$insTwo = Singleton::getInstance();
$insTwo->prop = 'world';

echo $insOne->prop;