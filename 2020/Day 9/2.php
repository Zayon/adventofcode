<?php

declare(strict_types=1);

$input = file_get_contents('input');
$numbers = explode("\n", trim($input));

$invalidNumber = exec('php -f 1.php');

$start = 0;
$i = 0;
$j = 0;
$number = 0;

do {
    $number += $numbers[$i];

    if ($number == $invalidNumber) {
        $range = array_slice($numbers, $start, $i - $start + 1);
        echo min($range) + max($range);
        die();
    }
    $i++;

    if ($number > $invalidNumber) {
        $i = ++$start;
        $number = 0;
    }

} while ($number < $invalidNumber);

