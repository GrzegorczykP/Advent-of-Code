<?php

declare(strict_types=1);

namespace App2024\Assignments;

use Illuminate\Support\Collection;

/**
 * @property-read Collection{
 *     rules: Collection<int, Collection<int>>,
 *     updates: array<int, int[]>
 * } $parsedData
 * @property-read array{
 *     rules: array<int, int[]>,
 *     updates: array<int, int[]>
 * } $parsedDataArray
 */
final class Day5 extends \App2024\BaseAssignment
{
    public function __construct(bool $isTest = false, int $day = 5)
    {
        parent::__construct($isTest, $day);
    }

    public function parseInput(string $input): Collection
    {
        [$rules, $updates] = explode(PHP_EOL . PHP_EOL, $input);

        return collect([
            'rules' => collect(explode(PHP_EOL, $rules))
                ->mapToGroups(function (string $rule): array {
                    [$previous, $next] = explode('|', $rule);

                    return [(int)$previous => (int)$next];
                }),
            'updates' => collect(explode(PHP_EOL, $updates))
                ->map(fn (string $update): array => array_map('intval', explode(',', $update))),
        ]);
    }

    public function run(): array
    {
        return [
            $this->run1(),
            $this->run2(),
        ];
    }

    private function run1(): int
    {
        $sum = 0;
        foreach ($this->parsedDataArray['updates'] as $update) {
            if ($this->isCorrectOrder($update)) {
                $sum += $this->arrayMiddleElement($update);
            }
        }

        return $sum;
    }

    private function run2(): int
    {
        $sum = 0;
        foreach ($this->parsedDataArray['updates'] as $update) {
            if (!$this->isCorrectOrder($update)) {
                $update = $this->fixOrder($update);
                $sum += $this->arrayMiddleElement($update);
            }
        }

        return $sum;
    }

    private function arrayMiddleElement(array $array): mixed
    {
        return $array[(int)floor(count($array) / 2)];
    }

    private function isCorrectOrder(array $updates): bool
    {
        if (count($updates) <= 1) {
            return true;
        }

        $first = array_shift($updates);
        $diff = array_diff($updates, $this->parsedDataArray['rules'][$first] ?? []);

        return empty($diff) && $this->isCorrectOrder($updates);
    }

    private function fixOrder(array $update): array
    {
        $possibleWaysCount = [];
        foreach ($update as $page) {
            $intersect = array_intersect($this->parsedDataArray['rules'][$page] ?? [], $update);
            $possibleWaysCount[$page] = count($intersect);
        }

        asort($possibleWaysCount);

        return array_keys($possibleWaysCount);
    }
}
