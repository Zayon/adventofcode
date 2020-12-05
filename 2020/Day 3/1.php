<?php

declare(strict_types=1);

$input = file_get_contents('input');
$rows = explode("\n", trim($input));

$col = 0;
$row = 0;
$trees = 0;

$lenght = strlen(current($rows));
$bottom = count($rows);

while ($row++ < $bottom) {
    $col += 3;
    if ($col >= $lenght) {
        $col -= $lenght;
    }

    if ($rows[$row][$col] === '#') {
        $trees++;
    }
}

echo $trees;
