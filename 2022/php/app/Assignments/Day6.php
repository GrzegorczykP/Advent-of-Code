<?php

declare(strict_types=1);

namespace App2022\Assignments;

use Illuminate\Support\Collection;

final class Day6 extends \App2022\BaseAssignment
{
    public function __construct(bool $isTest = false, int $day = 6)
    {
        parent::__construct($isTest, $day);
    }

    public function parseInput(string $input): Collection
    {
        return collect(str_split($input));
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
        return $this->parsedData->sliding(4)
                ->search(fn(Collection $v) => $v->unique()->count() === 4) + 4;
    }

    private function run2(): int
    {
        return $this->parsedData->sliding(14)
                ->search(fn(Collection $v) => $v->unique()->count() === 14) + 14;
    }
}
