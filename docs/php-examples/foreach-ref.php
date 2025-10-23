<?php

$large = range(1, 1_000_000);

$startTime = microtime(true);
$startMemoryUsage = memory_get_usage();

foreach ($large as &$value) {
    $value = $value * 2;
}

$endTime = microtime(true);
$endMemoryUsage = memory_get_usage();

echo "Time: " . (($endTime - $startTime) * 1000) . "ms";
echo "\n";
echo "Memory : " . round(($endMemoryUsage - $startMemoryUsage) / 1024 / 1024) . "MB";

# ref use more memory and time than val