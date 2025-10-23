<?php

class MathUtils {
    public static float $pi = 3.141592654;

    public static function square(float $num): float {
        return $num * $num;
    }
}

class Connection {
    private static Connection|null $instance = null;
    private function __construct() {}

    public static function singleton(): self {
        if (static::$instance == null) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}

$conn = Connection::singleton();
$conn2 = Connection::singleton();

var_dump(MathUtils::square(10));