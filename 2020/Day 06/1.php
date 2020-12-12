<?php

declare(strict_types=1);

$input = file_get_contents('input');
$groups = explode("\n\n", trim($input));
$sum = 0;

foreach ($groups as $group) {
    $group = str_replace("\n", '', $group);
    $sum += count(array_unique(str_split($group)));
}

echo $sum;
