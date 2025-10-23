<?php

$simpleArray = [14, 3, 66, 7, 8];
$associativeArray = [
    'name' => 'Helios',
    'age' => 20,
    'city' => 'HCM'
];

echo $associativeArray['city'];
echo $simpleArray[2];

$simpleArray[] = 42;
$associativeArray['country'] = 'VN';

$matrix = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];

$fruits = ['apple', 'orange', 'banana', 'kiwi'];
echo $matrix[1][1] . "\n";
var_dump(count($fruits));
sort($fruits);
var_dump($fruits);
rsort($fruits);
var_dump($fruits);

var_dump($associativeArray);
asort($associativeArray);
var_dump($associativeArray);
ksort($associativeArray);
var_dump($associativeArray);

$numbers = range(1, 5);
var_dump($numbers);
$squared = array_map(fn ($x) => $x * 2, $numbers);
var_dump($squared);
$evenNumbers = array_filter($numbers, fn ($x) => $x % 2 === 0);
var_dump($evenNumbers);
$sum = array_reduce($numbers, fn ($sum, $x) => $sum + $x, 42);
var_dump($sum);

$moreNumbers = [0, ...$numbers, 9999];
var_dump($moreNumbers);

[$first, , $second] = $fruits;
var_dump($first, $second);

$set1 = [1, 2, 3, 4, 5];
$set2 = [3, 4, 5, 6, 7];
var_dump(
    array_intersect($set1, $set2),
    array_diff($set1, $set2),
    array_diff($set2, $set1),
);

$keys = array_keys($associativeArray);
$keys_capitalized = array_map(fn ($x) => strtoupper($x), array_keys($associativeArray));
$values = array_values($associativeArray);
var_dump($keys, $values);
var_dump($keys_capitalized);
var_dump(
    array_key_exists('name', $associativeArray),
    in_array('Helios', $associativeArray),
);

$fruitsString = implode(', ', $fruits);
$backToArray = explode(', ', $fruitsString);

var_dump($fruitsString, $backToArray);

var_dump(
    array_merge($set1, $set2),
    array_merge($associativeArray, ['country' => 'US']),
    $set1 + $set2,
    $associativeArray + ['country' => 'US'],
    $associativeArray + ['time' => 'UTC+7'],
    [...$set1, ...$set2],
    [...$associativeArray, ...['country' => 'US']],
    array_unique(array_merge($set1, $set2)),
    array_slice($set1, 1, 3),
    array_search('banana', $fruits),
);