<?php

$name = "Helios";
echo '$name is $name';
echo "\n";
echo "$name is $name\n";

$heredoc = <<<EOD
Multiline
Helios
Ryuu $name
EOD;

$nowdoc = <<<'EOD'
Multiline
Helios
Ryuu $name
EOD;

echo $nowdoc;
echo "\n";
echo $heredoc;
echo "\n";
