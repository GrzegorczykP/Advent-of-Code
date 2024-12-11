<?php

declare(strict_types=1);

namespace App2024\Assignments;

use Illuminate\Support\Collection;

final class Day7 extends \App2024\BaseAssignment
{
    protected int $day = 7;

    private array $operatorsCache = [];

    public function parseInput(string $input): ?Collection
    {
        return collect(explode(PHP_EOL, $input))
            ->map(function (string $line): array {
                $exploded = explode(' ', $line);

                return [
                    'value' => (int) array_shift($exploded),
                    'numbers' => array_map('intval', $exploded),
                ];
            });
    }

    protected function part1(): int
    {
        return $this->parsedData
            ->filter(fn(array $data): bool => $this->isCorrectExpression($data['value'], $data['numbers'], ['+', '*']))
            ->sum('value');
    }

    protected function part2(): int
    {
        return $this->parsedData
            ->filter(fn(array $data): bool => $this->isCorrectExpression($data['value'], $data['numbers'], ['+', '*', '||']))
            ->sum('value');
    }

    /**
     * @return array<array<string>>
     */
    private function generateOperatorCombinations(int $size, array $operators): array
    {
        if ($size <= 0) {
            return [[]];
        }

        $cacheKey = $size . implode('', $operators);
        if (isset($this->operatorsCache[$cacheKey])) {
            return $this->operatorsCache[$cacheKey];
        }

        $combinations = array_map(fn($op) => [$op], $operators);

        for ($currentSize = 1; $currentSize < $size; $currentSize++) {
            $newCombinations = [];
            foreach ($combinations as $existingCombination) {
                foreach ($operators as $operator) {
                    $newCombination = $existingCombination;
                    $newCombination[] = $operator;
                    $newCombinations[] = $newCombination;
                }
            }
            $combinations = $newCombinations;
        }

        $this->operatorsCache[$cacheKey] = $combinations;

        return $combinations;
    }

    private function evaluateExpression(array $numbers, array $operators): int
    {
        $result = $numbers[0];
        foreach ($operators as $index => $operator) {
            $result = match ($operator) {
                '+' => $result + $numbers[$index + 1],
                '*' => $result * $numbers[$index + 1],
                '||' => (int) ($result . $numbers[$index + 1]),
            };
        }

        return $result;
    }

    private function isCorrectExpression(int $value, array $numbers, array $possibleOperators): bool
    {
        if (count($numbers) <= 1) {
            return false;
        }

        $operatorCount = count($numbers) - 1;

        foreach ($this->generateOperatorCombinations($operatorCount, $possibleOperators) as $operators) {
            if ($this->evaluateExpression($numbers, $operators) === $value) {
                return true;
            }
        }

        return false;
    }
}
