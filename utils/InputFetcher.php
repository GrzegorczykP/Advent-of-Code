#!/usr/bin/env php
<?php

class InputFetcher
{
    private string $sessionId;

    public function __construct(string $sessionId)
    {
        $this->sessionId = $sessionId;
    }

    public function fetchInput(int $year, int $day): string
    {
        $url = sprintf("https://adventofcode.com/%d/day/%d/input", $year, $day);
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_COOKIE => "session=" . $this->sessionId,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 3
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);

        curl_close($ch);

        if ($response === false) {
            throw new RuntimeException("Failed to fetch input: " . $error);
        }

        if ($httpCode !== 200) {
            throw new RuntimeException("Failed to fetch input. HTTP Status: " . $httpCode);
        }

        return rtrim($response);
    }

    public function saveInput(int $year, int $day): string
    {
        $dayDir = $this->createDir($year, $day);
        $input = $this->fetchInput($year, $day);

        $filepath = $dayDir . DIRECTORY_SEPARATOR . "input";

        if (file_put_contents($filepath, $input) === false) {
            throw new RuntimeException("Failed to save input to file: {$filepath}");
        }

        return $filepath;
    }

    private function fetchTaskPage(int $year, int $day): string
    {
        $url = sprintf("https://adventofcode.com/%d/day/%d", $year, $day);
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_COOKIE => "session=" . $this->sessionId,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 3
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);

        curl_close($ch);

        if ($response === false) {
            throw new RuntimeException("Failed to fetch task page: " . $error);
        }

        if ($httpCode !== 200) {
            throw new RuntimeException("Failed to fetch task page. HTTP Status: " . $httpCode);
        }

        return $response;
    }

    private function extractExample(string $html): ?string
    {
        preg_match('/For example:<\/p>\s*<pre><code>(.*?)<\/code><\/pre>/s', $html, $matches);

        return $matches[1] ?? null;
    }

    private function saveExample(string $example, string $dayDir): string
    {
        $filepath = $dayDir . DIRECTORY_SEPARATOR . "test";

        if (file_put_contents($filepath, trim($example)) === false) {
            throw new RuntimeException("Failed to save test file: {$filepath}");
        }

        return $filepath;
    }

    public function saveTestData(int $year, int $day): string
    {
        $dayDir = $this->createDir($year, $day);

        $html = $this->fetchTaskPage($year, $day);
        $example = $this->extractExample($html);

        if (empty($example)) {
            throw new RuntimeException("No example found in the task page");
        }
        $example = preg_replace('/<\/?em>/i', '', $example);

        return $this->saveExample($example, $dayDir);
    }

    public function createDir(int $year, int $day): string
    {
        $yearDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . $year;
        $dataDir = $yearDir . DIRECTORY_SEPARATOR . 'data';
        $dayDir = $dataDir . DIRECTORY_SEPARATOR . sprintf("%02d", $day);

        foreach ([$yearDir, $dataDir, $dayDir] as $dir) {
            if (!is_dir($dir) && !mkdir($dir, 0777, true) && !is_dir($dir)) {
                throw new RuntimeException("Failed to create directory: {$dir}");
            }
        }
        return $dayDir;
    }
}

if (PHP_SAPI !== 'cli') {
    die('This script must be run from the command line.');
}

if ($argc < 2) {
    die("Usage: php InputFetcher.php <year/day>\n");
}

preg_match('#(?<year>\d{4})/(?<day>\d{1,2})#', $argv[1], $matches);

if (empty($matches)) {
    die("Usage: php run.php <year/day> [--test]\n");
}

$sessionId = getenv('AOC_SESSION');

if (!$sessionId) {
    die("Please set AOC_SESSION environment variable with your session ID\n");
}

try {
    $fetcher = new InputFetcher($sessionId);

    // Save main input
    $inputFile = $fetcher->saveInput($matches['year'], $matches['day']);
    echo "Input saved to: {$inputFile}\n";

    // Save test data
    $testFile = $fetcher->saveTestData($matches['year'], $matches['day']);
    echo "Test data saved to: {$testFile}\n";
} catch (Exception $e) {
    die("Error: " . $e->getMessage() . "\n");
}
