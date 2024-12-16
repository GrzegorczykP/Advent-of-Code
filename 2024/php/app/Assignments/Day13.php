<?php

declare(strict_types=1);

namespace App2024\Assignments;

use Illuminate\Support\Collection;

/**
 * @phpstan-type Coordinates array{
 *     x: positive-int,
 *     y: positive-int
 * }
 * @phpstan-type Machine array{
 *     a: Coordinates,
 *     b: Coordinates,
 *     prize: Coordinates
 * }
 */
final class Day13 extends \App2024\BaseAssignment
{
    protected int $day = 13;

    /**
     * @return Collection<Machine>
     */
    protected function parseInput(string $input): Collection
    {
        return collect(explode(PHP_EOL . PHP_EOL, $input))
            ->map(function (string $machine) {
                preg_match('/Button A: X\+(\d+), Y\+(\d+)\sButton B: X\+(\d+), Y\+(\d+)\sPrize: X=(\d+), Y=(\d+)/', $machine, $matches);

                return [
                    'a' => ['x' => (int) $matches[1], 'y' => (int) $matches[2]],
                    'b' => ['x' => (int) $matches[3], 'y' => (int) $matches[4]],
                    'prize' => ['x' => (int) $matches[5], 'y' => (int) $matches[6]],
                ];
            });
    }

    protected function part1(): int
    {
        return array_reduce(
            $this->parsedDataArray,
            function (int $sum, array $machineConfig) {
                return $sum + $this->solve(
                    $machineConfig['a']['x'],
                    $machineConfig['a']['y'],
                    $machineConfig['b']['x'],
                    $machineConfig['b']['y'],
                    $machineConfig['prize']['x'],
                    $machineConfig['prize']['y']
                );
            },
            0
        );
    }

    protected function part2(): int
    {
        return array_reduce(
            $this->parsedDataArray,
            function (int $sum, array $machineConfig) {
                return $sum + $this->solve(
                    $machineConfig['a']['x'],
                    $machineConfig['a']['y'],
                    $machineConfig['b']['x'],
                    $machineConfig['b']['y'],
                    (int) ($machineConfig['prize']['x'] + 1e13),
                    (int) ($machineConfig['prize']['y'] + 1e13)
                );
            },
            0
        );
    }

    private function solve(int $ax, int $ay, int $bx, int $by, int $px, int $py): int
    {
        $detA = $ax * $by - $ay * $bx;
        $a = ($px * $by - $py * $bx) / $detA;
        $b = ($ax * $py - $ay * $px) / $detA;

        return is_int($a) && is_int($b) ? $a * 3 + $b : 0;
    }
}
