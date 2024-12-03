<?php

declare(strict_types=1);

namespace App2024\Assignments;

final class Day3 extends \App2024\BaseAssignment
{
    public function __construct(bool $isTest = false, int $day = 3)
    {
        parent::__construct($isTest, $day);
    }

    public function parseInput(string $input): null
    {
        return null;
    }

    public function run(): array
    {
        return [
            $this->run1(),
            $this->run2(),
        ];
    }

    private function run1(): int|string
    {
        preg_match_all('/mul\((\d+),(\d+)\)/', $this->inputData, $matches);

        return array_sum(array_map(fn (int $a, int $b): int => $a * $b, $matches[1], $matches[2]));
    }

    private function run2(): int|string
    {
        $parts = explode("don't()", $this->inputData);
        $res = [$parts[0]];

        foreach (array_slice($parts, 1) as $part) {
            if (($pos = strpos($part, 'do()')) !== false) {
                $res[] = substr($part, $pos);
            }
        }

        preg_match_all('/mul\((\d+),(\d+)\)/', implode('', $res), $matches);

        return array_sum(array_map(fn (int $a, int $b): int => $a * $b, $matches[1], $matches[2]));
    }
}
