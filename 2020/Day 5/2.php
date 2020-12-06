<?php

declare(strict_types=1);

$input = file_get_contents('input');
$seats = explode("\n", trim($input));

$highest = 0;
$seatsTaken = [];

foreach ($seats as $seat) {
    $row = substr($seat, 0, 7);
    $row = str_replace(['F', 'B'], ['0', '1'], $row);
    $row = bindec($row);

    $column = substr($seat, -3);
    $column = str_replace(['L', 'R'], ['0', '1'], $column);
    $column = bindec($column);

    $seatId = $row * 8 + $column;
    $seatsTaken[] = $seatId;

    if ($seatId > $highest) {
        $highest = $seatId;
    }
}

$i = 0;
do {
    if (!in_array($i, $seatsTaken)) {
        echo "Seat $i not taken.\n";
    }
} while (++$i < $highest);
