<?php

namespace App2021\Assignments;

use App2021\BaseAssignment;

final class Day2 extends BaseAssignment
{
    private array $commands;

    public function __construct(bool $isTest = false, int $day = 2)
    {
        parent::__construct($isTest, $day);
        $this->commands = array_map(function ($item) {
            return explode(' ', $item);
        }, explode(PHP_EOL, $this->inputData));
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
        $position = 0;
        $depth = 0;
        foreach ($this->commands as [$direction, $units]) {
            switch ($direction) {
                case 'forward':
                    $position += $units;

                    break;
                case 'up':
                    $depth -= $units;

                    break;
                case 'down':
                    $depth += $units;

                    break;
            }
        }

        return $position * $depth;
    }

    private function run2(): int
    {
        $position = 0;
        $depth = 0;
        $aim = 0;
        foreach ($this->commands as [$direction, $units]) {
            switch ($direction) {
                case 'forward':
                    $position += $units;
                    $depth += $units * $aim;

                    break;
                case 'up':
                    $aim -= $units;

                    break;
                case 'down':
                    $aim += $units;

                    break;
            }
        }

        return $position * $depth;
    }
}
