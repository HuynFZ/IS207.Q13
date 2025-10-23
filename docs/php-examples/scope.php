<?php

$superhero = "Superman";

function revealIdentity(): void {
    global $superhero;
    $message = "real name is Clark Kent";
    echo "$superhero $message\n";
}

revealIdentity();

function countVisitors(): void {
    static $counter = 0;
    $counter++;
    echo "Visitors: " . $counter . "\n";
}

countVisitors();
countVisitors();
countVisitors();