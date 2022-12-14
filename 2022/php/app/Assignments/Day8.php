<?php

namespace App2022\Assignments;

use App2022\BaseAssignment;
use Illuminate\Support\Collection;

final class Day8 extends BaseAssignment
{
    public function __construct(bool $isTest = false, int $day = 8)
    {
        parent::__construct($isTest, $day);
    }

    public function parseInput(string $input): Collection
    {
        return collect(explode(PHP_EOL, $input))
            ->map(fn($row) => str_split($row));
    }

    public function run(): array
    {
        return [
            $this->run1(),
//            $this->run2(),
        ];
    }

    private function run1(): int
    {
        $n = $this->parsedData->count();

        $row = array_fill(0, $n, 0);
        $visibilityMap = array_fill(0, $n, $row);

        for ($i = 0; $i < $n; $i++) {
            for (
                $j = 0, $maxL = -1, $maxT = -1, $maxR = -1, $maxB = -1; $j < $n && min(
                $maxL,
                $maxT,
                $maxR,
                $maxB
            ) < 9; $j++
            ) {
                if ($this->parsedData[$i][$j] > $maxL) {
                    $visibilityMap[$i][$j]++;
                    $maxL = $this->parsedData[$i][$j];
                }
                if ($this->parsedData[$j][$i] > $maxT) {
                    $visibilityMap[$j][$i]++;
                    $maxT = $this->parsedData[$j][$i];
                }
                if ($this->parsedData[$i][$n - 1 - $j] > $maxR) {
                    $visibilityMap[$i][$n - 1 - $j]++;
                    $maxR = $this->parsedData[$i][$n - 1 - $j];
                }
                if ($this->parsedData[$n - 1 - $j][$i] > $maxB) {
                    $visibilityMap[$n - 1 - $j][$i]++;
                    $maxB = $this->parsedData[$n - 1 - $j][$i];
                }
            }
        }

        return collect($visibilityMap)->flatten()->filter()->count();
    }

    private function run2(): int
    {
        return 0;
    }

    private function printMap(array $map): never
    {
        dd(implode(PHP_EOL, array_map(fn($v) => implode('|', $v), $map)));
    }
}
