<?php

function greet(string $name, string $greeting = "Hello", bool $shout = false) {
    $message = $greeting . ", " . $name;
    return $shout ? strtoupper($message) : $message;
}

echo greet("Helios") . "\n";
echo greet("Elio", "Hi") . "\n";
echo greet("Elio", "Hey", true) . "\n";
echo greet("Elio", shout: true) . "\n";