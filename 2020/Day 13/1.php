<?php

declare(strict_types=1);

$input = file_get_contents('input');
[$timestamp, $busIds] = explode("\n", trim($input));

$busIds = explode(',', str_replace(',x', '', $busIds));

$smallest = PHP_INT_MAX;
$busToTake = null;

foreach ($busIds as $busId) {

    $timeOfBus = $busId * (floor($timestamp / $busId) + 1);

    if ($timeOfBus < $smallest) {
        $smallest = $timeOfBus;
        $busToTake = $busId;
    }
}

$timeOfBus = $smallest;
$minutesToWait = $timeOfBus - $timestamp;

echo $minutesToWait * $busToTake;
