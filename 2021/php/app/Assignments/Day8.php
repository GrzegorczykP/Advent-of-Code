<?php

namespace App2021\Assignments;

use App2021\BaseAssignment;

final class Day8 extends BaseAssignment
{
    private array $parsedData;
    private array $numbersCodes = [
        0 => 'abcefg',
        1 => 'cf',
        2 => 'acdeg',
        3 => 'acdfg',
        4 => 'bcdf',
        5 => 'abdfg',
        6 => 'abdefg',
        7 => 'acf',
        8 => 'abcdefg',
        9 => 'abcdfg',
    ];

    public function __construct(bool $isTest = false, int $day = 8)
    {
        parent::__construct($isTest, $day);
        $this->parseInput();
    }

    private function parseInput(): void
    {
        $this->parsedData = array_map(static function ($item) {
            return array_map(static function ($item) {
                return array_map(static function ($item) {
                    return $item;
                }, explode(' ', $item));
            }, explode(' | ', $item));
        }, explode(PHP_EOL, $this->inputData));
    }

    public function run(): array
    {
        return [
            $this->run1(),
        ];
    }

    private function run1(): int
    {
        $uniqueSegmentsNumber = array_keys(
            array_filter(
                array_count_values(
                    array_map('strlen', $this->numbersCodes)
                ), static function ($item) {
                return $item === 1;
            })
        );

        $counter = 0;
        foreach ($this->parsedData as $inputLine) {
            $lettersNumbers = array_map('strlen', $inputLine[1]);
            foreach ($lettersNumbers as $lettersNumber) {
                if (in_array($lettersNumber, $uniqueSegmentsNumber, true)) {
                    $counter++;
                }
            }
        }
        return $counter;
    }
}
