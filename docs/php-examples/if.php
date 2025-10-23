<?php

$x = 10;
if ($x > 10) {
    echo "$x is greater than 10";
} elseif ($x < 10) {
    echo "$x is less than 10";
} else {
    echo "$x is 10";
}

echo "\n";

if ($x + 5 > 10) echo "This is $x + 5 and > 10";
elseif ($x + 5 < 10) echo "This is $x + 5 and < 10";
else echo "This is $x";