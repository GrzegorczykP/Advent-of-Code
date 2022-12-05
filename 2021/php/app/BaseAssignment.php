<?php

namespace App2021;
abstract class BaseAssignment
{
    protected string $basePath = __DIR__ . '/../../data/';
    protected string $inputData;
    protected int $day;
    protected bool $isTest;

    public function __construct(bool $isTest = false, int $day = 0)
    {
        $this->day = $day;
        $this->isTest = $isTest;
        $this->loadData();
    }

    protected function loadData(): void
    {
        $extension = $this->isTest ? '/test' : '/input';

        $this->inputData = file_get_contents($this->basePath . str_pad($this->day, 2, '0', STR_PAD_LEFT) . $extension);
    }

    abstract public function run(): array;
}
