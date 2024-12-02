<?php

namespace App2023\Assignments;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

final class Day1 extends \App2023\BaseAssignment
{
    private array $numbers = [
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
        'five' => 5,
        'six' => 6,
        'seven' => 7,
        'eight' => 8,
        'nine' => 9,
    ];

    public function __construct(bool $isTest = false, int $day = 1)
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

    private function run1(): int
    {
        return $this->parsedData
            ->map(function ($line) {
                $v = mb_str_split($line);

                return (int)Arr::first($v, fn ($v) => is_numeric($v)) . Arr::last($v, fn ($v) => is_numeric($v));
            })
            ->sum();
    }

    private function run2(): int
    {
        return $this->parsedData
            ->map(function ($line) {
                $characters = mb_str_split($line);
                $parsed = '';

                foreach ($characters as $character) {
                    $parsed .= $character;

                    foreach ($this->numbers as $str => $number) {
                        $parsed = str_replace($str, $number . $character, $parsed);
                    }
                }
                $v = mb_str_split($parsed);

                return (int)Arr::first($v, fn ($v) => is_numeric($v)) . Arr::last($v, fn ($v) => is_numeric($v));
            })
            ->sum();
    }
}
