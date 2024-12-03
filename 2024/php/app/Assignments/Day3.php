<?php

namespace App2024\Assignments;

use Illuminate\Support\Str;

final class Day3 extends \App2024\BaseAssignment
{
    public function __construct(bool $isTest = false, int $day = 3)
    {
        parent::__construct($isTest, $day);
    }

    public function parseInput(string $input): null
    {
        return null;
    }

    public function run(): array
    {
        return [
            $this->run1(),
            $this->run2(),
        ];
    }

    private function run1(): int|string
    {
        return Str::of($this->inputData)
            ->matchAll('/mul\((\d+,\d+)\)/')
            ->sum(function (string $v) {
                $params = explode(',', $v);
                return $params[0] * $params[1];
            });
    }

    private function run2(): int|string
    {
        $parts = explode("don't()", $this->inputData);

        $res = [array_shift($parts)];

        foreach ($parts as $part) {
            $exploded = explode('do()', $part, 2);
            if (isset($exploded[1])) {
                $res[] = $exploded[1];
            }
        }

        return Str::of(implode('', $res))
            ->matchAll('/mul\((\d+,\d+)\)/')
            ->sum(function (string $v) {
                $params = explode(',', $v);
                return $params[0] * $params[1];
            });
    }
}
