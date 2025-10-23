<?php

include_once "config.php";
# include_once makes sure it won't include more than once
# The same with require_once
# include "config.php"; would just return some warnings
# require "config.php"; would crash if the file doesn't exist

echo "Database $dbHost:$dbUser:$dbPass";