<?php

$numbers = [1, 2, 3, 4, 5];
$multiplier = 2;

$squared = array_map(function ($number) use ($multiplier) {
    return $number * $multiplier;
}, $numbers);

var_dump($squared);

$squared = array_map(
    fn ($number) => $number * $multiplier,
    $numbers
);

var_dump($squared);