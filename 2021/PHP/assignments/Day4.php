<?php

namespace Assignments;

use BaseAssignment;

class Day4 extends BaseAssignment
{
    private array $numbers;
    private array $boards;

    public function __construct(bool $isTest = false, int $day = 4)
    {
        parent::__construct($isTest, $day);
        $lines = explode(PHP_EOL, $this->inputData);
        $this->numbers = array_map('intval', explode(',', array_shift($lines)));
        $this->boards = array_chunk($lines, 6);
        array_walk($this->boards, static function (&$board) {
            $board = array_map('intval', preg_split('/\s+/', trim(implode(' ', $board))));
        });
    }

    public function run(): array
    {
        $rowMarked = $colMarked = $result = [];
        $boards = $this->boards;

        foreach ($this->numbers as $number) {
            foreach ($boards as $boardIndex => &$board) {
                $key = array_search($number, $board, true);
                if ($key === false) {
                    continue;
                }

                $col = $key % 5;
                $row = floor($key / 5);

                $colMarked[$boardIndex][$col] = ($colMarked[$boardIndex][$col] ?? 0) + 1;
                $rowMarked[$boardIndex][$row] = ($rowMarked[$boardIndex][$row] ?? 0) + 1;

                $board[$key] = null;

                if ($colMarked[$boardIndex][$col] === 5 || $rowMarked[$boardIndex][$row] === 5) {
                    $result[$boardIndex] = array_sum($board) * $number;
                    unset($boards[$boardIndex]);
                }
            }
            unset($board);
        }

        return [
            $result[array_key_first($result)],
            $result[array_key_last($result)]
        ];
    }
}