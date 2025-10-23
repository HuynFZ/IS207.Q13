<?php
declare(strict_types=1);
$arr = [1, 2, 3];
function sum(int ...$numbers): int {
    var_dump(...$numbers);
    $sum = 0;
    foreach ($numbers as $number) {
        $sum += $number;
    }
    return $sum;
}

var_dump(sum(3, 34, 8 ,4));
var_dump(sum(1));
var_dump(sum(...$arr));

function ultimateGreet(string $name, string ...$suffixes): void {
    echo "$name " . implode(" ", $suffixes) . "\n";
}

ultimateGreet("Helios", "Mr.", "Ryuu");