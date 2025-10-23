<?php

function countdown(int $start): array {
    $result = [];
    for ($i = 0; $i < $start; $i++) {
        echo "Generating number...\n";
        $result[] = random_int(0, 100);
    }
    return $result;
}

foreach (countdown(5) as $value) {
    echo "Echoing " . $value . "\n";
}

function countdown2(int $start): Generator {
    for ($i = 0; $i < $start; $i++) {
        echo "Yielding number...\n";
        yield random_int(0, 100);
    }
}

foreach (countdown2(5) as $value) {
    echo "Echoing " . $value . "\n";
}