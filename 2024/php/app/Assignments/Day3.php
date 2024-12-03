<?php

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
        preg_match_all('/mul\((?<first>\d+),(?<second>\d+)\)/', $this->inputData, $matches);

        return collect($matches['first'])
            ->zip($matches['second'])
            ->sum(fn ($v) => (int)$v[0] * (int)$v[1]);
    }

    private function run2(): int|string
    {
        $parts = explode("don't()", $this->inputData);

        $res = [array_shift($parts)];

        foreach ($parts as $part) {
            $exploded = explode('do()', $part, 2);
            if (isset($exploded[1])) {
                $res[] = $exploded[1];
            }
        }

        preg_match_all('/mul\((?<first>\d+),(?<second>\d+)\)/', implode('xxx', $res), $matches);

        return collect($matches['first'])
            ->zip($matches['second'])
            ->sum(fn ($v) => (int)$v[0] * (int)$v[1]);
    }
}
