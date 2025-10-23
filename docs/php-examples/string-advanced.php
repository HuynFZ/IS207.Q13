<?php

$mb_string = "こんにちは";
var_dump(mb_strlen($mb_string));
$url = "https://www.udemy.com/course/laravel-beginner-fundamentals/learn/lecture/46135881#content";
var_dump(urlencode($url));
var_dump(urldecode(urlencode($url)));

$html = '<p> This is "Quoted" text & a <a href="#">Link</a>.</p>';
var_dump(htmlentities($html));
var_dump(base64_encode("Helios"));
var_dump(base64_decode(base64_encode("Helios")));