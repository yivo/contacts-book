<?php
namespace Library;

class Configuration {
    private static $_data = [];

    public static function get($key) {
        return isset(static::$_data[$key]) ? static::$_data[$key] : null;
    }

    public static function set($key, $value) {
        static::$_data[$key] = $value;
        return static::get($key);
    }
}