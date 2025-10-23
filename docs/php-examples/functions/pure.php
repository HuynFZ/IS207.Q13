<?php

// Pure function:
// - Return the same output every time when passing the same arguments
// - Predictable
// - Testable
// - Reusable
// - Cacheable
function add(int $a, int $b): int {
    return $a + $b;
}

var_dump(add(2, 3));
var_dump(add(2, 3));

$total = 0;
// Non-pure function
function addToTotal($value) {
    // Has variables as dependency
    global $total;
    // Side effect
    $total += $value;
    return $total;
}

var_dump(addToTotal(3));
var_dump(addToTotal(3));