<?php

$person = "Helios";
$client = &$person;

var_dump($person, $client);

$client = "Fire";

var_dump($person, $client);

$person = "Elio";

var_dump($person, $client);