<?php

declare(strict_types=1);

$input = file_get_contents('input');
$rows = explode("\n", trim($input));

$lenght = strlen(current($rows));
$bottom = count($rows);

$slopes = [
    [1, 1],
    [3, 1],
    [5, 1],
    [7, 1],
    [1, 2],
];

$results = [];

foreach ($slopes as $slope) {
    $col = 0;
    $row = 0;
    $trees = 0;

    [$right, $down] = $slope;

    while (($row += $down) < $bottom) {
        $col += $right;
        if ($col >= $lenght) {
            $col -= $lenght;
        }

        if ($rows[$row][$col] === '#') {
            $trees++;
        }
    }

    echo $trees.PHP_EOL;
    $results[] = $trees;
}

echo array_product($results);
