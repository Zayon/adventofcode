<?php

declare(strict_types=1);

$input = file_get_contents('input');
$floorPlan = explode("\n", trim($input));
$nextRound = $floorPlan = array_map(fn ($row) => str_split($row), $floorPlan);

$rows = count($floorPlan);
$columns = count($floorPlan[0]);

do {
    $floorPlan = $nextRound;
    $nextRound = performRound($rows, $columns, $floorPlan);
} while ($nextRound !== $floorPlan);

echo substr_count(flatten($nextRound), '#');

function flatten(array $array): string
{
    return implode("\n", array_map(fn ($row) => implode('', $row), $array));
}

function performRound(int $rows, int $columns, array $floorPlan): array
{
    $nextRound = $floorPlan;

    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $columns; $j++) {
            $position = $floorPlan[$i][$j];
            if ($position === '#') {
                $nextRound[$i][$j] = isOccupiedSeatBecomingEmpty($floorPlan, $i, $j) ? 'L' : '#';
            } elseif ($position === 'L') {
                $nextRound[$i][$j] = isEmptySeatBecomingOccupied($floorPlan, $i, $j) ? '#' : 'L';
            }
        }
    }

    return $nextRound;
}

function isOccupiedSeatBecomingEmpty(array &$floorPlan, int $i, int $j): bool
{
    $occupiedAdjacentSeats = 0;

    for ($x = $i - 1; $x <= ($i + 1); $x++) {
        for ($y = $j - 1; $y <= ($j + 1); $y++) {
            if ($x === $i && $y === $j) {
                continue;
            }

            if (isset($floorPlan[$x][$y]) && $floorPlan[$x][$y] === '#') {
                $occupiedAdjacentSeats++;
            }
        }
    }

    return $occupiedAdjacentSeats >= 4;
}

function isEmptySeatBecomingOccupied(array &$floorPlan, int $i, int $j): bool
{
    for ($x = $i - 1; $x <= ($i + 1); $x++) {
        for ($y = $j - 1; $y <= ($j + 1); $y++) {
            if ($x === $i && $y === $j) {
                continue;
            }

            if (isset($floorPlan[$x][$y]) && $floorPlan[$x][$y] === '#') {
                return false;
            }
        }
    }

    return true;
}
