<?php

declare(strict_types=1);

$input = file_get_contents('input');
$modules = explode("\n", trim($input));

echo array_sum(array_map(static function ($mass) {
    return floor($mass / 3) - 2;
}, $modules));
