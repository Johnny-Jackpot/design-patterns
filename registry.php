<?php
//use regustry instead global variables
class Registry
{
    protected static $data =  [];

    public static function set($key, $value)
    {
        self::$data[$key] = $value;
    }

    public static function get($key)
    {
        return isset(self::$data[$key]) ? self::$data[$key] : null;
    }

    final public static function delete($key)
    {
        if (array_key_exists($key, self::$data)) {
            unset(self::$data[$key]);
        }
    }
}

Registry::set('key1', 'value1');
Registry::set('key2', 'value2');

echo Registry::get('key1');
echo "\n";
echo Registry::get('key2');
echo "\n";

Registry::delete('key2');

echo Registry::get('key2');