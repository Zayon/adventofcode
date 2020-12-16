<?php

ini_set('memory_limit', '2048M'); // 
$numbers = [14,1,17,0,3,20];
$spokenNumbers = [];
$turn = 1;

foreach ($numbers as $number) {
    echo "Turn $turn: $number\n";
    $spokenNumbers[$number] = [$turn];
    $lastTurnNumber = $number;
    $turn++;
}

do {
    $turnHistory = $spokenNumbers[$lastTurnNumber];

    if (count($turnHistory) === 1) {
        speak(0);
    } else {
        [$last, $beforeLast] = $turnHistory;
        $diff = $last - $beforeLast;
        speak($diff);
    }
} while (++$turn);

function speak($number): void
{
    global $turn, $spokenNumbers, $lastTurnNumber;

    if (isset($spokenNumbers[$number])) {
        [$last] = $spokenNumbers[$number];
        $spokenNumbers[$number] = [$turn, $last];
    } else {
        $spokenNumbers[$number] = [$turn];
    }

    $lastTurnNumber = $number;

    if ($turn === 30000000) {
        echo "Turn $turn: $number\n";
        die();
    }
}
