<?php

declare(strict_types=1);

$input = file_get_contents('input');
$instructions = explode("\n", trim($input));

var_dump($instructions);

$accumulator = 0;
$executedInstructions = [];
$i=0;

while (!in_array($i, $executedInstructions, true)) {
    $executedInstructions[] = $i;
    $instruction = $instructions[$i];

    [$operation, $argument] = explode(' ', $instruction);

    if ($operation === 'jmp') {
        $i += $argument;
        continue;
    }

    if ($operation === 'acc') {
        $accumulator += $argument;
    }

    $i++;
}

echo $accumulator;
