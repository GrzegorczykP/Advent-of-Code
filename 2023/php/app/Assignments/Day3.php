<?php

namespace App2023\Assignments;

use Illuminate\Support\Collection;

final class Day3 extends \App2023\BaseAssignment
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
//            $this->run2()
        ];
    }

    private function run1(): int
    {
        return $this->parsedData
            ->map(function (string $line, int $key) {
                $validNumbers = [];
                $offset = 0;
                while (preg_match('/\d+/', $line, $matches, PREG_OFFSET_CAPTURE, $offset)) {
                    [$number, $position] = $matches[0];
                    $searchLines[] = $this->parsedData[max($key - 1, 0)];
                    $searchLines[] = $line;
                    $searchLines[] = $this->parsedData[min($key + 1, count($this->parsedData) - 1)];
                    foreach ($searchLines as $searchLine) {
                        $value = $position - 1;
                        $part = substr($searchLine, max($value, 0), strlen($number) + ($value < 0 ? 1 : 2));
                        if (preg_match('/[^\d.]/', $part)){
                            $validNumbers[] = $number;
                            break;
                        }
                    }
                    $offset = $position + strlen($number);
                }
                return $validNumbers;
            })
            ->flatten()
            ->sum();
    }

    private function run2(): int
    {
        return $this->parsedData
            ->map(function (array $game) {
                $sets = collect($game['sets']);
                return $sets->max('red') * $sets->max('green') * $sets->max('blue');
            })
            ->sum();
    }
}
