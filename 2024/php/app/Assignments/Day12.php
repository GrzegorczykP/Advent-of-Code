<?php

declare(strict_types=1);

namespace App2024\Assignments;

use Illuminate\Support\Collection;

final class Day12 extends \App2024\BaseAssignment
{
    protected int $day = 12;

    private const array MOVE_DIRECTIONS = [
        'Up' => [0, -1],
        'Down' => [0, 1],
        'Left' => [-1, 0],
        'Right' => [1, 0],
    ];

    protected function parseInput(string $input): Collection
    {
        $map = collect(explode(PHP_EOL, $input))
            ->map(fn(string $line): array => str_split($line));

        return collect([
            'map' => $map,
            'mapXSize' => count($map[0]),
            'mapYSize' => count($map),
        ]);
    }

    protected function part1(): int
    {
        $seen = [];
        $cost = 0;

        foreach ($this->parsedDataArray['map'] as $y => $row) {
            foreach ($row as $x => $value) {
                if ($seen["$x,$y"] ?? false) {
                    continue;
                }

                $stats = $this->getSpotStats($x, $y, $seen);
                $cost += $stats['area'] * $stats['perimeter'];
            }
        }

        return $cost;
    }

    protected function part2(): int|string
    {
        return 0;
    }

    /**
     * @return array{area: int, perimeter: int}
     */
    private function getSpotStats(int $x, int $y, array &$seen): array
    {
        $seen["$x,$y"] = true;
        $map = $this->parsedDataArray['map'];

        $perimeter = 0;
        $area = 1;

        foreach (self::MOVE_DIRECTIONS as [$dx, $dy]) {
            [$nextX, $nextY] = [$x + $dx, $y + $dy];

            if (
                $nextX < 0 || $nextY < 0
                || $nextX >= $this->parsedDataArray['mapXSize']
                || $nextY >= $this->parsedDataArray['mapYSize'] // Out of map
                || $map[$x][$y] !== $map[$nextX][$nextY] // Different plant
            ) {
                $perimeter++;
            } else {
                if ($seen["$nextX,$nextY"] ?? false) {
                    continue;
                }

                $stats = $this->getSpotStats($nextX, $nextY, $seen);
                $area += $stats['area'];
                $perimeter += $stats['perimeter'];
            }
        }

        return compact('area', 'perimeter');
    }
}
