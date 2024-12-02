<?php

namespace App2022\Assignments;

use Illuminate\Support\Collection;

final class Day4 extends \App2022\BaseAssignment
{
    public function __construct(bool $isTest = false, int $day = 4)
    {
        parent::__construct($isTest, $day);
    }

    public function parseInput(string $input): Collection
    {
        return collect(explode(PHP_EOL, $input))
            ->map(
                fn (string $v): Collection => collect(explode(',', $v))
                    ->map(fn (string $v): Collection => collect(explode('-', $v))->map(fn ($v) => (int)$v))
                    ->map(fn ($v) => range($v[0], $v[1]))
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
            ->filter(function ($row) {
                if (count($row[0]) > count($row[1])) {
                    return count(array_diff($row[1], $row[0])) === 0;
                }

                return count(array_diff($row[0], $row[1])) === 0;
            })->count();
    }

    private function run2(): int
    {
        return $this->parsedData
            ->filter(fn ($row) => count(array_intersect($row[0], $row[1])) > 0)
            ->count();
    }
}
