<?php

echo "Input size: ";
$size = trim(fgets(STDIN));

switch ($size) {
    case "M":
        echo "Medium";
        break;
    case "L":
        echo "Large";
        break;
    case "XL":
    case "XXL":
    case "XXXL":
        echo "Extra Large";
        break;
    default:
        echo "Unknown";
}

