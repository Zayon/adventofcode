<?php

declare(strict_types=1);

$input = file_get_contents('input');
$adapters = explode("\n", trim($input));
$adapters[] = "0";
sort($adapters);

$diffsOf1 = 0;
$diffsOf3 = 0;


$i = 1;

do {
    $joltage = $adapters[$i];

    $diff = $joltage - $adapters[$i - 1];

    if ($diff === 1) {
        $diffsOf1++;
    } elseif ($diff === 3) {
        $diffsOf3++;
    }

} while (isset($adapters[++$i]));

$diffsOf3++;

var_dump($diffsOf1, $diffsOf3);

echo $diffsOf1 * $diffsOf3;
