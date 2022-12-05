<?php

namespace App\Assignments;

use App\BaseAssignment;

class Day6 extends BaseAssignment
{
    private array $fishes;

    public function __construct(bool $isTest = false, int $day = 6)
    {
        parent::__construct($isTest, $day);
        $this->fishes = array_map('intval', explode(',', $this->inputData));
    }

    public function run(): array
    {
        return [
            $this->smartSimulate(80),
            $this->smartSimulate(256)
        ];
    }

    private function smartSimulate(int $days): int
    {
        $grouped = $this->groupFishes();

        for ($i = 0; $i < $days; $i++) {
            $born = $grouped[0];
            for ($j = 1; $j <= 8; $j++) {
                $grouped[$j - 1] = $grouped[$j];
            }
            $grouped[6] += $born;
            $grouped[8] = $born;
        }

        return array_sum($grouped);
    }

    private function groupFishes(): array
    {
        $grouped = [];
        foreach ($this->fishes as $fish) {
            $grouped[$fish][] = $fish;
        }
        for ($i = 0; $i <= 8; $i++) {
            if (array_key_exists($i, $grouped)) {
                $grouped[$i] = count($grouped[$i]);
            } else {
                $grouped[$i] = 0;
            }
        }
        return $grouped;
    }

    private function simulate(int $days): int
    {
        for ($i = 0; $i < $days; $i++) {
            foreach ($this->fishes as &$fish) {
                $fish--;
                if ($fish < 0) {
                    $fish = 6;
                    $this->fishes[] = 9;
                }
            }
            unset($fish);
        }

        return count($this->fishes);
    }
}

