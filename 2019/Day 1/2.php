<?php

declare(strict_types=1);

$input = file_get_contents('input');
$modules = explode("\n", trim($input));

echo array_sum(array_map(static function ($mass) {
    $totalFuel = 0;
    $fuel = floor($mass / 3) - 2;

    while ($fuel > 0) {
        $totalFuel += $fuel;
        $fuel = floor($fuel / 3) - 2;
    }

    return $totalFuel;
}, $modules));
