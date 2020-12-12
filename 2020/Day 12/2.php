<?php

$input = file_get_contents('input');
$instructions = explode("\n", trim($input));

$position = [0, 0];
$waypoint = [10, 1];

foreach ($instructions as $instruction) {
    $action = substr($instruction, -0, 1);
    $value = substr($instruction, 1);

    switch ($action) {
        case 'N':
        case 'S':
        case 'E':
        case 'W':
            moveWaypoint($action, $value);
            break;
        case 'R':
        case 'L':
            turnWaypoint($action, $value);
            break;
        case 'F':
            move($value);
            break;
    }
}

echo abs($position[0]) + abs($position[1]);

function moveWaypoint(string $direction, int $value): void
{
    global $waypoint;

    switch ($direction) {
        case 'N':
            $waypoint[1] += $value;
            break;
        case 'S':
            $waypoint[1] -= $value;
            break;
        case 'E':
            $waypoint[0] += $value;
            break;
        case 'W':
            $waypoint[0] -= $value;
            break;
    }
}

function move(int $times): void
{
    global $position;
    global $waypoint;

    $position[0] += $waypoint[0]*$times;
    $position[1] += $waypoint[1]*$times;
}

function turnWaypoint(string $direction, int $angle): void
{
    global $waypoint;

    $steps = $angle / 90;

    do {
        [$ew, $ns] = $waypoint;
        $waypoint = $direction === 'R' ? [$ns, -$ew] : [-$ns, $ew];
        $steps--;
    } while ($steps > 0);
}
