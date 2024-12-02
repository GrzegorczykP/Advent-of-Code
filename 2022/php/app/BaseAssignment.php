<?php

namespace App2022;

use Illuminate\Support\Collection;

abstract class BaseAssignment
{
    private string $basePath = __DIR__ . '/../../data/';

    private int $day;

    private bool $isTest;

    protected string $inputData;

    protected Collection $parsedData;

    public function __construct(bool $isTest = false, int $day = 0)
    {
        $this->day = $day;
        $this->isTest = $isTest;
        $this->loadData();
        $this->parsedData = $this->parseInput($this->inputData);
    }

    protected function loadData(): void
    {
        $extension = $this->isTest ? '/test' : '/input';

        $this->inputData = file_get_contents($this->basePath . str_pad($this->day, 2, '0', STR_PAD_LEFT) . $extension);
    }

    abstract public function parseInput(string $input): Collection;

    abstract public function run(): array;
}
