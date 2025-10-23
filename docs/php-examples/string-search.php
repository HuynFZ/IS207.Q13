<?php

$haystack = "A Jellyfish Jellofish";
$pos = strpos($haystack, "Je");
var_dump($pos);
var_dump(str_replace("Je", "Ra", $haystack));
preg_match_all('/\w{9}/', $haystack, $matches);
var_dump($matches);
