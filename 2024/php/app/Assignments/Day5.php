<?php

declare(strict_types=1);

namespace App2024\Assignments;

use Illuminate\Support\Collection;

/**
 * @property Collection{
 *     rules:Collection<int, Collection<int>>,
 *     updates:array<int>
 * } $parsedData
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

    private function run1(): int|string
    {
        return $this->parsedData['updates']
            ->filter(fn (array $update): bool => $this->isCorrectOrder($update))
            ->sum(fn (array $update): int => $update[(int)floor(count($update) / 2)]);
    }

    private function run2(): int|string
    {
        return 0;
    }

    private function isCorrectOrder(array $updates): bool
    {
        if (count($updates) <= 1) {
            return true;
        }

        $first = array_shift($updates);
        $diff = array_diff($updates, $this->parsedData['rules']->get($first)?->all() ?? []);

        return empty($diff) && $this->isCorrectOrder($updates);
    }
}
