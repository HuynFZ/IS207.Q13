<?php

$str = "Hello World!";
echo $str[0];
echo $str[-1];
echo "\n";
echo substr($str, 0, 4);
echo "\n";
echo substr($str, 3);
echo "\n";
echo substr($str, 2, 5);
echo "\n";
echo strtoupper($str);
echo "\n";
echo strtolower($str);
echo "\n";
echo ucwords(strtolower($str));
echo "\n";
echo ucfirst(strtolower($str));
echo "\n";

$greeting = "Hello, " . "World!";
$greeting .= " How are you?";
echo $greeting;
