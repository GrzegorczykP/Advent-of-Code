<?php

declare(strict_types=1);

namespace App2021\Assignments;

use App2021\BaseAssignment;

final class Day3 extends BaseAssignment
{
    private array $rows;

    public function __construct(bool $isTest = false, int $day = 3)
    {
        parent::__construct($isTest, $day);
        $this->rows = explode(PHP_EOL, $this->inputData);
    }

    public function run(): array
    {
        return [
            $this->run1(),
            $this->run2(),
        ];
    }

    public function run1(): int
    {
        $half = count($this->rows) / 2;

        $countedBits = array_reduce($this->rows, static function ($carry, $item) {
            foreach ($carry as $key => &$bitCount) {
                $bitCount += (int)$item[$key];
            }

            return $carry;
        }, array_fill(0, strlen($this->rows[0]), 0));

        $gamma = bindec(array_reduce($countedBits, static function ($carry, $item) use ($half) {
            return $carry . ($item > $half ? '1' : '0');
        }, ''));

        $epsilon = bindec(array_reduce($countedBits, static function ($carry, $item) use ($half) {
            return $carry . ($item < $half ? '1' : '0');
        }, ''));

        return $gamma * $epsilon;
    }

    private function run2(): int
    {
        $o2 = $this->rows;
        $co2 = $this->rows;
        $depth = 0;
        $maxDepth = strlen($this->rows[0]);

        do {
            $halfO2 = count($o2) / 2;
            if ($halfO2 >= 1) {
                $countedBitsO2 = array_reduce($o2, static function ($carry, $item) use ($depth) {
                    $carry += (int)$item[$depth];

                    return $carry;
                });
                $o2 = array_filter($o2, static fn ($item) => $item[$depth] === ($countedBitsO2 >= $halfO2 ? '1' : '0'));
            }

            $halfCO2 = count($co2) / 2;
            if ($halfCO2 >= 1) {
                $countedBitsCO2 = array_reduce($co2, static function ($carry, $item) use ($depth) {
                    $carry += (int)$item[$depth];

                    return $carry;
                });
                $co2 = array_filter($co2, static fn ($item) => $item[$depth] === ($countedBitsCO2 >= $halfCO2 ? '0' : '1'));
            }
            $depth++;
        } while ($halfO2 >= 1 || $halfCO2 >= 1);

        return bindec(array_values($o2)[0]) * bindec(array_values($co2)[0]);
    }
}
