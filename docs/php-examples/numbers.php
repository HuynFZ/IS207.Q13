<?php

$int = 42;
$float = 3.94;
$stringToInt = (int)"2004";
$floatToInt = (int)$float;

var_dump($int, $float, $stringToInt, $floatToInt);
var_dump(7 % 2 === 1);
var_dump(
    round($float),
    round(3.2),
    floor($float),
    ceil($float),
    min(1, 4, 6, 0),
    max(4, 1, 6, 8),
    rand(1, 200),
    abs(-2005)
);

$number = 12323123.89348423459;
echo "Formatted: " . number_format($number, 4, '.', ',');