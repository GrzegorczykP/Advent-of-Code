<?php

declare(strict_types=1);

namespace App2024;

use Illuminate\Support\Collection;

abstract class BaseAssignment
{
    private string $basePath = __DIR__ . '/../../data/';

    private int $day;

    private bool $isTest;

    protected readonly string $inputData;

    protected readonly ?Collection $parsedData;

    protected readonly ?array $parsedDataArray;

    public function __construct(bool $isTest = false, int $day = 0)
    {
        $this->day = $day;
        $this->isTest = $isTest;
        $this->loadData();
        $this->parsedData = $this->parseInput($this->inputData);
        $this->parsedDataArray = $this->parsedData?->toArray();
    }

    private function loadData(): void
    {
        $extension = $this->isTest ? '/test' : '/input';

        $this->inputData = file_get_contents($this->basePath . str_pad((string)$this->day, 2, '0', STR_PAD_LEFT) . $extension);
    }

    abstract public function parseInput(string $input): ?Collection;

    /**
     * @return array{0: int|string, 1: int|string}
     */
    abstract public function run(): array;
}
