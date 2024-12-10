<?php

declare(strict_types=1);

namespace App2024\Assignments;

final class Day3 extends \App2024\BaseAssignment
{
    protected int $day = 3;

    protected function part1(): int
    {
        preg_match_all('/mul\((\d+),(\d+)\)/', $this->inputData, $matches);

        return array_sum(array_map(fn (int $a, int $b): int => $a * $b, $matches[1], $matches[2]));
    }

    protected function part2(): int
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
