<?php

class SomeObject
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
//type of registry where you save objects instead of variables
class ObjectPool
{
    protected static $objects = [];

    public static function add(SomeObject $object)
    {
        $key = $object->getId();
        self::$objects[$key] = $object;
    }

    public static function get($id)
    {
        return isset(self::$objects[$id]) ? self::$objects[$id] : null;
    }

    public static function delete($id)
    {
        if (array_key_exists($id, self::$objects)) {
            unset(self::$objects[$id]);
        }
    }
}

for ($i = 0; $i < 10; $i++) {
    ObjectPool::add(new SomeObject('object' . $i));
}

echo ObjectPool::get('object1')->getId();


