<?php
namespace modulo3;
require __DIR__ . '../vendor/autoload.php';

if (count($argv) !== 2 || strlen(trim($argv[1])) < 0 )
{
    echo ("Usage: php.exe $argv[0] <binaryString>");
    exit(1);
}