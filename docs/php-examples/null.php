<?php

declare(strict_types=1);
$abc = null;
$db = $abc ?? "Default";
var_dump(
    null == null,
    null == false,
    null == 0,
    null == '',
    null == [],
    $abc,
    isset($def),
    isset($abc),
    is_null($abc),
    $db,
    empty([]),
    empty(0),
);

function greet(?string $name) {
    echo "Hello, " . ($name ?? "Stranger") . "!\n";
}

greet("Helios");
greet(null);

var_dump(
    array_filter([1, null, '', [], 0, false, 3]),
    array_filter(
        [4, '', [], 0, false, 3],
        function($v) {
            return $v == null;
        }),
);