<?php

declare(strict_types=1);

namespace App2022\Assignments;

use Illuminate\Support\Collection;

final class Day1 extends \App2022\BaseAssignment
{
    public function __construct(bool $isTest = false, int $day = 1)
    {
        parent::__construct($isTest, $day);
    }

    public function parseInput(string $input): Collection
    {
        return collect(
            array_map(
                static fn (string $v): array => array_map('intval', explode(PHP_EOL, $v)),
                explode(PHP_EOL . PHP_EOL, $input)
            )
        );
    }

    public function run(): array
    {
        return [
            $this->run1(),
            $this->run2(),
        ];
    }

    private function run1(): int
    {
        return $this->parsedData
            ->map(fn ($v) => array_sum($v))
            ->max();
    }

    private function run2(): int
    {
        return $this->parsedData
            ->map(fn ($v) => array_sum($v))
            ->sortDesc()
            ->take(3)
            ->sum();
    }
}
