<?php

declare(strict_types=1);

namespace App2024\Assignments;

use Illuminate\Support\Collection;

final class Day11 extends \App2024\BaseAssignment
{
    protected int $day = 11;

    private array $blinkCache = [];

    protected function parseInput(string $input): Collection
    {
        return collect(explode(' ', $input));
    }

    protected function part1(): int
    {
        $stones = $this->parsedDataArray;
        $finalStoneCount = 0;

        foreach ($stones as $key => $stone) {
            $finalStoneCount += $this->blink($stone, 25);
        }

        return $finalStoneCount;
    }

    protected function part2(): int|string
    {
        $stones = $this->parsedDataArray;
        $finalStoneCount = 0;

        foreach ($stones as $key => $stone) {
            $finalStoneCount += $this->blink($stone, 75);
        }

        return $finalStoneCount;
    }

    /**
     * @return int Count of stones after blinks $times
     */
    private function blink(string $stone, int $times): int
    {
        $cacheKey = "$stone:$times";
        if (isset($this->blinkCache[$cacheKey])) {
            return $this->blinkCache[$cacheKey];
        }

        if ($times === 0) {
            return 1;
        }

        switch (true) {
            case $stone === '0':
                $result = $this->blink('1', $times - 1);

                break;
            case ($strLength = strlen($stone)) % 2 === 0:
                $halfLength = $strLength / 2;
                $left = substr($stone, 0, $halfLength);
                $right = ltrim(substr($stone, $halfLength), '0');
                $right = empty($right) ? '0' : $right;
                $result = $this->blink($left, $times - 1) + $this->blink($right, $times - 1);

                break;
            default:
                $result = $this->blink((string) ((int) $stone * 2024), $times - 1);
        }

        $this->blinkCache[$cacheKey] = $result;

        return $result;
    }
}
