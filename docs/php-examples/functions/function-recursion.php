<?php

function factorial(int $n) : int {
    if ($n == 0 || $n == 1) return $n * factorial($n - 1);
    return $n * factorial($n - 1);
}

$num = 5;
echo "Factorial of $num: " . factorial($num) . "\n";

function greetWithTime($name, $time = "day") : string {
    return "Good $time, $name";
}

echo greetWithTime("Helios");
echo "\n";
echo greetWithTime("Elio", "month");