#!/usr/bin/env php
<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

if ($argc < 2) {
    die("Usage: php generate-day.php <year/day>\n");
}

$input = $argv[1];
if (!preg_match('#(?<year>\d{4})/(?<day>\d{1,2})#', $input, $matches)) {
    die("Invalid format. Use: YYYY/DD (e.g., 2024/5)\n");
}

$year = (int)$matches['year'];
$day = (int)$matches['day'];

$currentYear = (int)date('Y');
if ($year < 2015 || $year > $currentYear) {
    die("Year must be between 2015 and $currentYear\n");
}

if ($day < 1 || $day > 25) {
    die("Day must be between 1 and 25\n");
}

$baseDir = dirname(__DIR__);
$stubsDir = $baseDir . '/stubs';

// Generate Day class file
$dayStubPath = $stubsDir . '/Day.php.stub';
$targetDir = dirname($baseDir) . '/' . $year . '/php/app/Assignments';
$targetPath = $targetDir . '/Day' . $day . '.php';

if (!file_exists($dayStubPath)) {
    die("Day stub file not found at: $dayStubPath\n");
}

if (!is_dir($targetDir) && !mkdir($targetDir, 0777, true)) {
    die("Failed to create target directory: $targetDir\n");
}

if (file_exists($targetPath)) {
    die("Day$day.php already exists at: $targetPath\n");
}

$template = file_get_contents($dayStubPath);
$content = str_replace(
    ['{DAY}', '{YEAR}'],
    [$day, $year],
    $template
);

if (file_put_contents($targetPath, $content) === false) {
    die("Failed to write file: $targetPath\n");
}

echo "Successfully created Day$day.php for year $year\n";

// Generate or update test file
$testDir = $baseDir . '/tests';
$testFile = $testDir . '/Y' . $year . '.php';
$yearTestStubPath = $stubsDir . '/YearTest.php.stub';
$dayTestStubPath = $stubsDir . '/DayTest.php.stub';

if (!file_exists($yearTestStubPath)) {
    die("Year test stub file not found at: $yearTestStubPath\n");
}

if (!file_exists($dayTestStubPath)) {
    die("Day test stub file not found at: $dayTestStubPath\n");
}

if (!is_dir($testDir) && !mkdir($testDir, 0777, true)) {
    die("Failed to create test directory: $testDir\n");
}

// Create year test file if it doesn't exist
if (!file_exists($testFile)) {
    $yearTemplate = file_get_contents($yearTestStubPath);
    $yearContent = str_replace('{YEAR}', (string)$year, $yearTemplate);
    if (file_put_contents($testFile, $yearContent) === false) {
        die("Failed to create year test file: $testFile\n");
    }
    echo "Created new test file Y$year.php\n";
}

// Add day test method
$dayTemplate = file_get_contents($dayTestStubPath);
$dayTestContent = str_replace(
    ['{DAY}', '{YEAR}'],
    [$day, $year],
    $dayTemplate
);

$currentContent = file_get_contents($testFile);
if (str_contains($currentContent, "testDay$day")) {
    die("Test for Day$day already exists in Y$year.php\n");
}

// Insert new test before the last closing brace
$currentContent = rtrim($currentContent);
$currentContent = substr($currentContent, 0, strrpos($currentContent, '}'));
$newContent = $currentContent . "\n" . $dayTestContent . "\n}";

if (file_put_contents($testFile, $newContent) === false) {
    die("Failed to update test file: $testFile\n");
}

echo "Successfully added test for Day$day to Y$year.php\n";
