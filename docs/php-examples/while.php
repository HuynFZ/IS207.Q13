<?php
$expo = 0;
while(true) {
    echo "Enter the password: ";
    $guess = trim(fgets(STDIN));
    if ($guess != "helios") $expo++;
    else {
        echo "Correct ✅";
        break;
    }
    echo "$expo attempts\n";
    if ($expo == 5) {
        echo "Too many trials. Blocked.";
        break;
    }
}