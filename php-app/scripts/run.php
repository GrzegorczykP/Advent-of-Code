#!/usr/bin/env php
<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

if ($argc < 2) {
    die("Usage: php run.php <class_name|year/day> [--test]\n");
}

$className = $argv[1];
if (preg_match('#(?<year>\d{4})/(?<day>\d{1,2})#', $className, $matches)) {
    $className = 'App' . $matches['year'] . '\Assignments\Day' . ltrim($matches['day'], '0');
}
$isTest = in_array('--test', $argv, true);

/**
 * @param Closure $func
 * @param ?array $benchmarks array{
 *     time: float,
 *     timeFormatted: string,
 *     memory: int,
 *     memoryFormatted: string
 * }
 * @return mixed
 */
function benchmark(Closure $func, ?array &$benchmarks): mixed
{
    $timeUnits = ['ns', 'μs', 'ms', 's', 'm', 'h'];
    $memoryUnits = ['B', 'KB', 'MB', 'GB', 'TB'];

    $startTime = hrtime(true);
    $startMemory = memory_get_usage();
    $result = $func();
    $endMemory = memory_get_usage();
    $endTime = hrtime(true);

    $bytes = $endMemory - $startMemory;
    $time = $endTime - $startTime;

    $benchmarks = [
        'time' => $time,
        'timeFormatted' => @round($time / (1000 ** ($i = floor(log($time, 1000)))), 2) . ' ' . $timeUnits[$i],
        'memory' => $bytes,
        'memoryFormatted' => @round($bytes / (1024 ** ($i = floor(log($bytes, 1024)))), 2) . ' ' . $memoryUnits[$i],
    ];

    return $result;
}

try {
    if (!class_exists($className)) {
        throw new RuntimeException("Class $className not found");
    }

    /** @var \App2024\BaseAssignment $puzzle */
    $puzzle = benchmark(fn () => new $className($isTest), $parseBenchmarks);
    $results = benchmark(fn () => $puzzle->run(), $executeBenchmarks);

    echo "Part 1: " . $results[0] . PHP_EOL;
    echo "Part 2: " . $results[1] . PHP_EOL;

    if ($parseBenchmarks) {
        echo PHP_EOL;
        echo "Parse time: " . $parseBenchmarks['timeFormatted'] . PHP_EOL;
        echo "Parse memory: " . $parseBenchmarks['memoryFormatted'] . PHP_EOL;
    }

    if ($executeBenchmarks) {
        echo PHP_EOL;
        echo "Execute time: " . $executeBenchmarks['timeFormatted'] . PHP_EOL;
        echo "Execute memory: " . $executeBenchmarks['memoryFormatted'] . PHP_EOL;
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage() . PHP_EOL);
}
