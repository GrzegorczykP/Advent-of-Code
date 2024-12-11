<?php

declare(strict_types=1);

namespace App2022\Assignments;

use App2022\BaseAssignment;
use Illuminate\Support\Collection;

final class Day2 extends BaseAssignment
{
    public function __construct(bool $isTest = false, int $day = 2)
    {
        parent::__construct($isTest, $day);
    }

    public function parseInput(string $input): Collection
    {
        return collect(explode("\n", $input))
            ->map(fn($row) => explode(' ', $row));
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
        $scoreMap = [
            'A' => [
                'X' => 1 + 3,
                'Y' => 2 + 6,
                'Z' => 3 + 0,
            ],
            'B' => [
                'X' => 1 + 0,
                'Y' => 2 + 3,
                'Z' => 3 + 6,
            ],
            'C' => [
                'X' => 1 + 6,
                'Y' => 2 + 0,
                'Z' => 3 + 3,
            ],
        ];

        return $this->parsedData->reduce(fn(int $s, array $v): int => $s + $scoreMap[$v[0]][$v[1]], 0);
    }

    private function run2(): int
    {
        $scoreMap = [
            'A' => [
                'X' => 3 + 0,
                'Y' => 1 + 3,
                'Z' => 2 + 6,
            ],
            'B' => [
                'X' => 1 + 0,
                'Y' => 2 + 3,
                'Z' => 3 + 6,
            ],
            'C' => [
                'X' => 2 + 0,
                'Y' => 3 + 3,
                'Z' => 1 + 6,
            ],
        ];

        return $this->parsedData->reduce(fn(int $s, array $v): int => $s + $scoreMap[$v[0]][$v[1]], 0);
    }
}
