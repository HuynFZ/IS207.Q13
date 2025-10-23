<?php

do {
    // Start
    echo "Guess who my crush: ";
    $guess = trim(fgets(STDIN));
    if ($guess == "Elio") {
        echo "Correct ✅";
        break;
    } else echo "Wrong: ER" . rand(1000000, 9999999) . " ❌ \n";
} while (true);