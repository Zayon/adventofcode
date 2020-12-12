<?php

$input = file_get_contents('input');
$instructions = explode("\n", trim($input));

$position = [0, 0];
$facing = 'E';

foreach ($instructions as $instruction) {
    $action = substr($instruction, -0, 1);
    $value = substr($instruction, 1);

    switch ($action) {
        case 'N':
        case 'S':
        case 'E':
        case 'W':
            move($action, $value);
            break;
        case 'R':
        case 'L':
            turn($action, $value);
            break;
        case 'F':
            move($facing, $value);
            break;
    }
}

echo abs($position[0]) + abs($position[1]);

function move(string $direction, int $value): void
{
    global $position;

    switch ($direction) {
        case 'N':
            $position[1] += $value;
            break;
        case 'S':
            $position[1] -= $value;
            break;
        case 'E':
            $position[0] += $value;
            break;
        case 'W':
            $position[0] -= $value;
            break;
    }
}

function turn(string $direction, int $angle): void
{
    global $facing;

    $cardinals = 'NESW';
    $step = $angle / 90;
    $pos = strpos($cardinals, $facing);

    $newPosition = $direction === 'R' ? $pos + $step : $pos - $step;
    $newPosition = $newPosition > 3 ? $newPosition - 4 : $newPosition;
    $newPosition = $newPosition < 0 ? $newPosition + 4 : $newPosition;

    $facing = substr($cardinals, $newPosition, 1);
}
