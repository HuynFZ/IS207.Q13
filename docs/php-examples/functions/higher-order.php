<?php

$users = [
    ["id" => 1, "name" => "Helios", "role" => "PM"],
    ["id" => 2, "name" => "Fire", "role" => "UX Designer"],
    ["id" => 3, "name" => "Elio", "role" => "PM"],
];

function createFilter($key, $value): Closure {
    return fn ($item) => $item[$key] === $value;
}

$isPM = createFilter("role", "PM");
$isFire = createFilter("name", "Fire");
$PM = array_filter($users, $isPM);
$fire = array_filter($users, $isFire);

foreach ($PM as $user) {
    foreach ($user as $key => $value) {
        echo $key . ": " . $value . "\n";
    }
};

foreach ($isFire as $user) {
    foreach ($user as $key => $value) {
        echo $key . ": " . $value . "\n";
    }
}