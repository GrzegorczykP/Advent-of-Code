<?php

require_once __DIR__ . '/vendor/autoload.php';

if ($argc < 2) {
    die("Usage: php run.php <class_name|year/day> [--test]\n");
}

$className = $argv[1];
if (preg_match('#(?<year>\d{4})/(?<day>\d{1,2})#', $className, $matches)) {
    $className = 'App' . $matches['year'] . '\Assignments\Day' . ltrim($matches['day'], '0');
}
$isTest = in_array('--test', $argv, true);

try {
    if (!class_exists($className)) {
        throw new RuntimeException("Class $className not found");
    }

    /** @var \App2024\BaseAssignment $puzzle */
    $puzzle = new $className($isTest);
    $results = $puzzle->run();

    echo "Part 1: " . $results[0] . PHP_EOL;
    echo "Part 2: " . $results[1] . PHP_EOL;
} catch (Exception $e) {
    die("Error: " . $e->getMessage() . PHP_EOL);
}
