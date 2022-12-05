<?php

namespace App2021\Assignments;

use App2021\BaseAssignment;

class Day1 extends BaseAssignment
{
    private array $parsedData;

    public function __construct(bool $isTest = false, int $day = 1)
    {
        parent::__construct($isTest, $day);
        $this->parsedData = array_map('intval', explode(PHP_EOL, $this->inputData));
    }

    public function run(): array
    {
        return [
            $this->run1(),
            $this->run2()
        ];
    }

    public function run1(): int
    {
        $dataCount = count($this->parsedData);
        $inc = 0;

        for ($i = 1; $i < $dataCount; $i++) {
            if ($this->parsedData[$i - 1] < $this->parsedData[$i]) {
                $inc++;
            }
        }
        return $inc;
    }

    public function run2(): int
    {
        $dataCount = count($this->parsedData);
        $inc = 0;

        for ($i = 3; $i < $dataCount; $i++) {
            $sumA = $this->parsedData[$i-1] + $this->parsedData[$i-2] + $this->parsedData[$i-3];
            $sumB = $this->parsedData[$i] + $this->parsedData[$i-1] + $this->parsedData[$i-2];
            if ($sumA < $sumB) {
                $inc++;
            }
        }
        return $inc;
    }
}
