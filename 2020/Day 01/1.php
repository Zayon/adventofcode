<?php

declare(strict_types=1);

$input = file_get_contents('input');
$expenses = explode("\n", trim($input));

$i = 0;
$j = 0;
do {
    $expense1 = $expenses[$j];

    while (isset($expenses[$i++])) {
        $expense2 = $expenses[$i];

        if ($expense1 + $expense2 === 2020) {
            var_dump($expense1, $expense2);
            var_dump($expense1 * $expense2);
            exit;
        }
    }
    $i = $j++;
} while (isset($expenses[$j]));
