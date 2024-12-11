<?php

declare(strict_types=1);

namespace App2022\Assignments;

use Illuminate\Support\Collection;

final class Day5 extends \App2022\BaseAssignment
{
    public function __construct(bool $isTest = false, int $day = 5)
    {
        parent::__construct($isTest, $day);
    }

    public function parseInput(string $input): Collection
    {
        $out = [];
        $lines = explode(PHP_EOL, $input);
        $matches = null;

        $line = array_shift($lines);
        $containers = (strlen($line) - 3) / 4;
        $regex = '/^' . str_repeat('[ \[]([A-Z]| )[ \]] ', $containers) . '[ \[]([A-Z]| )[ \]]$/';
        while (preg_match($regex, $line, $matches)) {
            for ($i = 0; $i <= $containers; $i++) {
                $out['containers'][$i][] = $matches[$i + 1];
            }

            $line = array_shift($lines);
        }

        array_shift($lines);
        $line = array_shift($lines);
        while ($line && preg_match('/^move (\d+) from (\d+) to (\d+)$/', $line, $matches)) {
            $out['moves'][] = array_map('intval', array_slice($matches, 1));

            $line = array_shift($lines);
        }

        $out['containers'] = array_map(
            static fn($v) => array_reverse(
                array_filter($v, static fn($v) => $v !== ' ')
            ),
            $out['containers']
        );

        return collect($out);
    }

    public function run(): array
    {
        return [
            $this->run1(),
            $this->run2(),
        ];
    }

    private function run1(): string
    {
        $containers = $this->parsedData['containers'];
        foreach ($this->parsedData['moves'] as $move) {
            for ($i = 0; $i < $move[0]; $i++) {
                $containers[$move[2] - 1][] = array_pop($containers[$move[1] - 1]);
            }
        }
        $out = '';
        foreach ($containers as $container) {
            $out .= array_pop($container);
        }

        return $out;
    }

    private function run2(): string
    {
        $containers = $this->parsedData['containers'];
        foreach ($this->parsedData['moves'] as $move) {
            $sub = array_slice($containers[$move[1] - 1], -$move[0]);
            $containers[$move[2] - 1] = array_merge($containers[$move[2] - 1], $sub);
            $containers[$move[1] - 1] = array_slice($containers[$move[1] - 1], 0, -$move[0]);
        }
        $out = '';
        foreach ($containers as $container) {
            $out .= array_pop($container);
        }

        return $out;
    }
}
