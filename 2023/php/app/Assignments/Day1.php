<?php

namespace App2023\Assignments;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

final class Day1 extends \App2023\BaseAssignment
{
    public function __construct(bool $isTest = false, int $day = 1)
    {
        parent::__construct($isTest, $day);
    }

    public function parseInput(string $input): Collection
    {
        return collect(explode(PHP_EOL, $input))
            ->map(fn($v) => mb_str_split($v));
    }

    public function run(): array
    {
        return [
            $this->run1(),
//            $this->run2()
        ];
    }

    private function run1(): int
    {
        return $this->parsedData
            ->map(fn($v) => (int)Arr::first($v, fn($v) => is_numeric($v)) . Arr::last($v, fn($v) => is_numeric($v)))
            ->sum();
    }

    private function run2(): int
    {
        return $this->parsedData
            ->map(fn($v) => array_sum($v))
            ->sortDesc()
            ->take(3)
            ->sum();
    }
}
