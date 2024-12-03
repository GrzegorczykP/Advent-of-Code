<?php

declare(strict_types=1);

namespace App2021\Assignments;

use App2021\BaseAssignment;

final class Day7 extends BaseAssignment
{
    private array $positions;

    public function __construct(bool $isTest = false, int $day = 7)
    {
        parent::__construct($isTest, $day);
        $this->positions = explode(',', $this->inputData);
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
        $median = (int)round($this->getMedian());

        return $this->calcCost($median);
    }

    private function getMedian(): float
    {
        sort($this->positions);
        $count = count($this->positions);
        $index = floor($count / 2);
        if ($count & 1) {
            $median = $this->positions[$index];
        } else {
            $median = ($this->positions[$index - 1] + $this->positions[$index]) / 2;
        }

        return $median;
    }

    private function calcCost(int $alignTo, bool $constCost = true): int
    {
        if ($constCost) {
            return array_sum(array_map(static function ($item) use ($alignTo) {
                return abs($item - $alignTo);
            }, $this->positions));
        }

        return array_sum(array_map(static function ($item) use ($alignTo) {
            $dist = abs($item - $alignTo);
            if ($dist === 0) {
                return 0;
            }

            return array_sum(range(1, $dist));
        }, $this->positions));
    }

    private function run2(): int
    {
        $average = (int)floor($this->getAverage());

        return min([
            $this->calcCost($average, false),
            $this->calcCost($average + 1, false),
        ]);
    }

    private function getAverage(): float
    {
        $count = count($this->positions);

        return array_sum($this->positions) / $count;
    }
}
