<?php

declare(strict_types=1);

$input = file_get_contents('input');
[$firstWire, $secondWire] = explode("\n", trim($input));

$firstWirePositions = [];
$secondWirePositions = [];

foreach (['firstWire', 'secondWire'] as $wire) {
    $turns = explode(',', $$wire);
    $X = $Y = 0;

    foreach ($turns as $turn) {
        $direction = $turn[0];
        $distance = substr($turn, 1);
        switch ($direction) {
            case 'R':
                $action = static function() use (&$X, &$Y) {++$X;};
                break;
            case 'L':
                $action = static function() use (&$X, &$Y) {--$X;};
                break;
            case 'U':
                $action = static function() use (&$X, &$Y) {++$Y;};
                break;
            case 'D':
                $action = static function() use (&$X, &$Y) {--$Y;};
                break;
        }

        for ($i = 0; $i < $distance; $i++, $action($X, $Y)) {
            ${$wire.'Positions'}[] = "$X, $Y";
        }
    }
}

$intersections = array_intersect($firstWirePositions, $secondWirePositions);

$bestManhattan = PHP_INT_MAX;
foreach ($intersections as $intersection) {
    [$X, $Y] = explode(',', $intersection);
    $manhattan = abs($X) + abs($Y);

    if ($manhattan > 0 && $manhattan < $bestManhattan) {
        $bestManhattan = $manhattan;
    }
}

echo $bestManhattan;
