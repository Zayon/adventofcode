<?php

declare(strict_types=1);

$input = file_get_contents('input');
$numbers = explode("\n", trim($input));

$i = 25;

do {
    $number = $numbers[$i];

    $j = $i-25;
    $k = $j + 1;

    do {
        $n1 = $numbers[$j];
        $n2 = $numbers[$k];

        if ($number == $n1 + $n2) {
            continue 2;
        }

        $k++;

        if ($k === $i) {
            $j++;
            $k = $j+1;
        }

        if ($j == $i-2) {
            echo $number;
            die();
        }
    } while ($k < $i);
} while (isset($numbers[++$i]));
