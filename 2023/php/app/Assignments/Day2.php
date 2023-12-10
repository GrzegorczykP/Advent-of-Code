<?php

namespace App2023\Assignments;

use Illuminate\Support\Collection;

final class Day2 extends \App2023\BaseAssignment
{
    public function __construct(bool $isTest = false, int $day = 2)
    {
        parent::__construct($isTest, $day);
    }

    public function parseInput(string $input): Collection
    {
        return collect(explode(PHP_EOL, $input))
            ->map(function ($line) {
                preg_match('/Game (?<ID>\d+): (?<sets>.+)/', $line, $matches);
                $sets = explode('; ', $matches['sets']);
                $out = [
                    'ID' => (int)$matches['ID'],
                    'sets' => []
                ];
                foreach ($sets as $key => $set) {
                    $out['sets'][$key] = [
                        'red' => 0,
                        'green' => 0,
                        'blue' => 0
                    ];
                    preg_match_all('/(?<number>\d+) (?<color>\w+)/', $set, $matches, PREG_SET_ORDER);
                    foreach ($matches as $match) {
                        $out['sets'][$key][$match['color']] = (int)$match['number'];
                    }
                }
                return $out;
            });
    }

    public function run(): array
    {
        return [
            $this->run1(),
            $this->run2()
        ];
    }

    private function run1(): int
    {
        return $this->parsedData
            ->filter(function (array $game) {
                foreach ($game['sets'] as $set) {
                    if ($set['red'] > 12) {
                        return false;
                    }
                    if ($set['green'] > 13) {
                        return false;
                    }
                    if ($set['blue'] > 14) {
                        return false;
                    }
                }
                return true;
            })
            ->sum('ID');
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
