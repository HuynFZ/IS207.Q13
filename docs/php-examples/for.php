<?php

$times = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];
for ($i = 0; $i < count($times); $i++) {
    if ($i % 3 == 0) {
        echo $times[$i] . " ";
        sleep(1);
    }
}
echo "\n";
foreach ($times as $time) {
    echo $time . " ";
}