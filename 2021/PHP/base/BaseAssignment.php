<?php

abstract class BaseAssignment
{
    protected string $basePath = __DIR__ . '/../../data/';
    protected string $inputData;
    protected int $day;

    public function __construct(int $day)
    {
        $this->day = $day;
        $this->loadData();
    }

    protected function loadData(): void
    {
        $this->inputData = file_get_contents($this->basePath . str_pad($this->day, 2, '0', STR_PAD_LEFT) . '.input');
    }

    abstract public function run(): array;
}