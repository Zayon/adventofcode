<?php

declare(strict_types=1);

$input = file_get_contents('input');
$adapters = explode("\n", trim($input));
$adapters[] = "0";
$adapters[] = max($adapters) + 3;
sort($adapters);

$arrangements = [1];

for ($i = 0; isset($adapters[$i]); $i++) {
    for ($j = 0; $j < $i; $j++) {
        if($adapters[$i] - $adapters[$j] <= 3) {
            @$arrangements[$i] += @$arrangements[$j];
        }
    }
}

echo end($arrangements);


