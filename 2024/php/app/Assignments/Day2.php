<?php

declare(strict_types=1);

namespace App2024\Assignments;

use Illuminate\Support\Collection;

final class Day2 extends \App2024\BaseAssignment
{
    protected int $day = 2;

    public function parseInput(string $input): Collection
    {
        return collect(explode(PHP_EOL, $input))
            ->map(fn(string $v): Collection => collect(explode(' ', $v))->map(fn($v) => (int) $v));
    }

    protected function part1(): int
    {
        return $this->parsedData
            ->filter(fn(Collection $v): bool => $this->isValidRoute($v))
            ->count();
    }

    protected function part2(): int
    {
        return $this->parsedData
            ->filter(function (Collection $route): bool {
                if ($this->isValidRoute($route)) {
                    return true;
                }

                foreach ($route as $index => $item) {
                    $shortRoute = $route->toArray();
                    unset($shortRoute[$index]);
                    if ($this->isValidRoute(array_values($shortRoute))) {
                        return true;
                    }
                }

                return false;
            })
            ->count();
    }

    private function isValidRoute(Collection|array $route): bool
    {
        $lastDiff = null;

        for ($i = 1, $iMax = count($route); $i < $iMax; $i++) {
            $diff = $route[$i] - $route[$i - 1];
            if (
                $diff === 0
                || ($lastDiff !== null && $diff * $lastDiff < 0)
                || abs($diff) > 3
            ) {
                return false;
            }

            $lastDiff = $diff;
        }

        return true;
    }
}
