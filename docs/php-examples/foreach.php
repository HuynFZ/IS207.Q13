<?php

$basket = [
  "Apple" => 3,
  "Banana" => 5,
  "Orange" => 7
];

$total = 0;

foreach ($basket as $key => $value) {
    echo $key . " " . $value . "\n";
    $total += $value;
}

echo "Total: " . $total;