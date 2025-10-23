<?php

$required_php_version = '8.4.0';
$required_extensions = [
    'bcmath',
    'ctype',
    'curl',
    'dom',
    'fileinfo',
    'filter',
    'hash',
    'mbstring',
    'openssl',
    'pcre',
    'pdo',
    'session',
    'tokenizer',
    'xml',
    'json'
];

$missing_extensions = [];

// ANSI color codes
$green = "\033[32m";
$red = "\033[31m";
$yellow = "\033[33m";
$reset = "\033[0m";

// Get full path to PHP binary and php.ini file
echo "PHP binary path: " . PHP_BINARY . "\n";
echo "php.ini path: " . php_ini_loaded_file() . "\n";

// Check PHP version
$current_php_version = phpversion();
$php_version_status = version_compare($current_php_version, $required_php_version, '>=');
if ($php_version_status) {
    echo "{$green}OK{$reset} - PHP version is $current_php_version\n";
} else {
    echo "{$red}FAIL{$reset} - PHP version is $current_php_version (Required: $required_php_version or higher)\n";
}

// Check PHP extensions
foreach ($required_extensions as $extension) {
    if (!extension_loaded($extension)) {
        $missing_extensions[] = $extension;
    }
}

if (empty($missing_extensions)) {
    echo "{$green}OK{$reset} - All required PHP extensions are installed\n";
} else {
    echo "{$red}FAIL{$reset} - The following required PHP extensions are missing:\n";
    foreach ($missing_extensions as $missing) {
        echo "- $missing\n";
    }
}

// Check database connections
$db_connections = [
    'PostgreSQL (pdo_pgsql)' => 'pdo_pgsql',
    'MySQL (pdo_mysql)' => 'pdo_mysql',
    'SQLite (pdo_sqlite)' => 'pdo_sqlite',
];

foreach ($db_connections as $name => $extension) {
    if (extension_loaded($extension)) {
        echo "{$green}OK{$reset} - $name extension loaded\n";
    } else {
        echo "{$yellow}WARN{$reset} - $name extension NOT loaded\n";
    }
}

// Test actual database connections
echo "\n--- Database Connection Tests ---\n";

// MySQL
try {
    $pdo = new PDO("mysql:host=host.docker.internal;port=3306;dbname=appdb", 'appuser', 'secret');
    echo "{$green}OK{$reset} - Connected to MySQL\n";
} catch (PDOException $e) {
    echo "{$red}FAIL{$reset} - MySQL connection failed: {$e->getMessage()}\n";
}

// PostgreSQL
try {
    $pdo = new PDO("pgsql:host=host.docker.internal;port=5432;dbname=mydb", 'myuser', 'secret');
    echo "{$green}OK{$reset} - Connected to PostgreSQL\n";
} catch (PDOException $e) {
    echo "{$red}FAIL{$reset} - PostgreSQL connection failed: {$e->getMessage()}\n";
}