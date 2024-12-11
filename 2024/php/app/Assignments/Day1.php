<?php

declare(strict_types=1);

namespace App2024\Assignments;

use Illuminate\Support\Collection;

/**
 * @property Collection{left: Collection<int>, right: Collection<int>} $parsedData
 */
final class Day1 extends \App2024\BaseAssignment
{
    protected int $day = 1;

    public function parseInput(string $input): Collection
    {
        $lines = explode(PHP_EOL, $input);

        $left = collect();
        $right = collect();

        foreach ($lines as $line) {
            [$leftValue, $rightValue] = preg_split('/\s+/', $line);
            $left[] = (int) $leftValue;
            $right[] = (int) $rightValue;
        }

        return collect(compact('left', 'right'));
    }

    protected function part1(): int
    {
        $leftSorted = $this->parsedData['left']->sort()->values();
        $rightSorted = $this->parsedData['right']->sort()->values();

        return $leftSorted
            ->reduce(fn(int $sum, int $v, int $i): int => $sum + abs($v - $rightSorted[$i]), 0);
    }

    protected function part2(): int
    {
        $countLeft = $this->parsedData['left']->countBy();
        $countRight = $this->parsedData['right']
            ->filter(fn(int $v): bool => $countLeft->keys()->contains($v))
            ->countBy();

        return $countLeft
            ->reduce(function (int $sum, int $count, int $v) use ($countRight): int {
                return $sum + $count * $v * ($countRight[$v] ?? 0);
            }, 0);
    }
}
