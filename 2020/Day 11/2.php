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
    $occupiedVisibleSeats = 0;

    $directions = [
        [-1, -1], // diagonal up left
        [-1, 0], // up
        [-1, +1], // diagonal up right
        [0, -1], // left
        [0, +1], //right
        [+1, -1], // diagonal down left
        [+1, 0], // down
        [+1, +1], // diagonal down right
    ];

    foreach ($directions as $direction) {
        $x = $i+$direction[0];
        $y = $j+$direction[1];

        while (isset($floorPlan[$x][$y])) {
            if ($floorPlan[$x][$y] === '#') {
                $occupiedVisibleSeats++;
                continue 2;
            }

            if ($floorPlan[$x][$y] !== '.') {
                continue 2;
            }

            $x+=$direction[0];
            $y+=$direction[1];
        }
    }

    return $occupiedVisibleSeats >= 5;
}

function isEmptySeatBecomingOccupied(array &$floorPlan, int $i, int $j): bool
{
    $directions = [
        [-1, -1], // diagonal up left
        [-1, 0], // up
        [-1, +1], // diagonal up right
        [0, -1], // left
        [0, +1], //right
        [+1, -1], // diagonal down left
        [+1, 0], // down
        [+1, +1], // diagonal down right
    ];

    foreach ($directions as $direction) {
        $x = $i+$direction[0];
        $y = $j+$direction[1];

        while (isset($floorPlan[$x][$y])) {
            if ($floorPlan[$x][$y] === '#') {
                return false;
            }

            if ($floorPlan[$x][$y] !== '.') {
                continue 2;
            }

            $x+=$direction[0];
            $y+=$direction[1];
        }
    }

    return true;
}
