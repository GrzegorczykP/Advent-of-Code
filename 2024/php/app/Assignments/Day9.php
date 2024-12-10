<?php

declare(strict_types=1);

namespace App2024\Assignments;

use App2024\Helpers\Day9\File;
use Illuminate\Support\Collection;

/**
 * @property-read Collection<File> $parsedData
 * @property-read File[] $parsedDataArray
 */
final class Day9 extends \App2024\BaseAssignment
{
    protected int $day = 9;

    public function parseInput(string $input): Collection
    {
        $files = [
            new File(0, 0, $input, 0),
        ];


        for ($i = 1, $inputFilesCount = ceil(strlen($input) / 2); $i < $inputFilesCount; $i++) {
            $prevFile = $files[$i - 1];
            $files[] = new File($i, $i * 2, $input, $prevFile->memoryIndex + $prevFile->size + $prevFile->spaceAfter);
        }

        return collect($files);
    }

    protected function part1(): int|string
    {
        return $this->calculateDiskChecksum();
    }

    protected function part2(): int|string
    {
        return $this->calculateDiskChecksumPart2();
    }

    private function calculateDiskChecksum(): int
    {
        $diskMap = $this->inputData;
        $mapLength = strlen($diskMap);
        $leftFile = new File(0, 0, $diskMap);
        $rightFile = new File((int)floor($mapLength / 2), $mapLength - 1, $diskMap);

        $checksum = 0;
        $finalIndex = 0;

        while ($leftFile->mapIndex < $rightFile->mapIndex) {
            for ($j = 0; $j < $leftFile->size; $j++) {
                $checksum += $leftFile->id * $finalIndex++;
                $leftFile->moveBytes();
            }
            for ($j = 0; $j < $leftFile->spaceAfter;) {
                while (
                    $rightFile->remainingSize > 0
                    && $j < $leftFile->spaceAfter
                ) {
                    $checksum += $rightFile->id * $finalIndex++;
                    $rightFile->moveBytes();
                    $j++;
                }
                if ($rightFile->remainingSize === 0) {
                    $rightFile = new File($rightFile->id - 1, $rightFile->mapIndex - 2, $diskMap);
                }
            }

            $leftFile = new File($leftFile->id + 1, $leftFile->mapIndex + 2, $diskMap);
        }

        for ($i = 0; $i < $rightFile->remainingSize; $i++) {
            $checksum += $rightFile->id * $finalIndex++;
        }

        return $checksum;
    }

    private function calculateDiskChecksumPart2(): int
    {
        $reversed = $this->parsedData->reverse();
        $diskSize = $reversed->first()->memoryEndIndex + $reversed->first()->spaceAfter;

        $occupied = array_fill(0, $diskSize, false);
        $finalPositions = [];


        $this->parsedData
            ->each(function (File $file) use (&$occupied) {
                for ($i = $file->memoryIndex; $i < $file->memoryEndIndex; $i++) {
                    $occupied[$i] = true;
                }
            });

        /** @var File $file */
        foreach ($reversed as $file) {
            $newPosition = $this->findAvailablePosition($file, $occupied);

            if ($newPosition !== null) {
                $this->moveToNewPosition($file, $occupied, $newPosition);
            }

            $finalPositions[$file->id] = ['start' => $file->memoryIndex, 'size' => $file->size];
        }

        $checksum = 0;
        foreach ($finalPositions as $id => $pos) {
            for ($i = 0; $i < $pos['size']; $i++) {
                $checksum += ($pos['start'] + $i) * $id;
            }
        }

        return $checksum;
    }

    private function findAvailablePosition(File $file, array $occupied): ?int
    {
        $newPosition = null;
        for ($pos = array_search(false, $occupied, true); $pos < $file->memoryIndex; $pos++) {
            if (array_slice($occupied, $pos, $file->size) === array_fill(0, $file->size, false)) {
                $newPosition = $pos;

                break;
            }
        }

        return $newPosition;
    }

    private function moveToNewPosition(File $file, array &$occupied, int $newPosition): void
    {
        // Clear old position
        for ($i = $file->memoryIndex; $i < $file->memoryEndIndex; $i++) {
            $occupied[$i] = false;
        }

        // Set new position
        $file->memoryIndex = $newPosition;
        for ($i = $file->memoryIndex; $i < $file->memoryEndIndex; $i++) {
            $occupied[$i] = true;
        }
    }
}
