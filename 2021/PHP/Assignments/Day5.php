<?php

namespace Assignments;

class Day5 extends \BaseAssignment
{
    private array $cleanedData;
    private int $maxX;
    private int $maxY;

    public function __construct(bool $isTest = false, int $day = 5)
    {
        parent::__construct($isTest, $day);
        $this->cleanedData = array_map(static function ($row) {
            $coords = explode(' -> ', $row);
            return [
                array_map('intval', explode(',', $coords[0])),
                array_map('intval', explode(',', $coords[1]))
            ];
        }, explode(PHP_EOL, $this->inputData));

        $this->maxX = max(array_merge(...array_map(static function ($line) {
            return array_map(static function ($coords) {
                return $coords[0];
            }, $line);
        }, $this->cleanedData)));

        $this->maxY = max(array_merge(...array_map(static function ($line) {
            return array_map(static function ($coords) {
                return $coords[1];
            }, $line);
        }, $this->cleanedData)));
    }

    public function run(): array
    {
        return [
            $this->runTask(),
            $this->runTask(true),
        ];
    }

    private function runTask($withDiagonal = false): int
    {
        $a = array_fill(0, $this->maxY + 1, array_fill(0, $this->maxX + 1, 0));

        foreach ($this->cleanedData as $line) {
            if ($line[0][0] === $line[1][0]) {
                $from = min($line[0][1], $line[1][1]);
                $to = max($line[0][1], $line[1][1]);
                for ($y = $from; $y <= $to; $y++) {
                    $a[$y][$line[0][0]]++;
                }
            } elseif ($line[0][1] === $line[1][1]) {
                $from = min($line[0][0], $line[1][0]);
                $to = max($line[0][0], $line[1][0]);
                for ($y = $from; $y <= $to; $y++) {
                    $a[$line[0][1]][$y]++;
                }
            } elseif ($withDiagonal) {
                $incX = $line[0][0] < $line[1][0] ? 1 : -1;
                $incY = $line[0][1] < $line[1][1] ? 1 : -1;
                for ([$x, $y] = $line[0]; $y !== $line[1][1] + $incY; $y += $incY, $x += $incX) {
                    $a[$y][$x]++;
                }
            }
        }

        return count(array_filter(array_merge(...$a), static function ($item) {
            return $item >= 2;
        }));
    }
}