<?php

$name = "Helios";
$age = 20;

printf("Hello %s %d!\n", $name, $age);

$csv = "apple,banana,cherry,raspberry";
$fruits = explode(",", $csv);
var_dump($fruits, implode(",", $fruits));

$padded = str_pad("Hello", 20, "-", STR_PAD_BOTH);
var_dump($padded);
var_dump(trim("       Elio     "));

