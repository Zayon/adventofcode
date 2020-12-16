<?php

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
        [$last, $beforeLast] = array_reverse($turnHistory);
        $diff = $last - $beforeLast;
        speak($diff);
    }
} while (++$turn !== 2021);

function speak($number): void
{
    global $turn, $spokenNumbers, $lastTurnNumber;

    $spokenNumbers[$number][] = $turn;
    $lastTurnNumber = $number;
    echo "Turn $turn: $number\n";
}
