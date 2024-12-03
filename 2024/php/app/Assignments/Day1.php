<?php

namespace App2024\Assignments;

use Illuminate\Support\Collection;

/**
 * @property Collection{left: Collection<int>, right: Collection<int>} $parsedData
 */
final class Day1 extends \App2024\BaseAssignment
{
    public function __construct(bool $isTest = false, int $day = 1)
    {
        parent::__construct($isTest, $day);
    }

    public function parseInput(string $input): Collection
    {
        $lines = explode(PHP_EOL, $input);

        $left = collect();
        $right = collect();

        foreach ($lines as $line) {
            [$leftValue, $rightValue] = preg_split('/\s+/', $line);
            $left[] = (int)$leftValue;
            $right[] = (int)$rightValue;
        }

        return collect(compact('left', 'right'));
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
        $leftSorted = $this->parsedData['left']->sort()->values();
        $rightSorted = $this->parsedData['right']->sort()->values();

        return $leftSorted
            ->reduce(fn (int $sum, int $v, int $i): int => $sum + abs($v - $rightSorted[$i]), 0);
    }

    private function run2(): int|string
    {
        $countLeft = $this->parsedData['left']->countBy();
        $countRight = $this->parsedData['right']
            ->filter(fn (int $v): bool => $countLeft->keys()->contains($v))
            ->countBy();

        return $countLeft
            ->reduce(function (int $sum, int $count, int $v) use ($countRight): int {
                return $sum + $count * $v * ($countRight[$v] ?? 0);
            }, 0);
    }
}
