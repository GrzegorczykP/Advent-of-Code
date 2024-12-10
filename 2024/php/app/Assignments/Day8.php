<?php

declare(strict_types=1);

namespace App2024\Assignments;

use Illuminate\Support\Collection;

final class Day8 extends \App2024\BaseAssignment
{
    protected int $day = 8;

    public function parseInput(string $input): Collection
    {
        $map = collect(explode(PHP_EOL, $input))
            ->map(fn (string $line): array => str_split($line))
            ->all();

        return collect([
            'map' => $map,
            'mapSize' => count($map),
            'frequencies' => $this->findUniqueFrequenciesAndLocations($map),
        ]);
    }

    protected function part1(): int|string
    {
        $uniqueFrequencies = $this->parsedDataArray['frequencies'];

        $frequencyAntiNodes = array_map(function ($antennas) {
            return $this->calculateAntiNodes($antennas, false);
        }, $uniqueFrequencies);
        $allUniqueAntiNodes = array_merge(...array_values($frequencyAntiNodes));

        return count($allUniqueAntiNodes);
    }

    protected function part2(): int|string
    {
        $uniqueFrequencies = $this->parsedDataArray['frequencies'];

        $frequencyAntiNodes = array_map(function ($antennas) {
            return $this->calculateAntiNodes($antennas, true);
        }, $uniqueFrequencies);
        $allUniqueAntiNodes = array_merge(...array_values($frequencyAntiNodes));

        return count($allUniqueAntiNodes);
    }

    private function findUniqueFrequenciesAndLocations(array $map): array
    {
        $frequencies = [];
        foreach ($map as $y => $row) {
            foreach ($row as $x => $point) {
                if (preg_match('/\w/', $point)) {
                    $frequencies[$point][] = [
                        'x' => $x,
                        'y' => $y,
                    ];
                }
            }
        }

        return $frequencies;
    }

    private function calculateAntiNodes(array $antennas, bool $multi = false): array
    {
        $antiNodes = [];

        foreach ($antennas as $antennaOne) {
            foreach ($antennas as $antennaTwo) {
                if ($antennaOne === $antennaTwo) {
                    continue;
                }

                $dx = $antennaOne['x'] - $antennaTwo['x'];
                $dy = $antennaOne['y'] - $antennaTwo['y'];

                $i = $multi ? 0 : 1;

                $node = [
                    'x' => $antennaOne['x'] + $i * $dx,
                    'y' => $antennaOne['y'] + $i * $dy,
                ];

                while (
                    $this->isValidNode($node)
                    && ($multi || $i === 1)
                ) {
                    $key = $node['x'] . ',' . $node['y'];
                    $antiNodes[$key] = true;

                    $i++;

                    $node = [
                        'x' => $antennaOne['x'] + $i * $dx,
                        'y' => $antennaOne['y'] + $i * $dy,
                    ];
                }
            }
        }

        return $antiNodes;
    }

    public function isValidNode(array $node): bool
    {
        return min($node) >= 0
            && max($node) < $this->parsedDataArray['mapSize'];
    }
}
