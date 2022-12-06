<?php

namespace App2022\Assignments;

use App2022\BaseAssignment;
use Illuminate\Support\Collection;

final class Day3 extends BaseAssignment
{
    public function __construct(bool $isTest = false, int $day = 3)
    {
        parent::__construct($isTest, $day);
    }

    public function parseInput(string $input): Collection
    {
        return collect(explode(PHP_EOL, $input));
    }

    public function run(): array
    {
        return [
            $this->run1(),
            $this->run2(),
        ];
    }

    private function getPriorityMap(): array
    {
        $out = [];
        for ($i = 1; $i <= 26; $i++) {
            $out[chr($i + 96)] = $i;
            $out[chr($i + 64)] = $i + 26;
        }
        return $out;
    }

    private function run1(): int
    {
        $priorityMap = $this->getPriorityMap();

        return $this->parsedData
            ->map(function ($row) {
                $split = collect(str_split($row));
                $halfIndex = $split->count() / 2;
                return $split->chunk($halfIndex);
            })
            ->reduce(
                fn(int $sum, Collection $v): int => $sum + $priorityMap[$v[0]->intersect($v[1])->first()],
                0
            );
    }

    private function run2(): int
    {
        $priorityMap = $this->getPriorityMap();

        return $this->parsedData
            ->map(fn($row) => str_split($row))
            ->chunk(3)
            ->reduce(
                function (int $sum, Collection $v) use ($priorityMap): int {
                    $shared = array_reverse(array_intersect(...$v->toArray()));
                    return $sum + $priorityMap[array_pop($shared)];
                },
                0
            );
    }
}
