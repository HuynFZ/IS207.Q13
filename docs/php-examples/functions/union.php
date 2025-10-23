<?php

declare(strict_types=1);
function processInput(int|float|string $input): string {
    return match (true) {
        is_int($input) => "Integer: " . ($input * 2),
        is_float($input) => "Float: " . round($input, 2),
        is_string($input) => "String: " . strtoupper($input),
        default => "Unknown type"
    };
}

$inputs = [42, "Helios", 9.5, 7, 3, "Elio"];
foreach ($inputs as $input) {
    echo processInput($input) . "\n";
}

