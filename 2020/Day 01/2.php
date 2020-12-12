<?php

declare(strict_types=1);

$input = file_get_contents('input');
$expenses = explode("\n", trim($input));

$i = 0;
$j = 0;
do {
    $expense1 = $expenses[$j];

    while (isset($expenses[++$i])) {
        $expense2 = $expenses[$i];
        $k = $i;
        while (isset($expenses[++$k])) {
            $expense3 = $expenses[$k];

            if ($expense1 + $expense2 + $expense3 === 2020) {
                var_dump($expense1, $expense2, $expense3);
                var_dump($expense1 * $expense2 * $expense3);
                exit;
            }
        }
    }
    $i = $j++;
} while (isset($expenses[$j]));
