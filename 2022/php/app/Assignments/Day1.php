<?php

namespace App2022\Assignments;

final class Day1 extends \App2022\BaseAssignment
{
    private array $parsedData;

    public function __construct(bool $isTest = false, int $day = 1)
    {
        parent::__construct($isTest, $day);
        $this->parsedData = array_map(
            static fn(string $v): array => array_map('intval', explode(PHP_EOL, $v)),
            explode(PHP_EOL . PHP_EOL, $this->inputData));
    }

    public function run(): array
    {
        return [
            $this->run1()
        ];
    }

    private function run1(): int
    {
        return collect($this->parsedData)
            ->map(fn($v) => array_sum($v))
            ->max();
    }
}
